<?php

namespace XRA\Frontend\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//-----------
//https://github.com/spatie/laravel-sitemap
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
//------ models---------
use XRA\Blog\Models\Post;
//------- traits -------
use XRA\Extend\Traits\CrudSimpleTrait as CrudTrait;
//use XRA\Extend\Traits\ImportTrait;


use File;



class SitemapController extends Controller{
	

	public function index(Request $request){
		\Debugbar::disable();
		$url=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
		//dd(config('app.url'));//sarebbe da settare questo
		$sitemap_path=public_path('sitemap.xml');
		//$e=SitemapGenerator::create($url)->writeToFile($sitemap_path);
		//echo '<br/>['.__LINE__.'] memory_get_usage :'.round(memory_get_usage()/(1024*1024),2);

		//$rows=Post::where('lang','it')->where('title','!=','')->ofParentId(0)->get();
		$rows=Post::where('lang','it')->whereRaw('guid = type')->get();
		$view=CrudTrait::getView();
		$xml=view($view)->with('url',$url)->with('rows',$rows);
		$xml=(string)$xml;
		$xml='<?xml version="1.0" encoding="UTF-8"?>'.$xml;
		return response($xml)->header('Content-Type', 'text/xml');

		echo '<hr/><h3>n. '.$rows->count().'</h3>';
		echo '<ol>';
		foreach($rows as $row){
			echo '<li><a href="'.$row->url.'">'.$row->title.'</a>';
			echo '<ol>';
			foreach($row->sons as $son){
				echo '<li><a href="'.$son->url.'">'.$son->title.'</a>';
			}
			echo '</ol>';
			echo '</li>';
		}
		echo '</ol>';


		//echo '<br/>['.__LINE__.'] memory_get_usage :'.round(memory_get_usage()/(1024*1024),2);

		/*
		$content = File::get($sitemap_path);
		$type='text/xml';
		//$type='application/xhtml+xml';
		return response($content, 200)->header('Content-Type', $type);
		*/
		//return redirect(asset('sitemap.xml'));
		
	}
}//end class