@extends('layout')
@section('content')
<div class="container">
<form>
XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
請選擇水果<br>
<input type="radio" name="fruit" value="apple" > Apple<br>
<input type="radio" name="fruit" value="orange"> Orange<br>
</form>
<form>
請選擇1  或  2<br>
<input type="radio" name="location" value="1" > 1<br>
<input type="radio" name="location" value="2" > 2<br>
</form>


<script>
$(document).ready(function(){
	$("#btn1").click(function(){

			$.post("/Work/save",
   				{
    	    		answer: "\""+$('input[name="fruit"]:checked').val()+"\",\""+$('input[name="location"]:checked').val(),
    			},
    					function(data){
        					console.log(data);
        					alert();
    		});

		// alert(
		// 	$('input[name="gender"]:checked').val()+
		// 	$('input[name="location"]:checked').val()
		// );
	});
});
   

</script>

<button id="btn1">Get External Content</button>

</div>
@stop