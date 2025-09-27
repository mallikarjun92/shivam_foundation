<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    public function index()
    {
        // Contact information data
        $contactInfo = [
            'address' => '	#13, Siddeshwara complex, behind Indian bank, near AVK college road, Hassan, Karnataka 573201',
            'phone' => '+91 78922 84158',
            'email' => 'info@vishvamfoundation.org',
            'website' => 'vishvamfoundation.org'
        ];

        return view('contact.index', compact('contactInfo'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store contact message
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        // Send email notification (uncomment when you set up email)
        // try {
        //     Mail::to('admin@example.com')->send(new ContactFormSubmitted($contact));
        // } catch (\Exception $e) {
        //     // Log error but don't break the user experience
        //     \Log::error('Failed to send contact email: ' . $e->getMessage());
        // }

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }

    public function listMessages()
    {
        $messages = Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('messages'));
    }

    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('message'));
    }
}