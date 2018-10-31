@extends('adm_theme::layouts.app')
@section('page_heading',$namespace)
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include($view.'.nav')
{!! Form::bsOpen([],'update') !!}
@foreach($rows as $k=>$v)
	@if(!is_array($v))
	{{ Form::bsText($k,$v,['label'=>$k]) }}
	@else
	@include($view.'.item',['rows'=>$v,'sub'=>$k])
	@endif
@endforeach
{!! Form::bs3Submit() !!}
{!! Form::close() !!}
{{--
<br class="clearfix"/>
@foreach($rows as $k=>$v)
	@if(!is_array($v))
	
	@else
	@php
		$params['listum']=$listum.'.'.$k;
	@endphp
	<a href="{{ route('settings.translation.lista.edit',$params) }}" class="btn btn-default">{{ $k }}</a>
	<br class="clearfix"/>
	@endif
@endforeach
--}}
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
	<hr/><hr/><hr/><hr/>
	

@endsection