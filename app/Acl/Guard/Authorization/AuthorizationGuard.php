<?php

namespace App\Acl\Guard\Authorization;

use Illuminate\Contracts\Config\Repository;
use App\Entities\Tenant;
use App\Acl\Guard\GuardInterface;
use Illuminate\Session\SessionManager;
use App\Acl\Guard\Authorization\Exception\AuthorizationWithoutSessionException;
/**
* 
*/
class AuthorizationGuard implements GuardInterface, AuthorizationGuardInterface
{
	protected $config;
	protected $session;
	public function __construct(Repository $config, SessionManager $session)
	{
		$this->config = $config;
		$this->session = $session;
	}

	public function getTenantClass()
	{
		return $this->config->get('multitenant.user');
	}

	public function autorizeIn(Tenant $tenant)
	{
		$allow = $tenant->users()
			->where('user_id', $this->user()->id)
			->where('enabled', '=', true)->exists();

		$key = $this->config->get('multitenant.authorization.tenant_session_key');

		if($allow) {
			$class = $this->config->get('multitenant.tenant');
			$this->session->put($key, $tenant);
		}
	}

	public function allow()
	{
		$key = $this->config->get('multitenant.authorization.tenant_session_key');

		if($this->session->has($key)) {
			return true;
		}

		throw new AuthorizationWithoutSessionException("Tenant not set in session key {$key}", 1);
	}

	public function getLoginPage()
	{
		return $this->config->get('multitenant.authorization.loginPage');
	}

	public function getChooseTenantPage()
	{
		return $this->config->get('multitenant.authorization.chooseTentantPage');
	}

	public function getTenantsForCurrentUser()
	{
		$user = $this->user();


		return $user->tenants()->select('tenants.name', 'tenants.id')
			->join('tenants', 'tenants.id', '=', 'users_tenants.tenant_id')
			->where('tenants.enabled', '=', true)->get();
	}

	protected function user()
	{
		return app('auth')->user();
	}
}