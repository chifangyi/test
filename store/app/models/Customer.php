<?php
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Customer extends Model
{

    public function initialize()
    {
        $this->setSource("customer");
    }



    //采用默认的对应规则会自动映射数据库表的字段，可以不写
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    public function setUsername($username)
    {
        //The name is too short?
        if (strlen($username) < 10) {
            throw new \InvalidArgumentException('The username is too short');
        }
        $this->username = $username;
    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'customer';
    }
}