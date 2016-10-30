@extends('layout')
@section('content')

<script>
var temp = 0;

$(document).ready(function(){
    $("#btn1").click(function(){

    	
    	
    	var YO = temp;
    	
        $("#main").append("<li><b>請填入問題題目 :</b><input type='text' name='question["+temp+"][]'/><br><ol id='selection"+temp+"'></ol><button onclick='creatSelection("+YO+")'>新增選項</button></li>");
        temp++;
    });



});

function creatSelection(a) {
    $("#selection"+a).append("<li>請輸入選項 :<input type='text' name='question[][]'/></li>");
}

</script>

<p>開始設計問卷</p>




<ol id="main">
</ol>

<button id="btn1">新增問題</button>


@stop