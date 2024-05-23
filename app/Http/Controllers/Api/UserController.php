<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthUserRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Store new user
    public function store(StoreUserRequest $request)
    {
        // Validate the from data
        if ($request->validated()) {
            $data = $request->validated();
            $data['password'] = Hash::make($request->password);
            User::create($data);
            //Return the response
            return response()->json([
                'message' => 'Account created Successfully'
            ]);
        }
    }

     // Log in users new user
     public function auth(AuthUserRequest $request)
     {
         // Validate the from data
         if ($request->validated()) {
            $user = User::whereEmail($request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                //return an error
                throw ValidationException::withMessages([
                    'email' => 'These credentials do not match our records'
                ]);
            } else {
                return UserResource::make($user)->additional([
                    'access_token' => $user
                    ->createToken('new_user')
                    ->plainTextToken
                ]);
            }
         }
     }
}
