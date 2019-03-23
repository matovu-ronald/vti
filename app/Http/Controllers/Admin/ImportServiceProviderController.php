<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ImportServiceProviderController extends Controller
{
    public function create()
    {
        return view('imports.create');
    }

    public function store()
    {
        return response()->json('success');
    }
}
