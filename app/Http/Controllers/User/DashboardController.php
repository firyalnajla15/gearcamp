<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $jumlahKeranjang = 0;

        foreach ($cart as $item) {
            if (is_array($item)) {
                $jumlahKeranjang += (int) ($item['quantity'] ?? 0);
            }
        }

        return view('user.dashboard', compact('jumlahKeranjang'));
    }
}
