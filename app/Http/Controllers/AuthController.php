<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    // Return register view
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register function
    public function register(Request $request)
    {
        try {
            // Validate the request
            $validData = $request->validate([
                'name' => 'string|max:255|required',
                'email' => 'email|max:255|unique:users|required',
                'password' => 'min:8|confirmed|required'
            ]);

            // Create the user
            User::create($validData);

            // Flash success message
            session()->flash('success', 'Registration successful! Now you can login');

            // Redirect to login
            return redirect()->route('auth.login.view');

        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Database Error: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    // Return login view
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login function
    public function login(Request $request)
    {
        try {
            // Validate the request
            $validData = $request->validate([
                'email' => 'email|max:255|required',
                'password' => 'required|min:8'
            ]);

            // Attempt to log the user in
            if (!Auth::attempt($validData)) {
                return back()->withErrors(['error' => 'Invalid credentials']);
            }

            // Give a success flash message
            session()->flash('success', 'Logged in successfully!');

            // Redirect to home page
            return redirect()->route('project.show');

        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Database Error: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login.view');
    }
}
