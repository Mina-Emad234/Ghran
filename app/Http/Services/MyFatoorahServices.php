<?php


namespace App\Http\Services;


use App\Models\Setting;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;


class MyFatoorahServices
{
    private $base_url;
    private $headers;
    private $request_client;
    /*
     * get client interface
     */
    public function __construct(Client $request_client)
    {
        $setting = new Setting();
        $this->request_client=$request_client;
        $this->base_url= $setting->val('fatoorah_base_url');
        $this->headers=[
            'Content-Type' => 'application/json',
            'authorization'=>'Bearer ' . $setting->val('fatoorah_token')
        ];
    }

    /**
     * use interface to make request
     * return request inside response
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @param $url
     * @param $method
     * @param $process
     * @param array $data
     * @return false|\Illuminate\Http\RedirectResponse|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function buildRequest($url, $method, $process,$data=[])
    {
        $request= new Request($method,$this->base_url . '/' . $url,$this->headers);
        if(!$data)
            return false;
        $response = $this->request_client->send($request,[
            'json' => $data,
        ]);
        if ($response->getStatusCode() != 200){
            return false;
        }
        $response = json_decode($response->getBody(),true);
        if($process == 'pay') {
            return redirect()->away($response['Data']['InvoiceURL']);
        }else{
            return $response;
        }
    }

    /**
     * send payment to payment gate
     * @param $data
     * @return false|\Illuminate\Http\RedirectResponse|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendPayment($data)
    {
        return $response=$this->buildRequest('v2/SendPayment','POST','pay',$data);
    }

    /**
     * get payment status
     * @param $data
     * @return false|\Illuminate\Http\RedirectResponse|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPaymentStatus($data)
    {
        return $response=$this->buildRequest('v2/getPaymentStatus','POST','callback',$data);
    }

}
