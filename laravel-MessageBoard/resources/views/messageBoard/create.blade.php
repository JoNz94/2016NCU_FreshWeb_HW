@extends('layout')
@section('content')
  	<h2>新增內容</h2>
  	<p>以下請輸入你的名字及內容</p>
	<form method="post" action="{{ URL::action('MessageBoardController@store') }}">
	<table  class="table table-striped">
		<tr>
			<th>Name_名字 :</th>
			<td> <label>{!! \Auth::user()->name !!}</label></td>
		</tr>
		<tr>
			<th>Content_內容</th>
			<td><input type="text" name="input_content"/></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit">送出</button>
			</td>
		</tr>
	</table>
	</form>

	@if ($errors->any())
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>

	@endif

@stop

