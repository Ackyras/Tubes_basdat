<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\PembukaanAsprak;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManagementUser extends Controller
{
    public function index()
    {
        if (auth()->user()->role == "superadmin") {
            $users = User::paginate(10);
            return view('dashboard.user.index', compact('users'));
        } else
            abort(403);
    }

    public function create()
    {
        if (auth()->user()->role == "superadmin") {
            return view('dashboard.user.create');
        } else
            abort(403);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'              => ['required'],
                'username'          => ['required', 'unique:users,username'],
                'email'             => ['required', 'unique:users,email', 'email'],
                'password'          => ['required'],
                'password_confirm'  => ['required_with:password', 'same:password'],
                'role'              => ['required']
            ]
        );

        User::create(
            [
                'name'      => $request->input('name'),
                'username'  => $request->input('username'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password')),
                'role'      => $request->input('role')
            ]
        );

        return redirect()->route('user.index')->with('status', 'Berhasil menambah akun');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if ($id == auth()->user()->id or auth()->user()->role == "superadmin")
            return view('dashboard.user.edit', compact('user'));
        else
            abort(403);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'              => ['required'],
                'username'          => ['required', 'unique:users,username,' . auth()->user()->id],
                'email'             => ['email', 'required', 'unique:users,email,' . auth()->user()->id],
                'password'          => ['required_with:password_confirm', 'same:password_confirm'],
                'password'          => ['required'],
                'password_confirm'  => ['required_with:password', 'same:password'],
                'role'              => ['nullable']
            ]
        );

        User::where('id', $id)->update(
            [
                'name'      => $request->input('name'),
                'username'  => $request->input('username'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]
        );

        if (auth()->user()->role  == "superadmin") {
            User::where('id', $id)->update(
                [
                    'role'  => $request->input('role')
                ]
            );
        }

        return redirect()->route('admin.dashboard');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user.index')->with('status', 'Berhasil menghapus akun');
    }

    public function reset()
    {
        $pembukaan = PembukaanAsprak::latest()->first();
        $matkul = MataKuliah::where('pembukaan_asprak_id', $pembukaan->id)
            ->orderByDesc('tanggal_seleksi')
            ->first();
        if ($pembukaan->awal_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d'))
            return redirect()->route('user.index')->with('status', 'Perekrutan calon asisten praktikum masih berlangsung');

        User::where('role', 'calonasprak')->delete();
        return redirect()->route('user.index')->with('status', 'Berhasil mengapus akun calon asprak');
    }
}
