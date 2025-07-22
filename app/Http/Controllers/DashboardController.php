<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // Dashboard pour utilisateur 
        $user = Auth::user();
        
        return view('dashboard', compact('user'));
    }
}