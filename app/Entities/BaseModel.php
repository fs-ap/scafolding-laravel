<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	// /**
	//      * @see \Illuminate\Database\Eloquent\Model::hasOne
 //     * @see \Illuminate\Database\Eloquent\Model::hasMany
 //     * @see \Illuminate\Database\Eloquent\Model::hasManyThrough
 //     * @see \Illuminate\Database\Eloquent\Model::belongsTo
 //     * @see \Illuminate\Database\Eloquent\Model::belongsToMany
 //     * @see \Illuminate\Database\Eloquent\Model::morphTo
 //     * @see \Illuminate\Database\Eloquent\Model::morphOne
 //     * @see \Illuminate\Database\Eloquent\Model::morphMany
 //     * @see \Illuminate\Database\Eloquent\Model::morphToMany
 //     * @see \Illuminate\Database\Eloquent\Model::morphedByMany
 //     *
 //     * @var array
 //     */
 //    protected static $relationsData = array();
 //    /** This class "has one model" if its ID is an FK in that model */
 //    const HAS_ONE = 'hasOne';
 //    /** This class "has many models" if its ID is an FK in those models */
 //    const HAS_MANY = 'hasMany';
 //    const HAS_MANY_THROUGH = 'hasManyThrough';
 //    /** This class "belongs to a model" if it has a FK from that model */
 //    const BELONGS_TO = 'belongsTo';
 //    const BELONGS_TO_MANY = 'belongsToMany';
 //    const MORPH_TO = 'morphTo';
 //    const MORPH_ONE = 'morphOne';
 //    const MORPH_MANY = 'morphMany';
 //    const MORPH_TO_MANY = 'morphToMany';
 //    const MORPHED_BY_MANY = 'morphedByMany';
 //    /**
 //     * Array of relations used to verify arguments used in the {@link $relationsData}
 //     *
 //     * @var array
 //     */
 //    protected static $relationTypes = array(
 //        self::HAS_ONE, self::HAS_MANY, self::HAS_MANY_THROUGH,
 //        self::BELONGS_TO, self::BELONGS_TO_MANY,
 //        self::MORPH_TO, self::MORPH_ONE, self::MORPH_MANY,
 //        self::MORPH_TO_MANY, self::MORPHED_BY_MANY
 //    );


 //    public function __call($method, $parameters)
 //    {
 //        if (array_key_exists($method, static::$relationsData)) {
 //            return $this->handleRelationalArray($method);
 //        }
 //        return parent::__call($method, $parameters);
 //    }

 //    /**
 //     * Looks for the relation in the {@link $relationsData} array and does the correct magic as Eloquent would require
 //     * inside relation methods. For more information, read the documentation of the mentioned property.
 //     *
 //     * @param string $relationName the relation key, camel-case version
 //     * @return \Illuminate\Database\Eloquent\Relations\Relation
 //     * @throws \InvalidArgumentException when the first param of the relation is not a relation type constant,
 //     *      or there's one or more arguments missing
 //     * @see Ardent::relationsData
 //     */
 //    protected function handleRelationalArray($relationName) {

 //        $relation     = static::$relationsData[$relationName];
 //        $relationType = $relation[0];
 //        $errorHeader  = "Relation '$relationName' on model '".get_called_class();
 //        if (!in_array($relationType, static::$relationTypes)) {
 //            throw new \InvalidArgumentException($errorHeader.
 //            ' should have as first param one of the relation constants of the Ardent class.');
 //        }
 //        if (!isset($relation[1]) && $relationType != self::MORPH_TO) {
 //            throw new \InvalidArgumentException($errorHeader.
 //            ' should have at least two params: relation type and classname.');
 //        }
 //        if (isset($relation[1]) && $relationType == self::MORPH_TO) {
 //            throw new \InvalidArgumentException($errorHeader.
 //            ' is a morphTo relation and should not contain additional arguments.');
 //        }
 //        $verifyArgs = function (array $opt, array $req = array()) use ($relationName, &$relation, $errorHeader) {
 //            $missing = array('req' => array(), 'opt' => array());
 //            foreach (array('req', 'opt') as $keyType) {
 //                foreach ($$keyType as $key) {
 //                    if (!array_key_exists($key, $relation)) {
 //                        $missing[$keyType][] = $key;
 //                    }
 //                }
 //            }
 //            if ($missing['req']) {
 //                throw new \InvalidArgumentException($errorHeader.'
 //                    should contain the following key(s): '.join(', ', $missing['req']));
 //            }
 //            if ($missing['opt']) {
 //                foreach ($missing['opt'] as $include) {
 //                    $relation[$include] = null;
 //                }
 //            }
 //        };
 //        switch ($relationType) {
 //            case self::HAS_ONE:
 //            case self::HAS_MANY:
 //                $verifyArgs(['foreignKey', 'localKey']);
 //                return $this->$relationType($relation[1], $relation['foreignKey'], $relation['localKey']);
 //            case self::HAS_MANY_THROUGH:
 //                $verifyArgs(['firstKey', 'secondKey', 'localKey'], ['through']);
 //                return $this->$relationType($relation[1], $relation['through'], $relation['firstKey'], $relation['secondKey'], $relation['localKey']);
 //            case self::BELONGS_TO:
 //                $verifyArgs(['foreignKey', 'otherKey', 'relation']);
 //                return $this->$relationType($relation[1], $relation['foreignKey'], $relation['otherKey'], $relation['relation']);
 //            case self::BELONGS_TO_MANY:
 //                $verifyArgs(['table', 'foreignKey', 'otherKey', 'relation']);
 //                $relationship = $this->$relationType($relation[1], $relation['table'], $relation['foreignKey'], $relation['otherKey'], $relation['relation']);
 //                if(isset($relation['pivotKeys']) && is_array($relation['pivotKeys'])) {
 //                    $relationship->withPivot($relation['pivotKeys']);
 //                }
 //                if(isset($relation['timestamps']) && $relation['timestamps']) {
 //                    $relationship->withTimestamps();
 //                }
 //                return $relationship;
 //            case self::MORPH_TO:
 //                $verifyArgs(['name', 'type', 'id']);
 //                return $this->$relationType($relation['name'], $relation['type'], $relation['id']);
 //            case self::MORPH_ONE:
 //            case self::MORPH_MANY:
 //                $verifyArgs(['type', 'id', 'localKey'], ['name']);
 //                return $this->$relationType($relation[1], $relation['name'], $relation['type'], $relation['id'], $relation['localKey']);
 //            case self::MORPH_TO_MANY:
 //                $verifyArgs(['table', 'foreignKey', 'otherKey', 'inverse'], ['name']);
 //                return $this->$relationType($relation[1], $relation['name'], $relation['table'], $relation['foreignKey'], $relation['otherKey'], $relation['inverse']);
 //            case self::MORPHED_BY_MANY:
 //                $verifyArgs(['table', 'foreignKey', 'otherKey'], ['name']);
 //                return $this->$relationType($relation[1], $relation['name'], $relation['table'], $relation['foreignKey'], $relation['otherKey']);
 //        }
 //    }
}
