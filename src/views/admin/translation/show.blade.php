@extends('adm_theme::layouts.app')
@section('page_heading','translations')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include($view.'.nav')
<h3>[{{ $path }}]</h3>

<table class="table">
@foreach($rows as $k=>$v)
<tr>
	@php
		$row=str_replace('.php','',$v->getFilename());
		//$params['listum']=$row;
		$params['namespace']=$namespace.'::'.$row;
	@endphp
	<td>{{ $namespace }}::{{ $row }}</td>
	<td><a class="btn btn-default" href="{{ route('frontend.translation.edit',$params) }}"><i class="fa fa-eye"></i></a></td>
</tr>
@endforeach
</table>

@endsection
