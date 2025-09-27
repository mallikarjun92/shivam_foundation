<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Stats data
        $stats = [
            'children_served' => 1432800,
            'locations' => 'India'
        ];

        // Services data
        $services = [
            [
                'icon' => 'flaticon-donation-1',
                'title' => 'Make Donation',
                'description' => 'Your contribution helps us provide food, education, and essential resources to those in need. Every donation makes a real difference in someone’s life.'
            ],
            [
                'icon' => 'flaticon-charity',
                'title' => 'Become A Volunteer',
                'description' => 'Join our team of volunteers and be the change you want to see. Whether it’s time, skills, or compassion, your support brings hope to communities.'
            ],
            [
                'icon' => 'flaticon-donation',
                'title' => 'Sponsorship',
                'description' => 'Support a child, project, or cause through sponsorship. Your commitment ensures long-term impact and sustainable growth for those we serve.'
            ]
        ];

        // Causes data
        $causes = [
            [
                'image' => '/images/causes/education_1.jpeg',
                'title' => 'Education',
                'description' => 'We aim to provide quality education to enable the residents to always be at par with what society requires and make a career for them',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => '/images/causes/shelter_1.jpg',
                'title' => 'Shelter',
                'description' => 
                'We aim to provide a roof over the head of the residents who are a part of our outreach with nutritious food being served',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => '/images/causes/skills_1.jpg',
                'title' => 'Skill Development & vocational Training',
                'description' => 
                'We aim to enhance the skill sets amongst our residents by providing basic training in various spheres for a sustainable development.',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => '/images/causes/wellbeing_1.jpg',
                'title' => 'Physical & Mental Wellbeing',
                'description' => 
                'We aim to show the path of righteousness to each resident by bathing them in the light of meditation and positive introspection.',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => '/images/causes/community_1.jpg',
                'title' => 'Community Development',
                'description' => 
                'We aim to inculcate the notion of being a positive contributor to society in the young minds of our residents.',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ]
        ];

        // Donations data
        $donations = [
            [
                'image' => 'images/person_1.jpg',
                'name' => 'Ivan Jacobson',
                'time' => 'Donated Just now',
                'amount' => 300,
                'cause' => 'Children Needs Food'
            ],
            [
                'image' => 'images/person_2.jpg',
                'name' => 'Ivan Jacobson',
                'time' => 'Donated Just now',
                'amount' => 150,
                'cause' => 'Children Needs Food'
            ],
            [
                'image' => 'images/person_3.jpg',
                'name' => 'Ivan Jacobson',
                'time' => 'Donated Just now',
                'amount' => 250,
                'cause' => 'Children Needs Food'
            ]
        ];

        // fetch the gallery images from the database
        $galleryFromDB = \App\Models\Gallery::latest()->take(8)->get();
        $gallery = [];

        // dd($galleryFromDB);

        foreach ($galleryFromDB as $image) {
            $gallery[] = 'storage/'.$image->image;
        }

        if(empty($gallery)) {
            // Gallery data
            $gallery = [
                'images/cause-2.jpg',
                'images/cause-3.jpg',
                'images/cause-4.jpg',
                'images/cause-5.jpg',
                'images/cause-6.jpg',
                'images/image_3.jpg',
                'images/image_1.jpg',
                'images/image_2.jpg'
            ];
        }

        // fetch the blogs from the database
        $blogsFromDB = \App\Models\Blog::latest()->take(3)->get();

        $blogs = [];
        foreach ($blogsFromDB as $blog) {
            $blogs[] = [
                'image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('images/default_blog_image.jpg'),
                'date' => $blog->created_at->format('M d, Y'),
                'author' => $blog->author,
                'comments' => $blog->comments_count ?? 0,
                'title' => $blog->title,
                'excerpt' => \Illuminate\Support\Str::limit($blog->content, 100),
                'slug' => $blog->slug,
                'link' => route('blog.showBlogDetail', $blog->slug)
            ];
        }

        $eventsData = \App\Models\Event::latest()->take(3)->get();
        $events = [];

        foreach ($eventsData as $event) {
            $events[] = [
                'image' => $event->image ? 'storage/'.$event->image : asset('images/default_event_image.jpg'),
                'date' => $event->event_date->format('M d, Y'),
                'organizer' => $event->organizer,
                // 'comments' => $event->comments_count ?? 0,
                'title' => $event->title,
                'time' => $event->event_date->format('h:i A'),
                'venue' => $event->location,
                'description' => \Illuminate\Support\Str::limit($event->description, 100),
                'excerpt' => $event->excerpt,
                'slug' => $event->slug,
                'link' => route('events.show', $event->slug)
            ];
        }

        // Events data
        // $events = [
        //     [
        //         'image' => 'images/event-1.jpg',
        //         'date' => 'Sep. 10, 2018',
        //         'organizer' => 'Admin',
        //         'comments' => 3,
        //         'title' => 'World Wide Donation',
        //         'time' => '10:30AM-03:30PM',
        //         'venue' => 'Venue Main Campus',
        //         'description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
        //     ],
        //     [
        //         'image' => 'images/event-2.jpg',
        //         'date' => 'Sep. 10, 2018',
        //         'organizer' => 'Admin',
        //         'comments' => 3,
        //         'title' => 'World Wide Donation',
        //         'time' => '10:30AM-03:30PM',
        //         'venue' => 'Venue Main Campus',
        //         'description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
        //     ],
        //     [
        //         'image' => 'images/event-3.jpg',
        //         'date' => 'Sep. 10, 2018',
        //         'organizer' => 'Admin',
        //         'comments' => 3,
        //         'title' => 'World Wide Donation',
        //         'time' => '10:30AM-03:30PM',
        //         'venue' => 'Venue Main Campus',
        //         'description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
        //     ]
        // ];

        // Recent blogs for footer
        $recentBlogs = $blogs; // Using the same blogs fetched from the database

        return view('home', compact(
            'stats', 
            'services', 
            'causes', 
            'donations', 
            'gallery', 
            'blogs', 
            'events',
            'recentBlogs',
            // 'heroContent'
        ));
    }
}