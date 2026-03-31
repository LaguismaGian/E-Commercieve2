<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Shows the contact page
    public function index()
    {
        return view('contact');
    }

    // Handles the form submission
    public function submit(Request $request)
    {
        // Validate the data
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|min:5',
        ]);

        // Logic: This is where you would normally send an email or save to DB.
        // For now, we just redirect back with a success message.
        
        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}