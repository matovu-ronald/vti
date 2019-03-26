<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\BioProfile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ImportServiceProviderController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path(config('vti.imports.directory.providers'));
    }

    public function create()
    {
        return view('imports.service-providers.create');
    }

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
                    $users = Excel::toCollection(new UsersImport(), $successUploaded);
                    foreach ($users[0] as $user) {

                        $userData = User::where('email', $user[1])->updateOrCreate(['email' => $user[1]], [
                            'vti_id' => backpack_auth()->user()->vti->id,
                            'name' => $user[0],
                            'email' => $user[1],
                            'email_verified_at' => Carbon::now(),
                            'password' => $this->randomPassword(),
                        ]);

                        $bioProfile = BioProfile::where('phone', $user[2])->updateOrCreate(['phone' => $user[2]], [
                            'user_id' => $userData->id,
                            'phone' => $user[2],
                            'address' => $user[3],
                            'course' => $user[4]
                        ]);

                        \Log::info($userData);
                    }

                    \Alert::success($users->count().'imported successfully');

                    return response()->json(['successMsg' => 'Users imported successfully']);
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
                'items.*' => ['mimes:xlsx']
            ], []);

        return $validator;
    }

    private function randomPassword()
    {
        return bcrypt(Str::random(8));
    }
}
