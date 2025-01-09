<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class setlocalecontroller extends Controller
{
    //
    public function setLocale($locale){
        if(in_array($locale,['en', 'id'])){
            \Log::info($locale);
            App::SetLocale($locale);
            Session::put('locale', $locale);
        }
        return back();
    }
}
