<?php

namespace TechFinancials\Entities;

use TechFinancials\Entity;

/**
 * Class Account
 * @package TechFinancials\Entities
 */
class Account extends Entity
{
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;


}
