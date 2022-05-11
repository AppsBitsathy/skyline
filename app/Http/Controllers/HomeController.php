<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {
        return view('home');
    }

    public function changeISI(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                $value = trim($request->input('isi'));
                if ($value == '9079' || $value == '12225' || $value == '6595' || $value == '8034' || $value == '8472' || $value == '9283' || $value == '14220') {
                    session(['isi' => $value]);
                    return $value;
                } else return 0;
            } else return 0;
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! :' . $ex->__toString());
        }
    }
}