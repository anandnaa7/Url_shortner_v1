<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShortLink;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function loadPage($shortUrl)
    {
        $page = ShortLink::where('slug',$shortUrl)->first();
        if(is_null($page)){
            return abort(404);
        }else{
            return redirect($page->org_url);        
        }
    }
}
