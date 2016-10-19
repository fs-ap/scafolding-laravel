<?php namespace App\Criterias\Factory;

use Illuminate\Database\Eloquent\Builder;
/**
* 
*/
class FactoryCondition implements FactoryConditionInterface
{
	public function make(Builder $builder, $field, $operation)
	{
		$meta = app('metadata_recurso')->lerMetaAPartirModel($builder->getModel());
		dd($meta);

	}
}