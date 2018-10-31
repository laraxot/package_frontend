@extends('adm_theme::layouts.app')
@section('page_heading','translations')
@section('content')
@include('backend::includes.flash')
@include('backend::includes.components')

@include($view.'.nav');

<table class="table">
@foreach($rows as $k=>$v)
<tr>
	<td>{{ $k }}</td>
	<td>{{ $v }}</td>
	<td><a class="btn btn-default" href="{{ route('settings.translation.lista.index',['lang'=>$lang,'namespace'=>$k]) }}"><i class="fa fa-eye"></i></a></td>
</tr>
@endforeach
</table>

@endsection
