<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramsEnrollment;
use Illuminate\Support\Facades\Validator;

class ProgramsController extends Controller
{
    //
    public function allprograms()
    {
        return view('programs.index');
    }

    public function yoga()
    {
        return view('programs.yoga');
    }

    public function ramayana()
    {
        return view('programs.ramayana');
    }

    public function enrollProgram(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'country' => 'nullable|string|max:100',
            'program_type' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new enrollment record
        $enrollment = ProgramsEnrollment::create($request->all());

        // send confirmation email to the user, using mail function in php
        $to = $request->email;
        $subject = "Program Enrollment Acknowledgment: " . $request->program_type;
        $message = "Dear " . $request->name . ",\n\nThank you for enrolling in our " . $request->program_type . " program.\n\nWe will contact you with further details soon.\n\nBest regards,\nVishvam Foundation";
        $headers = "From:info@vishvamfoundation.org";
        mail($to, $subject, $message, $headers);

        // send emailt to admin at info@vishvamfoundation.org
        // $to = 'info@vishvamfoundation.org';
        $to = 'mallikarjun016.rymec@gmail.com';
        $subject = "New Program Enrollment: " . $request->program_type;
        $message = "A new enrollment has been received.\n\n";
        $message .= "Name: " . $request->name . "\n";
        $message .= "Email: " . $request->email . "\n";
        $message .= "Phone: " . $request->phone . "\n";
        $message .= "Date of Birth: " . $request->dob . "\n";
        $message .= "Country: " . $request->country . "\n";
        $message .= "Program Type: " . $request->program_type . "\n";
        $headers = "From:no-reply@vishvamfoundation.org";
        mail($to, $subject, $message, $headers);
        

        return redirect()->back()->with('success', 'Thank you for Enrolling. We will get back to you soon!');

    }
}
