<?php

namespace App\Policies;

use App\Models\Capsule;
use App\Models\User;

class CapsulePolicy
{
    /**
     * Capsule milik user?
     */
    private function isOwner(User $user, Capsule $capsule): bool
    {
        return $user->id === $capsule->user_id;
    }

    /**
     * Boleh melihat capsule?
     * - pemilik
     * - dan sudah unlocked
     */
    public function view(User $user, Capsule $capsule): bool
    {
        return $this->isOwner($user, $capsule) && $capsule->is_unlocked;
    }

    /**
     * Boleh edit capsule?
     * - pemilik
     * - dan BELUM unlocked
     */
    public function update(User $user, Capsule $capsule): bool
    {
        return $this->isOwner($user, $capsule) && ! $capsule->is_unlocked;
    }

    /**
     * Boleh hapus capsule?
     * - pemilik
     * - dan BELUM unlocked
     */
    public function delete(User $user, Capsule $capsule): bool
    {
        return $this->isOwner($user, $capsule) && ! $capsule->is_unlocked;
    }
}
