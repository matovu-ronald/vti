<?php

namespace App\Http\Controllers\Admin;

use App\Events\ServiceProviderCreated;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\BioProfile;
use App\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

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
                    $users = Excel::toCollection(new UsersImport(), $successUploaded);
                    foreach ($users[0] as $user) {
                        if (empty($user['email'])) {
                            $this->userEmail = $this->generateUniqueEmail($user['name']);
                        } else {
                            $this->userEmail = $user['email'];
                        }
                        // Check if a bio profile with a certain phone number already exists
                        $bioData = BioProfile::where('phone', $user['phone'])->first();

                        // If the bio profile with the phone number already exists
                        // Update the user data associated with that bio profile
                        // Donot create a new user
                        if ($bioData) {
                            $userData = User::where('id', $bioData->user_id)->update([
                                'name' => $user['name'],
                            ]);

                        //$this->assignUserRoles($userData);

                            // event(new ServiceProviderCreated($userData, $this->userPassword));
                        } else {
                            $this->userPassword = $this->randomPassword();
                            $userData = User::where('email', $user['email'])->updateOrCreate(['email' => $user['email']], [
                                'vti_id' => backpack_auth()->user()->vti->id,
                                'name' => $user['name'],
                                'email' => $this->userEmail,
                                'email_verified_at' => Carbon::now(),
                                'password' => bcrypt($this->userPassword),
                            ]);

                            $this->assignUserRoles($userData);

                            $bioProfile = BioProfile::where('phone', $user['phone'])->updateOrCreate(['phone' => $user['phone']], [
                                'user_id' => $userData->id,
                                'phone' => $user['phone'],
                                'address' => $user['address'],
                                'course' => $user['course'],
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
                'items.*' => ['mimes:xlsx'],
            ], []);

        return $validator;
    }

    /**
     * Generate random password.
     *
     * @return string
     */
    private function randomPassword()
    {
        return Str::random(8);
    }

    /**
     * Assign user roles.
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
     * Generate unique Email.
     *
     * @param $username
     * @return string
     */
    private function generateUniqueEmail($username)
    {
        $sluggedUsername = SlugService::createSlug(User::class, 'email', $username);

        return $sluggedUsername.mt_rand(2, 999).'@'.strtolower(mini_logo(backpack_auth()->user()->vti->name)).'.com';
    }
}
