@extends('layout')
@section('content')
  	<h2>編輯留言</h2>
	<form method="post"	action="{{ URL::action('MessageBoardController@update') }}">
		<table class="table">
		<tr>

			<th>Name_名字 :</th>
			<td> <label>{!! \Auth::user()->name !!}</label></td>
		</tr>
		<tr>
			<th>Content_內容</th>
			<td><input type="text" name="input_content" value="{{ $messageBoard -> content }}" /></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="hidden" name="edit_id" value="{{ $messageBoard -> id }}">
				<input name="_method" type="hidden" value="PUT"/>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit">送出</button>
			</td>
		</tr>
		</table>
	</form>

@stop



