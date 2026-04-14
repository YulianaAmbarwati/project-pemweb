<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chirp $chirp): bool
    {
        // Hanya user yang memiliki chirp tersebut yang boleh mengedit
        return $chirp->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        // Hanya user yang memiliki chirp tersebut yang boleh menghapus
        return $chirp->user()->is($user);
    }

    // Method lainnya (viewAny, create, dll) bisa dibiarkan return false 
    // atau dihapus saja jika tidak digunakan di tutorial dosenmu.
}