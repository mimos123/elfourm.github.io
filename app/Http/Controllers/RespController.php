<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RespController extends Controller
{
    public function index()
    {
        $managers = User::where('role', 'resp')->get();
        return view('manager', compact('managers'));
    }

    public function add()
    {
        return view('manageradd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "resp",
        ]);

        return redirect()->route('managers.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $manager = User::findOrFail($id);
        return view('manageredit', compact('manager'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);

        $manager = User::findOrFail($id);
        $manager->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('managers.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $manager = User::findOrFail($id);
        $manager->delete();

        return redirect()->route('managers.index')->with('success', 'User deleted successfully.');
    }



    
    
    public function companyList()
  {
    // Fetch the companies with the role attribute set to 'company'
        $companies = User::where('role', 'company')->get();

        // Pass the $companies variable to the view
        return view('company.index', ['companies' => $companies]);
  }



   public function acceptCompany($user_Id)
    {
        // dd($user_Id);
        // Find the user (company) by ID
        $user = User::findOrFail($user_Id);

        // Update the attendance status based on user role
            // If user role is 'company', attendance status is set to 'pending'
            $user->attendance_status = "confirmed";
            // For any other role (assuming 'user'), attendance is automatically confirmed

        // Save the changes
        $user->save();

        // Redirect back or to a specific page
        return redirect()->back()->with('status', 'Attendance status updated successfully.');
    }

}

  