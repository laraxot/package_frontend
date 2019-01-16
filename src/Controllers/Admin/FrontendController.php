<?php



namespace XRA\Frontend\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use XRA\Extend\Services\ThemeService;
//--- services
use XRA\Extend\Traits\ArtisanTrait;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        if (1 == $request->routelist) {
            return ArtisanTrait::exe('route:list');
        }
        $view = ThemeService::getView();

        return view($view);
    }

    //end function
 //
}//end class
