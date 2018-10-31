@extends('adm_theme::layouts.app')
@section('page_heading','metatag list')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

{!! Form::bsOpen([],'update') !!}
@foreach($rows as $k=>$v)
	@include($view.'.item')
@endforeach
{!! Form::bs3Submit() !!}
{!! Form::close() !!}


@endsection
