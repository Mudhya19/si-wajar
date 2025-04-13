<?php

namespace App\Http\Controllers\backend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle dashboard redirection berdasarkan role user
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // Default redirect untuk semua role
        $route = 'transaksi.index';

        // Jika perlu pengecekan role untuk redirect berbeda
        switch ($user->role) {
            case 'admin':
            case 'kasir':
            case 'user':
                // Tetap ke transaksi.index sesuai permintaan
                break;
        }

        return redirect()->route($route);
    }

    /**
     * Handle proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
