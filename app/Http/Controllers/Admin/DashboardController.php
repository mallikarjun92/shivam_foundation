<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // dd("13");
        //fetch count of blogs, events, volunteers, donations
        $blogCount = \App\Models\Blog::count();
        $eventCount = \App\Models\Event::count();
        $volunteerCount = \App\Models\Volunteer::count();
        $donationCount = \App\Models\Donation::count();

        $stats = [
            'blogs' => $blogCount,
            'events' => $eventCount,
            'volunteers' => $volunteerCount,
            'donations' => $donationCount,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
