@extends('adm_theme::layouts.app')
@section('page_heading','translations')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')
{{--
@include($view.'.nav');
--}}
base path :{{ base_path() }} <br/>
public path: {{ public_path() }} <br/>

<table class="table">
@foreach($rows as $k=>$v)
@php
	$v1=$v;
	$v=realpath($v);
@endphp
<tr>
	<td>{{ $k }}</td>
	<td>@if(starts_with($v,base_path()))
		<span class="text-green">[base path]</span>{{ substr($v, strlen(base_path())) }}
		@elseif(starts_with($v,public_path()))
		<span class="text-blue">[public path]</span>{{ substr($v, strlen(public_path())) }}
		@else
		<span class="text-red">[not recognized]</span>[{{ $v }}][{{ $v1 }}]
		@php
			@mkdir($v1);
		@endphp
		@endif

	</td>
	<td>
		@php
			$params['id_translation']=$k;
		@endphp
	  	<a class="btn btn-default" href="{{ route('frontend.translation.show',$params) }}"><i class="fa fa-eye"></i></a> 
	</td>
</tr>
@endforeach
</table>

@endsection
