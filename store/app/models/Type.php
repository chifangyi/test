<?php
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Type extends Model
{

    public function initialize()
    {
        $this->setSource("type");
    }
}