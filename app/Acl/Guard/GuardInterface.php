<?php

namespace App\Acl\Guard;

interface GuardInterface
{
	public function getTenantClass();
}