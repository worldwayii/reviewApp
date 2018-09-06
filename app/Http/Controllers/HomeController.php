<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * The index page view maker
     *
     * @return View 
     */
    public function index()
    {
    	$items = DB::table('items')->get();
    	return View('index', compact('items'));
    }

    /**
     *
     *
     */
    public function showDocumentation()
    {
        return View('docs');
    }
}
