<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        $contact = ContactUs::create($validated);

        // 發送郵件通知
        try {
            Mail::to(config('mail.admin_email', 'admin@example.com'))
                ->send(new ContactFormMail($contact));
        } catch (\Exception $e) {
            // 記錄錯誤但不影響用戶體驗
            Log::error('聯絡表單郵件發送失敗：' . $e->getMessage());
        }

        return redirect()
            ->route('contact.index')
            ->with('success', '感謝您的來信！我們已收到您的訊息，將會盡快與您聯繫。');
    }
}
