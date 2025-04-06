<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\SendMailQueue;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
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

        // 創建郵件隊列記錄
        SendMailQueue::create([
            'mailable_type' => ContactUs::class,
            'mailable_id' => $contact->id,
            'mail_class' => ContactFormMail::class,
            'to_email' => config('mail.admin_email', 'renfu.her@gmail.com'),
            'subject' => '新的聯絡表單提交'
        ]);

        return redirect()
            ->route('contact.index')
            ->with('success', '感謝您的來信！我們已收到您的訊息，將會盡快與您聯繫。');
    }
}
