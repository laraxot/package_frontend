<?php

namespace XRA\Frontend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//-----------
use XRA\Blog\Models\Post;
use XRA\Extend\Library\XOT;
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
use XRA\Extend\Traits\ArtisanTrait;

use TeamTNT\TNTSearch\TNTSearch;

//------- Models --
use XRA\Fpb\Models\Grid;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        if ($request->routelist==1) {
            return ArtisanTrait::exe('route:list');
        }
        if ($request->migrate==1) {
            return ArtisanTrait::exe('migrate');
        }
        if ($request->scout==1) {
            //$ris=\Artisan::queue('scout:import',['model'=>]);
            //$ris=\Artisan::call('tntsearch:import',['model'=>'XRA\TakeAway\Models\AddOnCategory']);
            //Artisan::queue('scout:import {input}', ['App\\\Customer']);
            //dd($ris);
            $class='XRA\TakeAway\Models\AddOnCategory';
            $model = new $class();
            $tnt = new TNTSearch();
            $driver = config('database.default');
            $config = config('scout.tntsearch') + config("database.connections.$driver");
            $tnt->loadConfig($config);
            $tnt->setDatabaseHandle(app('db')->connection()->getPdo());
            $indexer = $tnt->createIndex($model->searchableAs().'.index');
            $indexer->setPrimaryKey($model->getKeyName());
            $fields = implode(', ', array_keys($model->toSearchableArray()));
            $query = "{$model->getKeyName()}, $fields";
            if ($fields == '') {
                $query = '*';
            }
            $indexer->query("SELECT $query FROM {$model->getTable()};");
            $indexer->run();
            return ('<br/>All ['.$class.'] records have been imported.');
        }


        $directory = base_path();
        
        if (!env('INSTALLED')) {
            // return redirect('/install/step1');//view('install::index');
        }
        $locale=\App::getLocale();
        $view=CrudTrait::getView();
        return view($view)->with('locale', $locale)->with('view',$view);
    }
    public function search(Request $request){
        $query = $request->get('query');
        $posts = Post::where('title','like','%'.$query.'%')->get();

        $view=CrudTrait::getView();
        return view($view,compact('posts','query','view'));

    }
}
