<?php

namespace App\Http\Controllers;

use App\Acl\Guard\Authorization\AuthorizationGuardInterface;
use Illuminate\Http\Request;
use App\Entities\Tenant;
use App\Http\Requests;

class ChooseTenantController extends Controller
{
	protected $guard;

	public function __construct(AuthorizationGuardInterface $guard)
	{
		$this->guard = $guard;
	}

	public function index()
	{
		$tenants = $this->guard->getTenantsForCurrentUser();

		return view('auth.chooseTenant', [
			'tenants' => $tenants
		]);
	}

	public function store(Request $request)
	{
		$validator = \Validator::make($request->only('tenant_id'), [
			'tenant_id' => 'required|integer|exists:tenants,id'
		]);

		if($validator->passes()) {
			$tenant = Tenant::find($request->get('tenant_id'));
			$this->guard->autorizeIn($tenant);
		}

		return redirect('/');
	}
}
