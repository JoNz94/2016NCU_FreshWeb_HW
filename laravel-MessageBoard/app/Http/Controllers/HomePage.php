<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Ncucc\MySqlUtils;
use DB, Session;

class Homepage extends Controller{

	public function index(){
		
		return view("homePage.index");
	}
}