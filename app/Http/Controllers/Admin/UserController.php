<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Tampilkan list user (hanya role user, bukan admin)
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%");
            });
        }

        $users = $query->withCount('pesanan')
            ->latest()
            ->paginate(15);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Detail user
     */
    public function show(User $user)
    {
        // Pastikan hanya bisa lihat detail user biasa, bukan admin
        if ($user->role === 'admin') {
            abort(403, 'Tidak dapat mengakses data admin');
        }

        $user->load(['pesanan' => function ($query) {
            $query->latest()->limit(10);
        }]);

        return view('admin.user.show', compact('user'));
    }
}
