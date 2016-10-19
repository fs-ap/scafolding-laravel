<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserTenantRepository;
use App\Entities\UserTenant;
use App\Validators\UserTenantValidator;

/**
 * Class UserTenantRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserTenantRepositoryEloquent extends BaseRepository implements UserTenantRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [];
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserTenant::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserTenantValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Set up presenter to repository
     */
    public function presenter()
    {
        return \App\Presenters\UserTenantPresenter::class;
    }
}
