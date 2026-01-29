<?php

namespace App\Policies;

use App\Models\Artwork;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArtworkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'artist']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Artwork $artwork): bool
    {
        return $user->hasAnyRole(['admin', 'artist']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'artist']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Artwork $artwork): bool
    {
        // Admin can update anything
        if ($user->hasRole('admin')) {
            return true;
        }

        // Artist can update only their own artwork
        if ($user->hasRole('artist')) {
            return $artwork->artist_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Artwork $artwork): bool
    {
        // Same rule as update
        return $this->update($user, $artwork);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Artwork $artwork): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Artwork $artwork): bool
    {
        return $user->hasRole('admin');
    }
}
