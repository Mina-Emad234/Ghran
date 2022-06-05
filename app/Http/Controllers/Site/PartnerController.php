<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(){
        $partners = Partner::where('status',1)->get();
        return view('site.partner.index',compact('partners'));
    }
}
