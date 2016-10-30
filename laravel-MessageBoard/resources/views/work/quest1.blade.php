@extends('layout')
@section('content')
<div class="container">





<form>
請選擇男生女生<br>
<input type="radio" name="gender" value="boy" > Boy<br>
<input type="radio" name="gender" value="girl"> Girl<br>
</form>
<form>
請選擇居住區域<br>
<input type="radio" name="location" value="Taipei" > 台北<br>
<input type="radio" name="location" value="Taoyuan"> 桃園<br>
</form>


<script>
$(document).ready(function(){
	$("#btn1").click(function(){

			$.post("/Work/tempsave",
   				{
    	    		answer: "\""+$('input[name="gender"]:checked').val()+"\",\""+$('input[name="location"]:checked').val()+"\","
    			},
    					function(data){
        			window.location.assign("HTTP://140.115.203.210/Work/quest2");
        			
        			console.log(data);
        			alert();
        			// function(data, status){
        			// 		alert("Data: " + data + "\nStatus: " + status);
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