<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000'
        ]);

        Contact::create($validated);

        return redirect()->route('home')->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}

