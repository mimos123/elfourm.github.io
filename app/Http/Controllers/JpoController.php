<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Jpo;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class JpoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $events = Jpo::all();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Jpo $event): View
    {
        $tags = Tag::all();

        return view('event.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['user_id'] = auth()->id();

        $event = Jpo::create($validatedData);
        $event->tags()->attach($validatedData['tags']);

        return redirect()->route('event.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jpo $event): View
    {
        $tags = Tag::all();
        return view('event.edit', compact('tags', 'event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jpo $event): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($event->image);
            $imagePath = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $imagePath;
        }

        $validatedData['slug'] = Str::slug($validatedData['name']);
        $event->update($validatedData);
        $event->tags()->sync($validatedData['tags']);

        return redirect()->route('event.index');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jpo $event): RedirectResponse
    {
        Storage::delete($event->image);
        $event->tags()->detach();
        $event->delete();

        return redirect()->route('event.index');
    }

public function attend(Jpo $event)
    {
        $user = Auth::user();

        $status = ($user->role === 'company') ? 'pending' : 'confirmed';

        $user->events()->attach($event->id, ['status' => $status]);

        return redirect()->back()->with('success', 'Your attendance status has been updated.');
    }

    public function pendingAttendances()
    {
        $pendingAttendances = Jpo::with(['users' => function($query) {
            $query->wherePivot('status', 'pending');
        }])->get();

        return view('jpo.pending-attendances', compact('pendingAttendances'));
    }

   public function updateAttendanceStatus(Request $request, Jpo $event, $userId)
{
    $request->validate([
        'status' => 'required|in:confirmed,refused',
    ]);

    $event->users()->updateExistingPivot($userId, ['status' => $request->status]);

    return redirect()->route('jpo.pending-attendances')->with('success', 'Attendance status updated successfully.');
}
public function companiesAttendance()
{
    // Fetch all users with their attendance status for all events
    $companies = User::where('role', 'company')
        ->with(['events' => function($query) {
            $query->withPivot('status');
        }])
        ->get();

    return view('companies.attendance', compact('companies'));
}

}

