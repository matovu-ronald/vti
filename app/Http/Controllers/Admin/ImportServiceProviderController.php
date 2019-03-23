<?php

namespace App\Http\Controllers\Admin;

use Excel;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;

class ImportServiceProviderController extends Controller
{
    public function create()
    {
        return view('imports.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        Excel::import(new UsersImport, 'users.xlsx');

        return response()->json(['success' => 'Data imported Successfully']);
    }
}
