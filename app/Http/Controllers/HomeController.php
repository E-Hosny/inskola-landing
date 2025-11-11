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
        // Set locale from session or use default (Arabic)
        $locale = Session::get('locale', 'ar');
        
        // If no locale in session, set Arabic as default
        if (!Session::has('locale')) {
            Session::put('locale', 'ar');
        }
        
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
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000'
        ]);

        Contact::create($validated);

        $locale = Session::get('locale', config('app.locale'));
        $successMessage = $locale === 'ar' 
            ? 'تم إرسال رسالتك بنجاح! شكراً لتواصلك معنا، سنرد عليك في أقرب وقت ممكن.'
            : 'Your message has been sent successfully! Thank you for contacting us, we will get back to you as soon as possible.';

        // Check if request is AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage
            ]);
        }

        return redirect()->back()->with('success', $successMessage);
    }
}

