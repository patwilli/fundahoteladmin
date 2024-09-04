<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    public function indexManageAccounts()
    {
        $admins = Admin::all();
        return view('manage-accounts', compact('admins'));
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admins')->attempt($credentials)) {
            // Authentification réussie pour un admin
            return redirect()->route('dashboard');
        } else {
            // Échec de l'authentification
            return back()->withInput()->withErrors(['email' => 'Vos identifiants sont incorrects.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginForm')->with('success', 'Vous avez été déconnecté avec succès.');
    }

    public function addAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'admin_name' => 'required|string',
            'admin_email' => 'required|email|unique:admins,email',
            'admin_phone' => 'required|string',
            'admin_password' => 'required',
        ]);

        $admin = new Admin();
        $admin->name = $validatedData['admin_name'];
        $admin->email = $validatedData['admin_email'];
        $admin->phone = $validatedData['admin_phone'];
        $admin->password = bcrypt($validatedData['admin_password']);
        $admin->save();

        return redirect()->back()->with('success', 'Admin added successfully');
    }

    public function updateAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email',
            'admin_phone' => 'required',
        ]);
        $adminId = $request->input('admin_id');
        $admin = Admin::find($adminId);
        $admin->name = $request->input('admin_name');
        $admin->email = $request->input('admin_email');
        $admin->phone = $request->input('admin_phone');
        $admin->save();
        return redirect()->back()->with('success', 'Détails de l\'administrateur mis à jour avec succès.');
    }
    public function updateUnbanAdmin(Request $request)
    {
        $adminId = $request->input('unban_admin');
        $admin = Admin::find($adminId);
        $admin->status = 0;
        $admin->save();
        return redirect()->back()->with('success', 'Détails de l\'administrateur mis à jour avec succès.');
    }

    public function updateBanAdmin(Request $request)
    {
        $adminId = $request->input('ban_admin');
        $admin = Admin::find($adminId);
        $admin->status = 1;
        $admin->save();
        return redirect()->back()->with('success', 'Détails de l\'administrateur mis à jour avec succès.');
    }
}
