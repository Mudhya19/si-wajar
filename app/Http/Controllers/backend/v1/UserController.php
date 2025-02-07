<?php

namespace App\Http\Controllers\backend\v1;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $sortColumn = request('sort', 'nama_menu');
        // $sortDirection = request('direction', 'asc');
        // $data['menus']  = Menu::all();
        $data['users'] = User::query()
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('backend.v1.pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v1.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'rule' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->route('user.index')->with('success', 'Data Akses Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['user'] = $user;
        return view('backend.v1.pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'rule' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data Akses Pengguna berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('user.index')->with('success', 'Data user berhasil di hapus');
    }
}
