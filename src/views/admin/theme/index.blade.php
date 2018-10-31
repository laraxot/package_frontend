@extends('adm_theme::layouts.app')
@section('page_heading','themes list')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')


@foreach($rows as $row)
	@include($view.'.item')
	
@endforeach

@endsection