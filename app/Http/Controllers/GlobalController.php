<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalController extends Controller
{

    function index(Request $request, $path = null,$path2 = null)
    {
        switch ($path) {
            case null:
                return view('index');
                break;
            case "home":
                return redirect('/');
                break;
            case "/":
                return redirect('/');
                break;
            case "post": 
                return view("index");
                break;
            default:
            abort(404);
                break;
        }
    }
}
