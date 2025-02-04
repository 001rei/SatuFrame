<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function index() {
        return Inertia::render('Auth/UserProfile', [
            'user' => Auth::user(),
        ]);
    }

    public function create(){
        return Inertia::render('Auth/UserEditProfile', [
            'user' => Auth::user(),
        ]);
    }

    public function dashboard() {
        return Inertia::render('Auth/UserDashboard');
    }

    public function order() {
        return Inertia::render('Auth/UserOrder');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'nomor_telepon' => 'required|digits_between:8,15|unique:users,nomor_telepon,' . $id,
            'alamat' => 'required|string|max:500',
        ]);


        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'nomor_telepon' => $request->input('nomor_telepon'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect(route('user.profile'))->with('message', 'Profile updated successfully!');

    }


}
