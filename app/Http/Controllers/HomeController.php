<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
    	$items = Item::all();
    	// dd($items);
    	return View('index', compact('items'));
    }
}
