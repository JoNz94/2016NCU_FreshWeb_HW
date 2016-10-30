<?php
namespace App\Http\Controllers;
use App\Services\MessageBoard;
use App\Http\Requests\CreateRequest;  //用規則
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Query\Builder;
use App\Ncucc\MySqlUtils;
use DB, Session;
 use Illuminate\Http\Response;
class MessageBoardController extends Controller
{
	public function index(){

		//return \Auth::user()->name;
		$messageBoards = MessageBoard::latest()->paginate(10);
		# 分頁時，需要設定url的名稱
		$messageBoards->setPath('MessageBoard');
		
		return view("messageBoard.index", compact('messageBoards'));
	}
	# 新增的畫面
	public function create(){
		$messageBoard = new MessageBoard();
		return View('messageBoard.create',compact('messageBoard'));
	}
	# 修改的畫面
	public function edit($id){
		$messageBoard = MessageBoard::find($id);
		return View("messageBoard.edit",compact('messageBoard'));
	}
	public function delete(){
		//$messageBoard = messageBoard::find($id);
		$messageBoard = new MessageBoard();
		return View("messageBoard.delete",compact('messageBoard'));
	}
	
		#新增的儲存
	public function store(Request $request){

		$this->validate($request,['input_content' => 'required|max:30']);
		$messageBoard = new MessageBoard;
		$messageBoard -> name = \Auth::user()->name;
		$messageBoard -> content = $request->input('input_content');
		$messageBoard -> time = MySqlUtils::now();
		$messageBoard -> json = $messageBoard -> toJson();
		$messageBoard->save();
		

		// // session()->flash('flash_message','Your message has been created!');

		// // session()->flash('flash_message_important',true);

		return Redirect::to('MessageBoard')->with([

				'flash_message' => 'Your message has been created!',
				'flash_message_important' => true,


			]);
		

	}
	
	#修改的儲存
	public function update(Request $request){
		
		$this->validate($request,['input_content' => 'required|max:30']);
		$messageBoard = MessageBoard::find($request->input('edit_id'));
		$messageBoard -> name = \Auth::user()->name;
		$messageBoard -> content = $request->input('input_content');
		$messageBoard -> time = MySqlUtils::now();
		$messageBoard->save();
		return Redirect::to('MessageBoard');
	}
	
	#刪除
	public function destroy($id){
		$messageBoard = MessageBoard::find($id);
		$messageBoard -> delete();
		return Redirect::to('MessageBoard');
	}

}