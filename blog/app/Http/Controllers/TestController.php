<?php

namespace App\Http\Controllers;
use App\Test;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function index(){
    	$test = Test::all();

    	return view('test.index',compact('test'));
    }
}
