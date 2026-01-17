<?php

namespace App\Policies;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MahasiswaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->role === 'admin' || $user->id === $mahasiswa->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mahasiswa $mahasiswa): bool
    {
        return $user->role === 'admin';
    }
}
