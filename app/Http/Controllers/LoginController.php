<?php

namespace App\Http\Controllers;

use App\Models\registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function Login_authentication(Request $request)
    {
        $rules = [
            'em' => 'required|email',
            'pwd' => 'required'
        ];
        $errors = [
            'em.required' => 'Email address can not be empty',
            'em.email' => 'Enter a valid email address',
            'pwd.required' => 'Password field cannot be empty'
        ];
        $validator = validator::make($request->all(), $rules, $errors);
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator);
            // return redirect()->route('student.login')->withErrors($validator);
        } 
        else {
            $count = registration::where('email', $request->em)->where('password', $request->pwd)->count();
            if ($count == 1) {
                $result = registration::where('email', $request->em)->first();
                // if ($result->status == 'Inactive') {
                //     session()->flash('error', 'Your account is not activated');
                //     return redirect('login');
                // }
                // else if ($result->status == 'Deleted') {
                //     session()->flash('error', 'Your account is Deleted kindly contact admin');
                //     return redirect('Reactivate_deleted_acount');
                // } 
                // else {
                    // session()->put('password', $result->password);
                    if ($result->role == "student") {
                        // echo "User";
                        session()->put('studentuser', $result->email);
                        return redirect()->route('student.issue_book');
                    } else {
                        session()->put('adminuser', $result->email);
                        return redirect()->route('admin.add_book');
                    }
                // }
            } 
            else {
                session()->flash('error', 'Invalid email or password');
                // return redirect()->route('student.login');
                return redirect('/');
            }
        }
    }

    public function Logout() {
        session()->forget('adminuser');
        session()->forget('studentuser');
        session()->flash('success', 'Your account was logged out successfully');
        // return redirect()->route('student.login');
        return redirect('/');
    }
}
