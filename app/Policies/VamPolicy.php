<?php

namespace App\Policies;

use App\Models\dashboard\Vam as DashboardVam;
use App\Models\User;
use App\Models\Vam;
use Illuminate\Auth\Access\Response;

class VamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DashboardVam $vam): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function validateByHumanResources(User $user, DashboardVam $vam)
    {
        return $user->role === 'humanResources' && $vam->status === 'Yes';
    }

    public function validateManager1(User $user, DashboardVam $vam): bool
    {
        return $user->role === 'manager1' && $vam->validationHr === 'Yes';
    }
    public function validateManager2(User $user, DashboardVam $vam): bool
    {
        return $user->role === 'manager2' && $vam->validationManager1 === 'Yes';
    }


    /**
     * Determine whether the user can delete the model.
     */

    public function delete(User $user, DashboardVam $vam): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DashboardVam $vam): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DashboardVam $vam): bool
    {
        return false;
    }
}
