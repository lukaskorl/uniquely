<?php namespace Lukaskorl\Uniquely;

use Eloquent;
use Rhumsaa\Uuid\Uuid;

abstract class Model extends Eloquent {

    public $incrementing = false;

    public function save(array $options = array())
    {
        $this->generatePrimaryKeyIfNotSet();
        return parent::save($options);
    }

    private function generatePrimaryKeyIfNotSet()
    {
        if (! $this->{$this->getKeyName()}) {
            $this->{$this->getKeyName()} = (string)$this->generatePrimaryKey();
        }
    }

    private function generatePrimaryKey()
    {
        return Uuid::uuid4();
    }

} 