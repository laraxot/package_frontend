<?php
namespace XRA\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//-----------
use TeamTNT\TNTSearch\TNTSearch;
use XRA\Blog\Models\Post;
//--- services
use XRA\Extend\Services\ThemeService;
use XRA\Extend\Traits\ArtisanTrait;

//------- Models --

class FrontEndController extends Controller
{
    public function index(Request $request)
    {
        if ($request->act=='routelist') {
            return ArtisanTrait::exe('route:list');
        }
        if (1 == $request->migrate) {
            return ArtisanTrait::exe('migrate');
        }
        if (1 == $request->scout) {
            //$ris=\Artisan::queue('scout:import',['model'=>]);
            //$ris=\Artisan::call('tntsearch:import',['model'=>'XRA\TakeAway\Models\AddOnCategory']);
            //Artisan::queue('scout:import {input}', ['App\\\Customer']);
            //dd($ris);
            $class = 'XRA\TakeAway\Models\AddOnCategory';
            $model = new $class();
            $tnt = new TNTSearch();
            $driver = config('database.default');
            $config = config('scout.tntsearch') + config("database.connections.$driver");
            $tnt->loadConfig($config);
            $tnt->setDatabaseHandle(app('db')->connection()->getPdo());
            $indexer = $tnt->createIndex($model->searchableAs().'.index');
            $indexer->setPrimaryKey($model->getKeyName());
            $fields = \implode(', ', \array_keys($model->toSearchableArray()));
            $query = "{$model->getKeyName()}, $fields";
            if ('' == $fields) {
                $query = '*';
            }
            $indexer->query("SELECT $query FROM {$model->getTable()};");
            $indexer->run();

            return '<br/>All ['.$class.'] records have been imported.';
        }

        $directory = base_path();

        if (!env('INSTALLED')) {
            // return redirect('/install/step1');//view('install::index');
        }
        $locale = \App::getLocale();
        $view = ThemeService::getView();

        return view($view)->with('locale', $locale)->with('view', $view);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $posts = Post::where('title', 'like', '%'.$query.'%')->get();

        $view = ThemeService::getView();

        return view($view, \compact('posts', 'query', 'view'));
    }
}
