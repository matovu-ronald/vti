<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Excel;
use Illuminate\Http\Request;

class ImportServiceProviderController extends Controller
{
    public function create()
    {
        return view('imports.service-providers.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        Excel::import(new UsersImport, 'users.xlsx');

        return response()->json(['success' => 'Data imported Successfully']);
    }
}
