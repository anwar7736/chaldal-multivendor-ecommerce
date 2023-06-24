<?php

namespace App\Http\Controllers\WEB\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth, Hash, Image, File, Str;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'exists:users'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'status' => true,
                'msg' => 'Login success',
                'url' => route('front.home'),
            ], 200);
        }

        return response()->json([
            'status' => false,
            'msg' => 'Email or password is incorrect',
        ]);

        

    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        return redirect()->route('front.home');
    }
    
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if($user)
        {
            Auth::login($user);

            return response()->json([
                'status' => true,
                'msg' => 'Register success',
                'url' => route('front.home'),
            ], 200);

        }

        return response()->json([
            'status' => false,
            'msg' => 'Something went wrong!',
        ], 422);

    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'min:4', 'confirmed'],
        ]);

        if(Hash::check($request->old_password, Auth::user()->password))
        {
            $user = User::findOrFail(Auth::id());
            $data = $user->update([
                'password' => Hash::make($request->password)
            ]);

            // dd($data);

            return response()->json([
                'status' => true,
                'msg' => 'Password updated',
            ], 200);

        }

        return response()->json([
            'status' => false,
            'msg' => 'Old password is incorrect!',
        ]);

    }    
    
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', 'unique:users,phone,'.Auth()->user()->id],
            'address' => ['required'],
        ]);

        if($request->hasFile('image'))
        {
            $old_image = Auth::user()->image;
            $user_image = $request->image;
            $extention = $user_image->getClientOriginalExtension();
            $image_name = Str::slug($request->name).date('-Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_name = 'uploads/custom-images/'.$image_name;

            Image::make($user_image)
                ->save(public_path().'/'.$image_name);

            $data['image'] = $image_name;

            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
        }

        $user = User::findOrFail(Auth::id());
        $user->update($data);

        return response()->json([
            'status' => true,
            'msg' => 'Profile Updated',
        ], 200);

    }
}
