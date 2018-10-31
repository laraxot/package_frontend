<?php

namespace XRA\Frontend\Controllers\Admin\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use XRA\Extend\Traits\CrudContainerItemTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;

use Zend;

class MetatagController extends Controller{
	
	public function index(Request $request){
		return redirect()->route('frontend.metatag.edit',[1]);
	}

	public function edit(Request $request){
		$metas=getConfig(['file'=>'metatag.php']);
		$view=CrudTrait::getView();
		return view($view)
				->with('view',$view)
				->with('rows',$metas);

	}

	public function update(Request $request){
		$data=$request->all();
		$fields=['_token','_method','_action'];
		foreach($fields as $field){
			unset($data[$field]);
		}
		setConfig(['file'=>'metatag.php','data'=>$data]);
		\Session::flash('status', 'Success '.\Carbon\Carbon::now());
		return redirect()->back();
		//ddd($data);

	}

}