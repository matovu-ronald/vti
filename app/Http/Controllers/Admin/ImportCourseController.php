<?php

namespace App\Http\Controllers\Admin;

use App\Imports\CoursesImport;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportCourseController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path(config('vti.imports.directory.courses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('imports.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateRequest($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('items')) {

            foreach ($request->file('items') as $item) {
                $fileName = $item->getClientOriginalName();

                $destination = $this->uploadPath;
                $successUploaded = $item->move($destination, $fileName);

                if ($successUploaded) {
                    Excel::import(new CoursesImport, $successUploaded);
                    return response()->json(['message' => 'Courses imported successfully']);
                }


                /*if ($data->count()) {
                    foreach ($data as $key => $value) {
                        $courseList[] = [
                            'course_id' => 1,
                            'name' => $value->name,
                            'description' => $value->description
                        ];
                    }

                    if (!empty($courseList)) {
                        Course::insert($courseList);
                        return response()->json([
                            'message' => $data->count() . 'Courses imported successfully'
                        ]);
                    }
                }*/
            }


            \Log::info($request->all());

        } else {
            return response()->json([
                'message' => 'Warning, there is no file to import'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    

    /**
     * Validate Request Data
     *
     * @param $data
     * @return mixed
     */
    private function validateRequest($data)
    {
        $validator = \Validator::make($data,
            [
                'items' => ['required'],
            ], []);

        return $validator;
    }
}
