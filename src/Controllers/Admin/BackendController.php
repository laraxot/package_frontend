<?php

namespace XRA\Backend\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function index(Request $request)
    {
        return view('backend::admin.index');
    }
}
