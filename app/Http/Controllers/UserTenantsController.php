<?php

namespace App\Http\Controllers;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserTenantCreateRequest;
use App\Http\Requests\UserTenantUpdateRequest;
use App\Repositories\UserTenantRepository;
use App\Validators\UserTenantValidator;

class UserTenantsController extends ResourceController
{

    /**
     * @var string
     */
    public static $pluralName = 'userTenants';

    /**
     * @var string
     */
    public static $singleName = 'userTenant';

    public function __construct(UserTenantRepository $repository, UserTenantValidator $validator)
    {
        parent::__construct();
        
        $this->repository = $repository;
        $this->validator  = $validator;

    }
}
