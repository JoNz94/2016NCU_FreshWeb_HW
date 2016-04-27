<?php
function xss_protect($str){
  $new = "";
  for( $i=0 ; $i < strlen($str) ; $i++ ){
    if( $str[$i] == " "){
    	$new .= '&nbsp;';
    }elseif( $str[$i] == "<" ){
    	$new .= '&lt;';
    }elseif( $str[$i] == ">" ){
    	$new .= '&gt;';
    }elseif( $str[$i] == "'" ){
    	$new .= '&apos;';
    }elseif( $str[$i] == '"' ){
    	$new .= '&quot;';
    }else{
    	$new .= $str[$i];
    }
  }
  return $new;
}
?>