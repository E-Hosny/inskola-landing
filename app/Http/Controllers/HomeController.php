<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        // Set locale from session or use default
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);
        
        return view('home');
    }

    public function switchLanguage($locale)
    {
        if (in_array($locale, ['ar', 'en'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
        
        return redirect()->back();
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000'
        ]);

        Contact::create($validated);

        $locale = Session::get('locale', config('app.locale'));
        $successMessage = $locale === 'ar' 
            ? 'شكراً لك على رسالتك! سنتواصل معك قريباً.'
            : 'Thank you for your message! We will get back to you soon.';

        return redirect()->route('home')->with('success', $successMessage);
    }
}

