<?php

namespace App\Http\Controllers\backend\v1;


use App\Http\Controllers\Controller;
use App\Models\Masakan;
use App\Models\Menu;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['transaksis'] = Transaksi::query()
            ->when(request('search'), function ($query) {
                $query->where('nama_menu', 'like', '%' . request('search') . '%')
                ->orWhere('metode', 'like', '%' . request('search') . '%');
            })
            ->paginate(request('per_page', 10))
            ->withQueryString();

        return view('backend.v1.pages.transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'masakans' => Masakan::all(),
            'menus' => Menu::all(),
            'users' => User::whereIn('rule', ['admin', 'kasir'])->get()
        ];

        return view('backend.v1.pages.transaksi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //
        $request->validate([
            // 'user_id' => 'required',
            'total_harga' => 'required',
            'metode' => 'required|in:tunai, non tunai',
            'tanggal_transaksi' => 'required|date',
        ]);

        // $request['users'] = Menu::where('id', $request->user_id)->first();
        $request['transaksi_id'] = 'TRX-' . time() . '-' . Auth::id();
        // $request['user_id'] = Auth::user()->id;

        // Konversi tanggal format
        $request['tanggal_transaksi'] = Carbon::parse($request->tanggal_transaksi);


        $data = $request->all();
        Transaksi::create($data);

        return redirect()->route('transaksi.index')->with('success', ' Data Transaksi berhasil ditambahkan');
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
