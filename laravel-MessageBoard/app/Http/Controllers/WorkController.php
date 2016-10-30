<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Ncucc\MySqlUtils;
use App\Work;
use DB, Session;

class WorkController extends Controller{

	public function index(){
		
		return view("work.index");
	}

	public function tempsave(Request $request){

		session_start();
		if( !isset($_SESSION["temp"])){
				$_SESSION["temp"] = '{ "answer":['.$request->get('answer');
		}else {
			$_SESSION["temp"] = $_SESSION["temp"].$request->get('answer');
		}
		
		return $_SESSION["temp"];
	}
	public function save(Request $request){
		

		$this->tempsave($request);
		$works = new Work;
		$works -> json = $_SESSION["temp"].'"]}';
		$works -> save();
		unset($_SESSION["temp"]);
		return ;
	}
}