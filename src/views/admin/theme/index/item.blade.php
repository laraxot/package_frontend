<div class="col-lg-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			{{$row->id}}
		</div>
		<div class="panel-body" style="text-align:center;">
			
			<img src="{{ $row->img_src }}" style="width:250px;height:250px;"/>
			
		</div>
		<div class="panel-footer">
			@php
				$params['id_theme']=$row->id;
			@endphp
			<a href="{{ route('frontend.theme.edit',$params) }}" class="btn">Activate</a>
		</div>
	</div>
</div>