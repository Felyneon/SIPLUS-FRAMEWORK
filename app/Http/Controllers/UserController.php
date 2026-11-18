<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    // GET /admin/pengguna (pengelola)
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q'));

        $users = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $like = '%' . strtolower($q) . '%';
                $query->where(function ($w) use ($like) {
                    $w->whereRaw('LOWER(name) LIKE ?', [$like])
                        ->orWhereRaw('LOWER(email) LIKE ?', [$like]);
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // [user_id => role_id] untuk halaman ini
        $roleIds = UserRole::whereIn('user_id', $users->pluck('id'))->pluck('role_id', 'user_id');

        return view('admin.pengguna.index', compact('users', 'roleIds', 'q'));
    }

    // PATCH /admin/pengguna/{user}/role (pengelola)
    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        if ((int) $user->id === (int) Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah peran akun sendiri.');
        }

        $roleId = (int) $request->validated('role_id');

        UserRole::updateOrCreate(['user_id' => $user->id], ['role_id' => $roleId]);
        $user->update(['role' => $roleId === Role::PENGELOLA ? 'pengelola' : 'mahasiswa']);

        return back()->with('success', "Peran {$user->name} berhasil diubah.");
    }
}