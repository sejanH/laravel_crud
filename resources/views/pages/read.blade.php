@extends('layouts.master')
@section('title',$title)
@yield('navigation')
@section('content')
<h1>{{ucfirst($title)}}</h1>
<p class="alert alert-info">Read from database</p>
@stop