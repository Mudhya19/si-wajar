<?php

namespace App\Http\Controllers\backend\v1;


use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $sortColumn = request('sort', 'nama_menu');
        // $sortDirection = request('direction', 'asc');
        // $data['menus']  = Menu::all();
        $data['menus'] = Menu::query()
            ->when(request('search'), function ($query) {
                $query->where('nama_menu', 'like', '%' . request('search') . '%');
            })
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('backend.v1.pages.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v1.pages.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'jenis_menu' => 'required|in:minuman,makanan',
            'nama_menu' => 'required|string',
            'satuan' => 'nullable|string',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        $data = $request->all();
        // $data['user_id'] = Auth::user()->id;
        Menu::create($data);

        return redirect()->route('menu.index')->with('success', 'Data Menu berhasil ditambahkan.');
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
    public function edit(Menu $menu)
    {
        $data['menu'] = $menu;
        return view('backend.v1.pages.menu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'jenis_menu' => 'required|in:minuman,makanan',
            'nama_menu' => 'required|string',
            'satuan' => 'nullable|string',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        $data = $request->all();
        $menu->update($data);

        return to_route('menu.index')->with('success', ' Data menu berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return to_route('menu.index')->with('success', 'Data menu berhasil di hapus');
    }
}
