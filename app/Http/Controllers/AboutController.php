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
                "<strong>Our Journey</strong> – Vishvam Foundation

2022 – The Beginning of a Movement
Vishvam Foundation was born from a shared dream: to turn compassion into action and hope into reality. What began as a vision of a few passionate individuals has grown into a dynamic movement transforming lives. We believe that service is stronger together  when hearts unite, efforts amplify, and change becomes unstoppable. Today, registered under the Indian Trusts Act, 1882, Vishvam is more than an organization  it’s a family, a movement, and a promise to empower the underserved.

From the start, our strength has been people with purpose educators, healthcare professionals, volunteers, social workers, and students  all working together to uplift children, empower women, and strengthen communities. Every life we touch adds a spark to a brighter, stronger, and more hopeful world.

<strong>Our Focus Areas</strong> – Creating Change, One Life at a Time

Education That Inspires

We provide children from underprivileged families with quality education and guidance, helping them dream big, think critically, and grow confidently. Every lesson is a stepping stone toward a future full of opportunities.

Skill Development for Independence

We equip our beneficiaries with practical skills, unlocking doors to self-reliance, meaningful careers, and long-term growth. Every skill learned is a tool to build a life of dignity and purpose.

Character & Community Building

We nurture empathy, courage, and social responsibility, shaping young minds to become positive change-makers in their communities.

Women’s Awareness Programs

Through workshops and initiatives on education, safety, rights, financial literacy, and emotional well-being, we empower women to stand tall, make informed choices, and lead change in their lives.

Rural Women’s Health Program

We reach rural women with essential health awareness, covering menstrual hygiene, cervical cancer prevention, nutrition, mental wellness, and preventive care. By informing and empowering women, we strengthen families, communities, and futures.

Vishvam Foundation is more than an organization  it’s a spark of hope, a hub of empowerment, and a movement for change.
Every child we educate, every skill we teach, every woman we empower brings us closer to a world where dreams are real, opportunities are endless, and communities rise together."
            ],
            'mission' => "At Vishvam Foundation, we believe that every child and young individual is born with a light unique, pure, and full of promise. But many times, that light dims under the weight of poverty, fear, or a lack of opportunity. Our mission is to reignite that light by offering education, shelter, protection, and real-life skills that open doors to a future filled with dignity and hope. We work to ensure that no child is left behind, no dream is silenced, and no potential is wasted simply because life has been unfair. With every small hand we hold, we hold an entire universe of possibilities.

Our commitment goes beyond education. We stand as a strong pillar for the health and empowerment of women, especially those in rural communities who often struggle in silence. Through our women’s health awareness programs, cervical cancer campaigns, menstrual hygiene education, and mental wellness support, we reach women who have never been told that their health matters too. We walk into villages, communities, and remote areas to educate, support, and uplift women who have carried generations forward without receiving the care they deserve. When a woman learns, heals, or finds strength an entire family, an entire community, transforms.

At Vishvam Foundation, we are not just a team we are a family of volunteers, educators, doctors, donors, and dreamers who come together with one purpose: to create a circle of care where children and women feel seen, heard, and valued. Through structured programs, emotional support, and life-changing opportunities, we guide them towards confidence, courage, and self-reliance. Every life we touch reminds us why we began: to spread hope, restore dignity, and help people rise beyond their circumstances.

Vishvam Foundation is more than an organization it is a movement of love, healing, and transformation.
Here, every child matters. Every woman matters. Every dream matters.
And with every step we take, we build a world where they can shine without fear, grow without limits, and live with pride.",
            'vision' => "A world where every child can dream freely, every youth grows with confidence, and every rural woman receives the health awareness and care she truly deserves  creating communities that rise together with knowledge, dignity, and hope.",
        ];

        // Stats data
        $stats = [
            'children_served' => 1432800,
            'locations' => 'India',
            'volunteers' => 2500,
        ];
        
        // Team members data
        $default_team = [
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

        $team = [];
        $teams = \App\Models\Team::all();

        foreach ($teams as $team_member) {
            $team[] = [
                'image' => $team_member->image ? asset('storage/' . $team_member->image) : asset('images/default_profile.png'),
                'name' => $team_member->name,
                'title' => $team_member->title,
                'subtitle' => $team_member->description,
            ];
        }
        if (empty($team)) {
            $team = $default_team;
        }

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