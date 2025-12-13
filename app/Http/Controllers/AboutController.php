<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // About page data
        $aboutData = [
            'image' => 'images/bg_3.jpg',
            'title' => 'Welcome to Vishvam Foundation',
            'description' => [
                'The Vishvam Foundation, founded in 2022 in Hassan, Karnataka, exists to ensure that no child misses out on education due to hunger or lack of support. We’re committed to providing quality education, nutritious meals, safe shelter, and skill-building opportunities to children and families in our community.

Vision: Every individual empowered through education, nutrition, and opportunity.
Mission: Through our integrated programs, we provide learning support, nutrition, shelter, and livelihood training to create lasting positive change.'
            ],
            'mission' => 'To empower underprivileged children and families through education, nutrition, shelter, and skill development, fostering a brighter future for all.',
            'vision' => 'A world where every individual has access to quality education, nutritious food , and opportunities for personal and professional growth.',
        ];

        // Stats data
        $stats = [
            'children_served' => 1432800,
            'locations' => 'India',
            'volunteers' => 2500,
        ];
        
        // Team members data
        $team = [
            [
                'image' => 'images/team/person_1.jpg',
                'name' => 'MANJEGOWDA',
                'title' => 'PRESIDENT',
                'subtitle' => 'Businessman, Founder at Jnana Devige Vidya Samsthe, Hagare',
            ],
            [
                'image' => 'images/team/person_2.jpg',
                'name' => 'DHANIK R.M.',
                'title' => 'SECRETARY',
                'subtitle' => 'Student Pursuing MS in Sydney, Australia',
            ],
            [
                'image' => 'images/team/person_3.jpg',
                'name' => 'DR. SHRUTHI P.K.',
                'title' => 'TREASURER',
                'subtitle' => 'Research Analyst',
            ],
            [
                'image' => 'images/team/person_4.jpg',
                'name' => 'HARSHA RAMACHANDRA',
                'title' => 'MEMBER',
                'subtitle' => 'Entrepreneur, Founder at AVMCS Hassan & Deltin Cafe',
            ],
            [
                'image' => 'images/team/person_5.jpg',
                'name' => 'KOWSHIK GOWDA',
                'title' => 'MEMBER',
                'subtitle' => 'Entrepreneur, Founder at Skylead Aviation Academy',
            ],
            [
                'image' => 'images/team/person_6.jpg',
                'name' => 'DR. CHAITRA GOWDA',
                'title' => 'MEMBER',
                'subtitle' => 'Obstetrician & Gynecologist',
            ],
        ];

        // fetch volunteers from the database
        $volunteers = \App\Models\Volunteer::latest()->where('active', true)->take(6)->get();
        // $volunteers = \App\Models\Volunteer::latest()->get();

        // merge volunteers to make 6 if less than 6
        $volunteerCount = $volunteers->count();
        if ($volunteerCount < 6) {
            $additionalVolunteers = collect();
            for ($i = 0; $i < 6 - $volunteerCount; $i++) {
                $additionalVolunteers->push([
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'photo' => null,
                    'interests' => null,
                ]);
            }
            $volunteers = $volunteers->concat($additionalVolunteers);
        }

        return view('about.index', compact('aboutData', 'stats', 'team', 'volunteers'));
    }
}