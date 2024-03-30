<?php

namespace App\Policies;

use App\Models\SectionManagement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SectionManagementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->hasRole(['admin', 'dev']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SectionManagement $sectionManagement): bool
    {
        //
        return $user->hasRole(['admin', 'dev']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->hasRole(['admin', 'dev']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SectionManagement $sectionManagement): bool
    {
        //
        return $user->hasRole(['admin', 'dev']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SectionManagement $sectionManagement): bool
    {
        //
        return $user->hasRole(['admin', 'dev']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SectionManagement $sectionManagement): bool
    {
        //
        return $user->hasRole(['admin', 'dev']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SectionManagement $sectionManagement): bool
    {
        //
        return $user->hasRole(['admin', 'dev']);
    }
}
