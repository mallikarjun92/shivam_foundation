<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
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
            'user_agent' => $request->header('User-Agent'),
            'is_new' => true
        ]);

        // send email to admin using core mail function in php
        $to = 'info@vishvamfoundation.org';
        // $to = 'mallikarjun016.rymec@gmail.com';
        $subject = "New Contact Form Submission: " . $request->subject;
        $message = "You have received a new message from " . $request->name . " (" . $request->email . ").\n\n";
        $message .= "Message:\n" . $request->message . "\n\n";
        $headers = "From: no-reply@vishvamfoundation.org" . "\r\n";
        mail($to, $subject, $message, $headers);

        // try {
        //     Mail::to('sedafo5152@httpsu.com')->send(new ContactFormSubmitted($contact));
        // } catch (\Exception $e) {
        //     // Log error but don't break the user experience
        //     Log::error('Failed to send contact email: ' . $e->getMessage());
        // }

        // $messageBody = "You have received a new message from "
        //     . $request->name . " (" . $request->email . ").\n\n"
        //     . "Message:\n" . $request->message . "\n\n";

        // Mail::raw($messageBody, function ($msg) use ($request) {
        //     $msg->to('mallikarjun016.rymec@gmail.com')
        //         ->subject("New Contact Form Submission: " . $request->subject);
        // });
        

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }

    // public function listMessages()
    // {
    //     $messages = Contact::latest()->paginate(20);
    //     return view('admin.contacts.index', compact('messages'));
    // }
    
    public function listMessages(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $query = Contact::query();

        if ($filter === 'new') {
            $query->where('is_new', true);
        }

        if ($filter === 'read') {
            $query->where('is_new', false);
        }

        // $messages = $query->latest()->paginate(10);
        $messages = $query->latest()->paginate(10)->appends($request->query());

        $unreadCount = Contact::where('is_new', true)->count();

        return view('admin.contacts.index', compact('messages', 'unreadCount', 'filter'));
    }

    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);

        if ($message->is_new) {
            $message->update(['is_new' => false]);
        }

        return view('admin.contacts.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted successfully.');
    }
}