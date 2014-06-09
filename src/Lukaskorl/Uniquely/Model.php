<?php namespace Lukaskorl\Uniquely;

use Eloquent;
use Rhumsaa\Uuid\Uuid;

abstract class Model extends Eloquent {

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->{$model->getKeyName()} = (string)$model->generatePrimaryKey();
        });
    }

    public function generatePrimaryKey()
    {
        return Uuid::uuid4();
    }

} 