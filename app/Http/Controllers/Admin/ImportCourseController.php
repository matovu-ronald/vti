<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CoursesImport;
use App\Models\Course;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportCourseController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path(config('vti.imports.directory.courses'));
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
                    $courses = Excel::toCollection(new CoursesImport, $successUploaded);
                    \Log::info(print_r($courses, true));
                    foreach ($courses[0] as $course) {
                        Course::where('name', $course['name'])->updateOrCreate(['name' => $course['name']], [
                            'vti_id' => backpack_auth()->user()->vti->id,
                            'name' => $course['name'],
                            'description' => $course['description'],
                        ]);
                    }
                    \Alert::success($courses->count().'imported successfully');

                    return response()->json(['successMsg' => 'Courses imported successfully']);
                }
            }
        } else {
            return response()->json([
                'message' => 'Warning, there is no file to import',
            ]);
        }
    }

    /**
     * Validate Request Data.
     *
     * @param $data
     * @return mixed
     */
    private function validateRequest($data)
    {
        $validator = \Validator::make($data,
            [
                'items' => ['required'],
                'items.*' => ['mimes:xlsx'],
            ], []);

        return $validator;
    }
}
