<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
Use App\Models\Admin;
Use App\Models\Post;
Use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    public function dashboard(){
        $post = Post::get()->count();
        $admin = Admin::get()->count();
        $coustomer = User::get()->count();
        return view('admin.dashboard')->with(['post'=>$post,'admin'=>$admin,'coustomer'=>$coustomer]);
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules =[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'Email is required!',
                'email.email' => 'Valid Email is required!',
                'password.required' => 'Password is required!',
            ];
            $this->validate($request,$rules,$customMessages);
            if (Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])) {
                return redirect('admin/dashboard');
             }else{
                return redirect()->back()->with('error_message','Invalid Password or Email!');
             }
        }
        return view('admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
