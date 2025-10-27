<?php

namespace App\Http\Controllers;

use App\Models\Jpo;
use App\Models\Post;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   public function showFeed(Jpo $event)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to view the feed.');
        }

        if ($user->attendance_status === 'confirmed') {
            $posts = $event->posts()->latest()->paginate(10);
            return view('jpo.index', compact('event', 'posts'));
        } else {
            return redirect()->route('home')->with('error', 'You must have a confirmed attendance status to view the feed.');
        }
    }
public function create(Request $request)
{
    // Retrieve the event ID from the query parameter
    $eventId = $request->query('event');

    // Fetch the event from the database
    $event = Jpo::findOrFail($eventId);

    // Debugging to ensure the event ID is correct


    // Return the view with the event data
    return view('jpo.createpost', compact('event'));
}


public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'content' => 'required|string',
        'type' => 'required|string',
        'jpo_id' => 'required|exists:jpos,id',
        'image' => 'nullable|image|max:2048', // Optional validation for the image
    ]);

    // Handle the image upload if exists
    $imagePath = null;
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    // Create the post
    Post::create([
        'content' => $request->input('content'),
        'type' => $request->input('type'),
        'jpo_id' => $request->input('jpo_id'),
        'user_id' => auth()->id(),
        'image' => $imagePath,
    ]);

    // Redirect back with a success message
    return redirect()->route('events.feed', ['event' => $request->input('jpo_id')])->with('success', 'Post created successfully.');
}


    public function apply($postId)
    {
        $post = Post::findOrFail($postId);
        return view('intership.apply', compact('post'));
    }

    public function submitApplication(Request $request, $postId)
{ 
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'cv' => 'required|file|mimes:pdf|max:2048',
    ]);

    $cvPath = $request->file('cv')->store('cvs', 'public');

    $post = Post::findOrFail($postId);

    Application::create([
        'post_id' => $postId,
        'user_id' => Auth::id(),
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'cv_path' => $cvPath,
    ]);

    return redirect()->route('events.feed', ['event' => $post->jpo_id])->with('success', 'Application submitted successfully!');
}
public function userApplications()
{
    $applications = Auth::user()->applications()->with('post.user')->orderBy('updated_at', 'desc')->get();
    return view('intership.applications', compact('applications'));
}

public function edit($id)
{
    $post = Post::findOrFail($id);
    return view('jpo.update', compact('post'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $post = Post::findOrFail($id);
    $post->content = $request->content;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        $post->image = $imagePath;
    }

    $post->save();

    return redirect()->route('events.feed', ['event' => $post->jpo_id])->with('success', 'Application submitted successfully!');
}
public function showMyPostApplications()
{
    $user = Auth::user();

    // Fetch all posts created by the authenticated user and load applications
    $posts = Post::where('user_id', $user->id)->with('applications')->get();

    // Extract all applications from these posts
    $applications = $posts->flatMap(function ($post) {
        return $post->applications;
    });

    return view('intership.index', compact('applications'));
}

public function downloadCv($applicationId)
{
    $application = Application::findOrFail($applicationId);
    $filePath = storage_path('app/public/' . $application->cv_path);

    return response()->download($filePath);
}



public function destroy($id)
{
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('events.feed', ['event' => $post->jpo_id])->with('success', 'Application submitted successfully!');
}

public function showMyPosts()
{
    $user = Auth::user();
    $posts = Post::where('user_id', $user->id)->latest()->paginate(10); // Paginate to handle many posts

    return view('posts.index', compact('posts'));
}
public function accept($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'Up For Interview';
        $application->save();

        return redirect()->back()->with('success', 'Application  set for interview.');
    }

    public function reject($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'Application rejected.');
    }


}


