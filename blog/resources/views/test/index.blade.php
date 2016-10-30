
@extends('Layout')

@section('content')
   
   @foreach ( $test as $v) 
   
    {{$v->id}}<br>{{$v->username}}
    <p>123123</p>
   @endforeach
@stop

