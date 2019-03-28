<?php

namespace App\Http\Controllers\Admin;

use App\Events\ServiceProviderCreated;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\BackpackUser;
use App\Models\BioProfile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ImportServiceProviderController extends Controller
{
    protected $uploadPath;
    private $userEmail = '';
    private $userPassword = '';

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
                    config(['excel.import.startRow' => 2]);
                    $users = Excel::toCollection(new UsersImport(), $successUploaded);
                    foreach ($users[0] as $user) {



                        if (empty($user[1])) {
                            $this->userEmail = $this->generateUniqueEmail($user[0]);
                        }else {
                            $this->userEmail = $user[1];
                        }
                        // Check if a bio profile with a certain phone number already exists
                        $bioData = BioProfile::where('phone', $user[2])->first();

                        // If the bio profile with the phone number already exists
                        // Update the user data associated with that bio profile
                        // Donot create a new user
                        if ($bioData) {
                            $this->userPassword = $this->randomPassword();
                            $userData = User::where('id', $bioData->user_id)->update([
                                'vti_id' => backpack_auth()->user()->vti->id,
                                'name' => $user[0],
                                //'email' => $this->userEmail,
                                //'password' => bcrypt($this->userPassword),
                            ]);

                            //$this->assignUserRoles($userData);

                            // event(new ServiceProviderCreated($userData, $this->userPassword));

                        }else {
                            $this->userPassword = $this->randomPassword();
                            $userData = User::where('email', $user[1])->updateOrCreate(['email' => $user[1]], [
                                'vti_id' => backpack_auth()->user()->vti->id,
                                'name' => $user[0],
                                'email' => $this->userEmail,
                                'email_verified_at' => Carbon::now(),
                                'password' => bcrypt($this->userPassword),
                            ]);

                            $this->assignUserRoles($userData);

                            $bioProfile = BioProfile::where('phone', $user[2])->updateOrCreate(['phone' => $user[2]], [
                                'user_id' => $userData->id,
                                'phone' => $user[2],
                                'address' => $user[3],
                                'course' => $user[4]
                            ]);

                            event(new ServiceProviderCreated($userData, $this->userPassword, $bioProfile));
                        }


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

    /**
     * Generate random password
     *
     * @return string
     */
    private function randomPassword()
    {
        return Str::random(8);
    }

    /**
     * Assign user roles
     *
     * @param $userData
     */
    private function assignUserRoles($userData)
    {
        $userData->roles()->detach();

        $roles = ['public', 'provider'];

        $userData->assignRole($roles);
    }

    /**
     * Generate unique Email
     *
     * @param $username
     * @return string
     */
    private function generateUniqueEmail($username) {
        $sluggedUsername = SlugService::createSlug(User::class, 'email', $username);
        return $sluggedUsername . mt_rand(2, 999) . "@" .strtolower(mini_logo(backpack_auth()->user()->vti->name)). ".com";
    }
}
