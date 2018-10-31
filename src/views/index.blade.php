@if(\View::exists('pub_theme::index'))
@include('pub_theme::index')
@else
	[frontend/views/index.blade.php] non esiste 'pub_theme::index'
@endif