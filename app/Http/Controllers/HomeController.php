<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Stats data
        $stats = [
            'children_served' => 14328,
            'countries' => 'India'
        ];

        // Services data
        $services = [
            [
                'icon' => 'flaticon-donation-1',
                'title' => 'Make Donation',
                'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.'
            ],
            [
                'icon' => 'flaticon-charity',
                'title' => 'Become A Volunteer',
                'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.'
            ],
            [
                'icon' => 'flaticon-donation',
                'title' => 'Sponsorship',
                'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.'
            ]
        ];

        // Causes data
        $causes = [
            [
                'image' => 'https://static.wixstatic.com/media/11062b_55c06712741b4092a715cc02a6488278~mv2.jpeg',
                'title' => 'Education',
                'description' => 'We aim to provide quality education to enable the residents to always be at par with what society requires and make a career for them',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => 'https://static.wixstatic.com/media/nsplsh_93693ee4f0a74d049286c30a0679cde9~mv2.jpg/v1/crop/x_456,y_0,w_2736,h_2736/fill/w_694,h_694,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Image%20by%20Fernando%20Santander.jpg',
                'title' => 'Shelter',
                'description' => 
                'We aim to provide a roof over the head of the residents who are a part of our outreach with nutritious food being served',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => 'https://static.wixstatic.com/media/nsplsh_78457939514e5543645249~mv2_d_4040_2694_s_4_2.jpg/v1/crop/x_673,y_0,w_2694,h_2694/fill/w_694,h_694,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Image%20by%20Quino%20Al.jpg',
                'title' => 'Skill Development & vocational Training',
                'description' => 
                'We aim to enhance the skill sets amongst our residents by providing basic training in various spheres for a sustainable development.',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => 'https://static.wixstatic.com/media/nsplsh_78787752756a4158637459~mv2_d_6016_4000_s_4_2.jpg/v1/crop/x_1008,y_0,w_4000,h_4000/fill/w_694,h_694,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Image%20by%20Jo%C3%A3o%20Rafael.jpg',
                'title' => 'Physical & Mental Wellbeing',
                'description' => 
                'We aim to show the path of righteousness to each resident by bathing them in the light of meditation and positive introspection.',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ],
            [
                'image' => 'https://static.wixstatic.com/media/nsplsh_3361566c57502d37626738~mv2_d_3937_2625_s_4_2.jpg/v1/crop/x_656,y_0,w_2625,h_2625/fill/w_694,h_694,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/Image%20by%20Mikael%20Kristenson.jpg',
                'title' => 'Community Development',
                'description' => 
                'We aim to inculcate the notion of being a positive contributor to society in the young minds of our residents.',
                'last_donation' => '1w ago',
                'progress' => 28,
                'raised' => 12000,
                'goal' => 30000
            ]
            // [
            //     'image' => 'images/cause-1.jpg',
            //     'title' => 'Clean water for the urban area',
            //     'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life',
            //     'last_donation' => '1w ago',
            //     'progress' => 28,
            //     'raised' => 12000,
            //     'goal' => 30000
            // ],
            // [
            //     'image' => 'images/cause-2.jpg',
            //     'title' => 'Clean water for the urban area',
            //     'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life',
            //     'last_donation' => '1w ago',
            //     'progress' => 28,
            //     'raised' => 12000,
            //     'goal' => 30000
            // ],
            // [
            //     'image' => 'images/cause-3.jpg',
            //     'title' => 'Clean water for the urban area',
            //     'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life',
            //     'last_donation' => '1w ago',
            //     'progress' => 28,
            //     'raised' => 12000,
            //     'goal' => 30000
            // ],
            // [
            //     'image' => 'images/cause-4.jpg',
            //     'title' => 'Clean water for the urban area',
            //     'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life',
            //     'last_donation' => '1w ago',
            //     'progress' => 28,
            //     'raised' => 12000,
            //     'goal' => 30000
            // ],
            // [
            //     'image' => 'images/cause-5.jpg',
            //     'title' => 'Clean water for the urban area',
            //     'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life',
            //     'last_donation' => '1w ago',
            //     'progress' => 28,
            //     'raised' => 12000,
            //     'goal' => 30000
            // ],
            // [
            //     'image' => 'images/cause-6.jpg',
            //     'title' => 'Clean water for the urban area',
            //     'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life',
            //     'last_donation' => '1w ago',
            //     'progress' => 28,
            //     'raised' => 12000,
            //     'goal' => 30000
            // ]
        ];

        // Donations data
        $donations = [
            // [
            //     'image' => 'images/person_1.jpg',
            //     'name' => 'Ivan Jacobson',
            //     'time' => 'Donated Just now',
            //     'amount' => 300,
            //     'cause' => 'Children Needs Food'
            // ],
            // [
            //     'image' => 'images/person_2.jpg',
            //     'name' => 'Ivan Jacobson',
            //     'time' => 'Donated Just now',
            //     'amount' => 150,
            //     'cause' => 'Children Needs Food'
            // ],
            // [
            //     'image' => 'images/person_3.jpg',
            //     'name' => 'Ivan Jacobson',
            //     'time' => 'Donated Just now',
            //     'amount' => 250,
            //     'cause' => 'Children Needs Food'
            // ]
        ];

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

        // Blog data
        $blogs = [
            [
                'image' => 'images/image_1.jpg',
                'date' => 'Sept 10, 2018',
                'author' => 'Admin',
                'comments' => 3,
                'title' => 'Hurricane Irma has devastated Florida',
                'excerpt' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
            ],
            [
                'image' => 'images/image_2.jpg',
                'date' => 'Sept 10, 2018',
                'author' => 'Admin',
                'comments' => 3,
                'title' => 'Hurricane Irma has devastated Florida',
                'excerpt' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
            ],
            [
                'image' => 'images/image_3.jpg',
                'date' => 'Sept 10, 2018',
                'author' => 'Admin',
                'comments' => 3,
                'title' => 'Hurricane Irma has devastated Florida',
                'excerpt' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
            ]
        ];

        // Events data
        $events = [
            [
                'image' => 'images/event-1.jpg',
                'date' => 'Sep. 10, 2018',
                'organizer' => 'Admin',
                'comments' => 3,
                'title' => 'World Wide Donation',
                'time' => '10:30AM-03:30PM',
                'venue' => 'Venue Main Campus',
                'description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
            ],
            [
                'image' => 'images/event-2.jpg',
                'date' => 'Sep. 10, 2018',
                'organizer' => 'Admin',
                'comments' => 3,
                'title' => 'World Wide Donation',
                'time' => '10:30AM-03:30PM',
                'venue' => 'Venue Main Campus',
                'description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
            ],
            [
                'image' => 'images/event-3.jpg',
                'date' => 'Sep. 10, 2018',
                'organizer' => 'Admin',
                'comments' => 3,
                'title' => 'World Wide Donation',
                'time' => '10:30AM-03:30PM',
                'venue' => 'Venue Main Campus',
                'description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'
            ]
        ];

        // Recent blogs for footer
        $recentBlogs = [
            [
                'image' => 'images/image_1.jpg',
                'title' => 'Even the all-powerful Pointing has no control about',
                'date' => 'July 12, 2018',
                'author' => 'Admin',
                'comments' => 19
            ],
            [
                'image' => 'images/image_2.jpg',
                'title' => 'Even the all-powerful Pointing has no control about',
                'date' => 'July 12, 2018',
                'author' => 'Admin',
                'comments' => 19
            ]
        ];

        return view('home', compact(
            'stats', 
            'services', 
            'causes', 
            'donations', 
            'gallery', 
            'blogs', 
            'events',
            'recentBlogs'
        ));
    }
}