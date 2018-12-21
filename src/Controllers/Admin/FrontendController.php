<?php

namespace XRA\Frontend\Controllers\Admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;

use XRA\Extend\Traits\CrudContainerItemTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;
//--- services
use XRA\Extend\Services\ThemeService;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routelist==1) {
            return ArtisanTrait::exe('route:list');
        }
        $view=ThemeService::getView();
        return view($view);
    }//end function
 //
}//end class
