<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    function index(){
        $address = "111/26 มิรารี่โฮม,ดอนไก่ดี,กระทุ่มแบน,74110";
        $tel = "089-548-6892";
        $email = "Nattawut.Santhumpol@hotmail.com";

        // return view('about',['address'=>$address,'tel'=>$tel,'email'=>$email]);
        //compact
        // return view('about',compact('address','tel','email'));
        //with
        return view('about')
        ->with('address',$address)
        ->with('tel',$tel)
        ->with('email',$email)
        ->with('error','404 Not Found');
    }

}
