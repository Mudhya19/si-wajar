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
        // Validasi input
        $request->validate([
            'jenis_menu' => 'required|in:minuman,makanan', // Hanya boleh 'minuman' atau 'makanan'
            'nama_menu' => 'required|string', // Nama menu harus berupa string
            'satuan' => 'nullable|string', // Boleh null, tetapi jika diisi harus string
            'status' => 'required|in:tersedia,tidak tersedia', // Status hanya boleh 'tersedia' atau 'tidak tersedia'
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // File foto wajib diupload
        ]);

        // Ambil semua data dari request
        $data = $request->all();

        // Proses upload file foto
        if ($request->hasFile('photo')) {
            $photo = time() . '.' . $request->photo->extension(); // Beri nama unik untuk file
            $request->photo->move(public_path('uploads'), $photo); // Simpan file di folder 'public/uploads'
            $data['photo'] = $photo; // Simpan nama file ke array data untuk dimasukkan ke database
        }

        // Simpan data ke dalam database
        Menu::create($data);

        // Redirect ke halaman index menu dengan pesan sukses
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil data input kecuali file photo
        $data = $request->except(['photo']);

        // Proses upload file foto jika ada file baru
        if ($request->hasFile('photo')) {
            // Hapus file lama jika ada
            if ($menu->photo && file_exists(public_path('uploads/' . $menu->photo))) {
                unlink(public_path('uploads/' . $menu->photo));
            }

            // Upload file baru
            $photo = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $photo);
            $data['photo'] = $photo;
        }

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
