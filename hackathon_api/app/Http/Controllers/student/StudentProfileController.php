<?php

namespace App\Http\Controllers\student;

use Throwable;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreatResetPassword;
use App\Http\Requests\CreatUpdateProfile;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class StudentProfileController extends Controller
{
    public function UpdateProfil(CreatUpdateProfile $request)
    {
        $userUpdate = $request->validated();
        $user = JWTAuth::user();


        User::where('id' , $user->id)->update([
            'name' => $userUpdate["name"],
            'email' => $userUpdate["email"],
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'User Updated successfully',
            'userUpdate' => $userUpdate,

        ]);
    }
    public function IndexUser()
    {
        $user = JWTAuth::user();
        $userData = User::where('id', $user->id)->first();

        return response()->json([
            'statut' => 'success',
            'userData' => $userData,
        ], 200);
    }
    public function UpdatePassword(CreatResetPassword $request)
    {
        try {
            $passwordUpdate = $request->validated();

            $user = JWTAuth::user();

            User::where('id', $user->id)->update([

                'password' => Hash::make($passwordUpdate['password']),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully',
                'passwordUpdate' => $passwordUpdate,
            ]);

        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update password',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
