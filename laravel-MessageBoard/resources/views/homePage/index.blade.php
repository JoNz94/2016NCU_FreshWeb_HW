@extends('layout')
@section('content')
<div class="container">
	<h1>
	@if (\Auth::user() === null)
    	<code>訪客</code><p>您好！歡迎來到Bear Test ！</p>
    	
    @else
    	<code>{!! \Auth::user()->name !!}</code><p>您好！歡迎來到Bear Test ！</p>
    @endif
	</h1>


		<div class="remodal-bg">
		  <div id="qunit"></div>
		  <a href="#" data-remodal-target="modal">Callddddddddddddddddddddddddddddd</a>
		</div>
<!--  -->
		<div class="remodal" data-remodal-id="modal">
		  <a data-remodal-action="close" class="remodal-close"></a>

		  <a data-remodal-action="cancel" class="remodal-cancel" href="#">Cancel</a>
		  <a data-remodal-action="confirm" class="remodal-confirm" href="#">OK</a>
		</div>

		<div class="remodal" data-remodal-id="modal2"
		  data-remodal-options="hashTracking: false,
		    closeOnConfirm:false,closeOnCancel:  false, closeOnEscape: false , closeOnOutsideClick: false,
		    modifier : without-animation with-test-class">

		  <a data-remodal-action="close" class="remodal-close"></a>
		  <a data-remodal-action="cancel" class="remodal-cancel" href="#">Cancel</a>
		  <a data-remodal-action="confirm" class="remodal-confirm" href="#">OK</a>
		</div>

		<div data-remodal-id="modal3">
		  <a data-remodal-action="close" class="remodal-close">dddddddddddd</a>
		</div>

		<div class="remodal" data-remodal-id="!modal4/test">
		  <a data-remodal-action="close" class="remodal-close"></a>
		</div>
<!--  -->
			<section>
				<select class="cs-select cs-skin-overlay">
					<option value="" disabled selected>Select a Dinner</option>
					<optgroup label="Mediterranean Tastes">
						<option value="1">Salmon Pecorino with Girolle Sauce</option>
						<option value="2">Pan-fried Gnocci in Tomato Sauce</option>
						<option value="3">Maple Glazed Potatoes in Truffle Reduction</option>
						<option value="4">Tenderstem Broccoli in Artichoke Vinaigrette</option>
					</optgroup>
					<optgroup label="Nordic Refreshment">
						<option value="5">Smoked Herring in Oyster Gel</option>
						<option value="6">Broad Beans in Sea Rosemary Sauce</option>
						<option value="7">Grilled Asparagus with Pickled Apple</option>
						<option value="8">Cold-smoked Eel with Sea Purslane </option>
					</optgroup>
				</select>
			</section>
	<script src="{{ asset('js/classie.js') }}"></script>
    <script src="{{ asset('js/selectFx.js') }}"></script>
    <script>
      (function() {
        [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {  
          new SelectFx(el);
        } );
      })();
    </script>
<!--  -->
</div>
@stop