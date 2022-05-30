<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\CourseApplicantRequest;
use App\Http\Services\MyFatoorahServices;
use App\Mail\ApplicantMail;
use App\Models\Course;
use App\Models\CourseApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;

class CourseApplicantController extends Controller
{
    private $fatoorahservice;
    /**
     * PaymentController constructor.
     * @param MyFatoorahServices $fatoorahservice
     */
    public function __construct(MyFatoorahServices $fatoorahservice)
    {
        $this->fatoorahservice=$fatoorahservice;
    }

    public function registerPage($course_id,Request $request)
    {
        $course = Course::where(['course_payable'=>1,'active'=>1])->findOrFail($course_id);
        return view('site.course_applicant.send',compact('course'));
    }

    public function send($course_id,CourseApplicantRequest $request)
    {
        $course=Course::where(['active'=>1,'course_payable'=>1])->find($course_id);
        $data=[
            'NotificationOption' => 'Lnk',
            'InvoiceValue'       => $course->price,
            'CustomerName'       => $request->name,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerMobile'     => $request->mobile,
            'CustomerEmail'      => $request->email,
            'CallBackUrl'        => 'http://ghran.test:8000/course_applicants/callback',
            'ErrorUrl'           => 'http://ghran.test:8000/course_applicants/callback_error',
            'Language'           => 'en',

        ];

        $this->setApplicantSession($request);
        return $this->fatoorahservice->sendPayment($data);
    }
    public function setApplicantSession(Request $request)
    {
        $request->Session()->put('name', $request->input('name'));
        $request->Session()->put('city', $request->input('city'));
        $request->Session()->put('course_id', $request->input('course_id'));
        $request->Session()->put('age', $request->input('age'));
        $request->Session()->put('mobile', $request->input('mobile'));
        $request->Session()->put('address', $request->input('address'));
        $request->Session()->put('marital_status', $request->input('marital_status'));
        $request->Session()->put('email', $request->input('email'));
        $request->Session()->put('job', $request->input('job'));
    }

    /**
     * success callback
     */

    public function paymentCallBack(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
        $data = [];
            $data['key'] = $request->paymentId;
            $data['keyType'] = 'paymentId';
            $response = $this->fatoorahservice->getPaymentStatus($data);
            $course_id = $request->Session()->get('course_id');
            CourseApplicant::create([
                'payment_method' => $request->paymentId,
                'name' => $request->Session()->get('name'),
                'course_id' => $course_id,
                'city' => $request->Session()->get('city'),
                'age' => $request->Session()->get('age'),
                'mobile' => $request->Session()->get('mobile'),
                'address' => $request->Session()->get('address'),
                'marital_status' => $request->Session()->get('marital_status'),
                'email' => $request->Session()->get('email'),
                'job' => $request->Session()->get('job'),
            ]);

            $data = [
                'name' => $request->Session()->get('name'),
                'courses' => Course::where(['id' => $course_id, 'course_payable' => 1, 'active' => 1])->first()->name
            ];
            Mail::to($request->Session()->get('email'))->send(new ApplicantMail($data));
            setcookie('course_id', $course_id, 2147483647, '/');
            setcookie('register_mobile', $request->Session()->get('mobile'), 2147483647, '/');
            return redirect()->route('course_applicant.register', $course_id)->with(['applicant_success' => 'تم تسجيل في الدورة بنجاح بنجاح']);
        }catch(\Exception $ex){
            return redirect()->route('course_applicant.register', $course_id)->withInput()->with(['applicant_error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }

    public function paymentError()
    {
        return redirect()->back()->withInput()->with(['applicant_error'=>'حدث خطأ ما حاول مرة أخرى']);
    }
}
