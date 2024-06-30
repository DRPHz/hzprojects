<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::all();
        return view('developers.index', compact('developers'));
    }

    public function create()
    {
        return view('developers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'required|url',
            'bio' => 'nullable|string',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'confirmed'
            ],
        ], [
            'name.required' => 'Please provide a name.',
            'name.max' => 'The name cannot be longer than 255 characters.',
            'website.required' => 'Please provide a website.',
            'website.url' => 'Please provide a valid URL.',
            'password.required' => 'Please provide a password.',
            'password.min' => 'The password requirements are not met.',
            'password.regex' => 'The password requirements are not met.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        Developer::create([
            'name' => $request->name,
            'website' => $request->website,
            'bio' => $request->bio,
            'password' => bcrypt($request->password),
        ]);


        return redirect()->route('developers.index')->with('success', 'Developer created successfully.');
    }

    public function show(Developer $developer)
    {
        return view('developers.show', compact('developer'));
    }

    public function edit(Developer $developer)
    {
        if (Session::get('verified_developer_id') !== $developer->id) {
            return redirect()->route('developers.showVerifyPasswordForm', $developer);
        }

        return view('developers.edit', compact('developer'));
    }

    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:developers,email,' . $developer->id,
            'bio' => 'nullable|string',
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                'confirmed'
            ],
        ], [
            'name.max' => 'The name cannot be longer than 255 charackters.',
            'password.min' => 'The password requirements are not met.',
            'password.regex' => 'The password requirements are not met.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $developer->update($validated);

        return redirect()->route('developers.index')->with('success', 'Developer updated successfully.');
    }

    public function destroy(Developer $developer)
    {
        $developer->delete();
        return redirect()->route('developers.index')->with('success', 'Developer deleted successfully.');
    }

    public function showVerifyPasswordForm(Developer $developer)
    {
        return view('developers.verify-password', compact('developer'));
    }

    public function verifyPassword(Request $request, Developer $developer)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, $developer->password)) {
            session(['verified_developer_id' => $developer->id]);
            return redirect()->route('developers.edit', $developer);
        } else {
            return redirect()->route('developers.index')->withErrors(['password' => 'Incorrect password.']);
        }
    }
}
