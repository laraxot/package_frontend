@foreach($rows as $k=>$v)
	@if(!is_array($v))
	{{ Form::bsText($sub.'['.$k.']',$v,['label'=>$sub.'['.$k.']']) }}
	@else
	@include($view.'.item',['rows'=>$v,'sub'=>$sub.'['.$k.']'])
	@endif
@endforeach
