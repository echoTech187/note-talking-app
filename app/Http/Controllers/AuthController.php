<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function signin()
    {
        return view('frontend.signin');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['message' => 'Email/Password tidak boleh kosong']);
        }

        if (auth('web')->attempt($request->only('email', 'password'))) {
            return response()->json(['success' => true]);
        }

        return response()->json(['message' => 'Email/Password yang anda masukkan salah']);
    }

    public function register()
    {
        return view('frontend.signup');
    }

    public function signup(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        if ($validate->fails()) {
            return response()->json(['message' => 'Semua data tidak boleh kosong']);
        }

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth('web')->login($user);
        return response()->json(['success' => true]);
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profileUpdate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . auth('web')->user()->id
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }
        $slug = \Illuminate\Support\Str::uuid()->toString();
        $user = auth('web')->user();
        $update = $user->update([
            'slug' => empty($user->slug) ? $slug : $user->slug,
            'name' => $request->name,
            'email' => $request->email,
            'password' => !empty($request->password) ? Hash::make($request->password) : $user->password
        ]);
        if ($update) {
            if ($request->avatar != null || $request->avatar != '' || $request->avatar != 'undefined') {
                $upload = $this->uploadAvatar($request, $user->id);
                if ($upload) {
                    if (auth('web')->user()->id == $user->id && ($request->password != null || $request->password != '')) {
                        return redirect()->route('logout');
                    } else {
                        return response()->json(['responseCode' => 200, 'responseStatus' => true, 'responseMessage' => 'User created successfully']);
                    }
                } else {
                    return response()->json(['responseCode' => 500, 'responseStatus' => false, 'responseMessage' => 'User created failed']);
                }
            } else {
                if (auth('web')->user()->id == $user->id && ($request->password != null || $request->password != '')) {
                    return redirect()->route('logout');
                } else {
                    return response()->json(['responseCode' => 200, 'responseStatus' => true, 'responseMessage' => 'User created successfully']);
                }
            }
        } else {
            return response()->json(['responseCode' => 500, 'responseStatus' => false, 'responseMessage' => 'User created failed']);
        }
    }

    public function logout()
    {
        auth('web')->logout();
        return redirect()->route('login');
    }

    private function uploadAvatar(Request $request, int $userId): bool
    {
        $user = \App\Models\User::findOrFail($userId);
        $avatarPath = "avatars/{$user->slug}";

        if (Storage::exists("public/{$user->avatar}")) {
            Storage::delete("public/{$user->avatar}");
        }

        $user->avatar = $request->file('avatar')->store($avatarPath, 'public');

        return $user->save();
    }
}
