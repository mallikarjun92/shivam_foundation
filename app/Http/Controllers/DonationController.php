<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function index()
    {
        return view('donate.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'pan' => 'nullable|string|max:10|regex:/[A-Z]{5}[0-9]{4}[A-Z]{1}/',
            'address' => 'nullable|string|max:500',
            'pincode' => 'nullable|string|max:6|min:6',
            'amount' => 'required|numeric|min:1',
            // 'payment_method' => 'required|string|in:upi,bank_transfer,credit_card,debit_card',
        ], [
            'pan.regex' => 'PAN must be in the format: AAAAA9999A',
            'pincode.max' => 'Pincode must be 6 digits',
            'pincode.min' => 'Pincode must be 6 digits',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate URN (Unique Reference Number)
        $urn = 'DON' . date('Ymd') . Str::upper(Str::random(6));

        // Create donation record
        $donation = Donation::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'pan' => $request->pan,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'urn' => $urn,
            'status' => 'pending'
        ]);

        return redirect()->route('donate.confirmation', $donation->id)
            ->with('success', 'Donation details submitted successfully!');
    }

    public function confirmation($id)
    {
        $donation = Donation::findOrFail($id);
        return view('donate.confirmation', compact('donation'));
    }

    public function updateTransaction(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'utr_number' => 'required|string|max:255|unique:donations,transaction_id'
        ], [
            'utr_number.unique' => 'This UTR number has already been used.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $donation = Donation::findOrFail($id);
        $donation->update([
            'transaction_id' => $request->utr_number,
            'status' => 'completed'
        ]);

        return redirect()->back()->with('success', 'UTR number updated successfully! Your donation is now complete.');
    }

    public function adminIndex()
    {
        $donations = Donation::latest()->paginate(20);
        return view('admin.donations.index', compact('donations'));
    }

    public function adminShow($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donations.show', compact('donation'));
    }

}