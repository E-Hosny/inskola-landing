<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['showLoginForm', 'login']);
    }

    public function showLoginForm()
    {
        // If already logged in, redirect to admin dashboard
        if (Auth::check()) {
            return redirect()->route('admin.contacts');
        }

        $locale = Session::get('locale', 'ar');
        
        if (!Session::has('locale')) {
            Session::put('locale', 'ar');
        }
        
        App::setLocale($locale);
        
        return view('admin.login', compact('locale'));
    }

    public function login(Request $request)
    {
        $locale = Session::get('locale', 'ar');
        App::setLocale($locale);

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.contacts'));
        }

        return back()->withErrors([
            'email' => $locale === 'ar' 
                ? 'بيانات الدخول غير صحيحة.' 
                : 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }

    public function index()
    {
        // Set locale from session or use default (Arabic)
        $locale = Session::get('locale', 'ar');
        
        if (!Session::has('locale')) {
            Session::put('locale', 'ar');
        }
        
        App::setLocale($locale);
        
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        
        return view('admin.contacts', compact('contacts', 'locale'));
    }
}
