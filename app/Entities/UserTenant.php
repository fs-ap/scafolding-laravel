<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserTenant extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $table = 'users_tenants';
    
    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }

    public function tenant()
    {
    	return $this->belongsTo(Tenant::class);
    }
}
