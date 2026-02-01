<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index() {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create() {
        return view('admin.admins.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        Admin::create($request->only('name','email','password'));
        return redirect('/admin/admins');
    }

    public function edit($id) {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id) {
        Admin::findOrFail($id)->update(
            $request->only('name','email','password')
        );
        return redirect('/admin/admins');
    }

    public function destroy($id) {
        Admin::destroy($id);
        return redirect('/admin/admins');
    }
}

