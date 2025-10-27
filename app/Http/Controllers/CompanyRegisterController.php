<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Add this line if not already included
use Illuminate\Support\Facades\Hash;

class CompanyRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('companyregister');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "company",
            'attendance_status' => "pending",
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    // New methods for adding a company
    public function showAddCompanyForm()
    {
        return view('add-company');
    }

    public function addCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "company",
            'attendance_status' => "pending",
        ]);

        return redirect()->route('company.list')->with('success', 'Company has been added');
    }
}
