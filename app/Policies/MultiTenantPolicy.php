<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
// use App\Acl\Guard\GuardInterface;

class MultiTenantPolicy
{
    use HandlesAuthorization;

    protected $guard;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    // public function __construct(GuardInterface $guard)
    // {
    //     $this->guard = $guard;
    // }

    public function accessTenant($user)
    {
        return true;
        // dd($this->guard->getUserClass());
        // dd(func_get_args());
    }
}
