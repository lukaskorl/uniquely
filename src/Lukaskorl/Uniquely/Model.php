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
            $model->generateAndSetUniquePrimaryKey();
        });

        static::saving(function($model)
        {
            $model->generateAndSetUniquePrimaryKey();
        });
    }

    public function generateAndSetUniquePrimaryKey()
    {
        if (! $this->{$this->getKeyName()}) {
            $this->{$this->getKeyName()} = (string)$this->generatePrimaryKey();
        }
    }

    public function generatePrimaryKey()
    {
        return Uuid::uuid4();
    }

} 