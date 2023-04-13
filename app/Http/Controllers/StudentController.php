<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.student_login');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $check = $request->all();
        if (Auth::guard('student')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('student.dashboard');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    }

    public function dashboard()
    {
        $infos = Student::select('id', 'name', 'email', 'age', 'address')->where('id', '=', Auth::guard('student')->user()->id)->get();
        return view('student.student_dashboard', compact('infos'));
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('login_form');
    }
}
