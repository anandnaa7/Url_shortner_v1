<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\ShortLink;

use DB;



class ShortController extends Controller
{
    //

    public function index()
    {   
        $flag['success'] = 0;
        if (Auth::check()){
            $user = Auth::user();
            $shortLinks = ShortLink::select('id','title','short_url','org_url',DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formatted_dob'))->where('user_id',$user->id)->orderBy('created_at','desc')->get();

            $flag['success'] = 1;
            $flag['payload']=$shortLinks;
        }
        return response()->json($flag);    
    }
    public function store(Request $request)
    {
        $flag['success'] = 0;
        if (Auth::check()){
            $user = Auth::user();
            $slug = time();
            $url =  $_SERVER['HTTP_HOST'].'/'.$slug;
            ShortLink::create([
                'title' => request('title'),
                'org_url' => request('org_url'),
                'user_id' => $user->id,
                'short_url' => $url,
                'slug'=>$slug,
            ]);
            $flag['success'] = 1;
        }
        return response()->json($flag);
    }

}
