<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use View;
use File;

class HomeController extends Controller
{
    private $navbar;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check()) {
            $this->navbar = [
                [
                    'title' => trans('dash.applications.title'),
                    'href' => route('dashboard.index'),
                    'count' => Auth::user()->applications->count(),
                    'icon' => 'zmdi-layers'
                ],
                [
                    'title' => trans('dash.apply.title'),
                    'href' => route('apply.index'),
                    'count' => null,
                    'icon' => 'zmdi-sign-in'
                ]
            ];
            View::share('navbar', $this->navbar);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function changeLanguage($lang)
    {
        
    }

    public function document(Request $request, $application_id, $document)
    {
//        $fileName = str_replace('pay_', '', $document);
//        $filePath = storage_path("app\\applications\\".$application_id.'\\'.$fileName);
//        return Response::make(File::get($filePath), 200, array('Content-Type' => 'image/jpeg', 'Content-Length' => File::size($filePath)));
//        dd(storage_path('applications/'.$application_id.'/'.$fileName));
//        $headers = array(
//            'Content-Type: application/pdf',
//        );

        return response()->file(storage_path("app\\applications\\".$application_id.'\\'.$document));
//        return response()->file($filePath);
    }

    public function inspection(Request $request, $inspection, $file)
    {
        return response()->file(storage_path("app\\pw\\inspections\\".$inspection.'\\'.$file));
    }
}
