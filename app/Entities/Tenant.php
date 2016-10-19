<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Tenant extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'name',
    	'description',
    	'enabled'
    ];

    public function users()
    {
    	return $this->hasMany(UserTenant::class);
    }
}
