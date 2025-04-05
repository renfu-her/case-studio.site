<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string'
        ]);

        $validated['is_read'] = false;
        ContactUs::create($validated);

        return redirect()
            ->route('contact.index')
            ->with('success', '感謝您的來信！我們已收到您的訊息，將會盡快與您聯繫。');
    }
}
