<?php

namespace App\Acl\Guard\Authorization;

use App\Entities\Tenant;

interface AuthorizationGuardInterface
{
	public function allow();
	public function autorizeIn(Tenant $tenant);
	public function getLoginPage();
	public function getChooseTenantPage();
	public function getTenantsForCurrentUser();
}
