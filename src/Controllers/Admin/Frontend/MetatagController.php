<?php



namespace XRA\Frontend\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//--- services
use XRA\Extend\Services\ThemeService;

class MetatagController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('frontend.metatag.edit', [1]);
    }

    public function edit(Request $request)
    {
        $metas = getConfig(['file' => 'metatag.php']);
        $view = ThemeService::getView();

        return view($view)
                ->with('view', $view)
                ->with('rows', $metas);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $fields = ['_token', '_method', '_action'];
        foreach ($fields as $field) {
            unset($data[$field]);
        }
        setConfig(['file' => 'metatag.php', 'data' => $data]);
        \Session::flash('status', 'Success '.\Carbon\Carbon::now());

        return redirect()->back();
        //ddd($data);
    }
}
