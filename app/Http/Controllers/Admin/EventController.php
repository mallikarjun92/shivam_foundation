<?php
// app/Http\Controllers/Admin\EventController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'featured' => 'boolean',
            'published' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'featured' => 'boolean',
            'published' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        // Generate slug if title changed
        if ($event->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        // Delete image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function listEvents(Request $request)
    {
        // 1. Fetch published events
        $eventsQuery = Event::published()->latest('event_date');

        // 2. Paginate raw Eloquent results
        $paginated = $eventsQuery->paginate(9); // 9 cards per page

        // 3. Transform events into array format for card rendering
        $events = $paginated->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'excerpt' => $event->excerpt,
                'description' => Str::limit($event->description, 120),
                'image' => $event->image_url,                      // uses accessor
                'date' => $event->formatted_date,                 // "Jan 5, 2025"
                'time' => $event->formatted_time,                 // "5:30 PM"
                'venue' => $event->location,
                'organizer' => $event->organizer ?? 'Vishvam Foundation',
                'link' => route('events.show', $event->id),
            ];
        });

        // 4. Replace the paginator items with transformed array
        $paginated->setCollection(collect($events));

        return view('events.index', [
            'events' => $paginated
        ]);
    }

    public function showEvent(Request $request, Event $event)
    {
        // $event = Event::where('slug', $id)->firstOrFail();
        return view('events.show', compact('event'));
    }
}