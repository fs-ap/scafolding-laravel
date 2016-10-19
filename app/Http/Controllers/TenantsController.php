<?php

namespace App\Http\Controllers;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TenantCreateRequest;
use App\Http\Requests\TenantUpdateRequest;
use App\Repositories\TenantRepository;
use App\Validators\TenantValidator;

class TenantsController extends ResourceController
{

    /**
     * @var string
     */
    public static $pluralName = 'tenants';

    /**
     * @var string
     */
    public static $singleName = 'tenant';

    public function __construct(TenantRepository $repository, TenantValidator $validator)
    {
        parent::__construct();
        
        $this->repository = $repository;
        $this->validator  = $validator;

    }
}
