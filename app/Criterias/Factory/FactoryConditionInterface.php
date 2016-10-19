<?php namespace App\Criterias\Factory;

use Illuminate\Database\Eloquent\Builder;

interface FactoryConditionInterface
{
	public function make(Builder $builder, $field, $operation);
}