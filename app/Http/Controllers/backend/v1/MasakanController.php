<?php

namespace App\Http\Controllers\backend\v1;

use App\Http\Controllers\Controller;
use App\Models\Masakan;
use App\Models\Menu;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MasakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data['menus']  = Menu::all();
        $data['masakans'] = Masakan::query()
            ->when(request('search'), function ($query) {
                $query->where('nama_menu', 'like', '%' . request('search') . '%');
            })
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('backend.v1.pages.masakan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['menus'] = Menu::all();
        $data['users'] = User::where('rule', '=', 'user')->where('rule', '!=', 'admin')->get();

        return view('backend.v1.pages.masakan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'menu_id' => 'required',
            'transaksi_id' => 'required',
            'harga_satuan' => 'required',
            'jumlah_satuan' => 'required|integer',
            'total_harga' => 'required',
        ]);

        $data['menus'] = Menu::where('id', $request->menu_id)->first();
        $data['transaksi_id'] = 'TRX-' . time() . '-' . Auth::id();
        // Hitung total harga secara otomatis, Konversi format harga satuan ke numeric
        $data['harga_satuan'] = str_replace('.', '', $data['harga_satuan']);
        $data['total_harga'] = $request['harga_satuan'] * $request['jumlah_satuan'];

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Masakan::create($data);

        return redirect()->route('masakan.index')->with('success', 'Data Menu berhasil ditambahkan.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
