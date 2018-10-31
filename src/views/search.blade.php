@if(\View::exists('pub_theme::search/search'))
@include('pub_theme::search/search')
@else
	[frontend/views/search.blade.php] non esiste 'pub_theme::search/search'
@endif