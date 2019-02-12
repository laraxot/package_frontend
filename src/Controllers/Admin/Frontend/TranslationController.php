<?php
namespace XRA\Frontend\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//------services---------
use XRA\Extend\Services\ThemeService;
//--- traits
use XRA\Extend\Traits\ArtisanTrait; //da tramutare in service
use XRA\Extend\Traits\ArrayTrait;   //da tramutare in trait

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        if (1 == $request->routelist) {
            return ArtisanTrait::exe('route:list');
        }
        $params = \Route::current()->parameters();
        $trans = trans();
        $rows = $trans->getLoader()->namespaces();
        $view = ThemeService::getView();

        return view($view)
            ->with('view', $view)
            ->with('rows', $rows)
            //->with('lang',\App::getLocale())
            ->with($params)
            ->with('params', $params);
    }

    //end function

    public function show(Request $request)
    {
        $params = \Route::current()->parameters();
        //ddd($params);
        \extract($params);
        \App::setLocale($lang);
        $trans = trans();
        $rows = $trans->getLoader()->namespaces();
        $tmp = \explode('::', $namespace);
        if (\count($tmp) > 0) {
            $namespace = $tmp[0];
            $params['namespace'] = $namespace;
        }

        $path = $rows[$namespace].\DIRECTORY_SEPARATOR.$lang;
        if (!\File::exists($path)) {
            echo '<br/>Directory non esiste ['.$path.']';
            \File::makeDirectory($path, 0775, true);
        }
        $files = \File::allFiles($path);
        $view = ThemeService::getView();

        return view($view)
                ->with('params', $params)
                ->with($params)
                ->with('path', $path)
                ->with('view', $view)
                ->with('rows', $files)
                ->with('lang', \App::getLocale());
    }

    public function edit(Request $request)
    {
        $params = \Route::current()->parameters();
        \extract($params);
        $langs = \array_keys(config('laravellocalization.supportedLocales'));
        $langs[] = $lang;
        $rows = [];
        foreach ($langs as $il) {
            \App::setLocale($il);
            $tmp = trans($namespace); //array;
            if (\is_array($tmp)) {
                $rows = \array_merge($rows, $tmp);
            }
        }

        $view = ThemeService::getView();

        return view($view)
                ->with('params', $params)
                ->with($params)
                ->with('view', $view)
                ->with('rows', $rows)

                ;
    }

    public function update(Request $request)
    {
        $params = \Route::current()->parameters();
        \extract($params);

        $data = $request->all();
        $action = $data['_action']; //save_continue
        unset($data['_token']);
        unset($data['_method']);
        unset($data['_action']);
        //$trans=trans();
        //$rows=$trans->getLoader()->namespaces();
        //$file=$listum;
        //$filename=$rows[$namespace].DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.$file.'.php';
        $filename = $this->getLangFilename(['namespace' => $namespace]);
        if (!\file_exists(\dirname($filename))) {
            \File::makeDirectory(\dirname($filename));
        }
        ArrayTrait::save(['data' => $data, 'filename' => $filename]);

        \Session::flash('status', 'Modifica Eseguita! ['.$filename.']');

        return \Redirect::back();
    }

    public function getLangFilename($params)
    {
        $lang = \App::getLocale();
        \extract($params);
        $trans = trans();
        $rows = $trans->getLoader()->namespaces();
        $tmp = \explode('::', $namespace);
        $namespace = $tmp[0];
        $file = $tmp[1];
        $filename = $rows[$namespace].\DIRECTORY_SEPARATOR.$lang.\DIRECTORY_SEPARATOR.$file.'.php';

        return $filename;
    }
}//end class
