<?php

namespace App\Http\Controllers;

use App\Pages;

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
}
