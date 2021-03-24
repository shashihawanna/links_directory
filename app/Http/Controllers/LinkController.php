<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use App\Mail\AddLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LinkController extends Controller
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
     * Show the application dashboard
     *
     * @return void
     */
    public function index()
    {
       
        return view('index', [
            'links' => Link::all()->sortDesc()
        ]);
    }

    /**
     * view link details blade
     *
     * @param Request $request
     * @return void
     */
    public function view(Request $request)
    {
        return view('addLink');
    }
    /**
     * check entered url is not exist in db
     *
     * @param Request $request
     * @return array
     */
    public function checkUrlExit(Request $request)
    {
        $reponse['success'] = true;
        $reponse['msg'] = __('link.validate.rurl');
        if (empty($request->url)) {
            $reponse['success'] = false;
            $reponse['msg'] = __('link.validate.nurl');
            return $reponse;
        }
        $url = Link::select('url')->where('url', trim($request->url, " "))->get();
        if ($url->count() > 0) {
            $reponse['success'] = false;
            $reponse['msg'] =   __('link.validate.eurl');
            return $reponse;
        }
        return $reponse;
    }

    /**
     * add link details in db
     *
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        $reponse['success'] = false;
        $reponse['msg'] = __('link.msg.add_failed');
        if (empty($request->url) || empty($request->title) || empty($request->description)) {
            $reponse['msg'] = __('link.msg.enter_all');
            return $reponse;
        }
        $link = new Link();
        $link->url = $request->url;
        $link->title = $request->title;
        $link->description = $request->description;
        $link->save();
        if ($link) {
            $userAuth = Auth::user();
            $content['first_name'] = $userAuth->name;
            $content['url'] = $request->url;
            $content['title'] =  $request->title;
            $content['description'] = $request->description;;
            Mail::to($userAuth->email)->send(new AddLink($content));
            $reponse['msg'] = __('link.msg.add_success');
            $reponse['success'] =  true;
            return $reponse;
        }
        return $reponse;
    }
}
