<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function __invoke($page)
    {
        if($page == "about"){ $data = Pages::find(1);}
        if($page == "privacy"){ $data = Pages::find(2); }
        if($page == "terms"){ $data = Pages::find(3); }
        if($page == "help"){ $data = Pages::find(4); }
        return view('pages.master')->with('data', $data);
    }

    // public function about()
    // {
    //     return view('pages.about');
    // }
    // public function terms()
    // {
    //     return view('pages.terms');
    // }
    // public function privacy()
    // {
    //     return view('pages.privacy');
    // }
}
