<?php

namespace TechFinancials\Requests;

use TechFinancials\Request;

class RegisterTraderRequest extends Request
{
    const ACCOUNT_LEVEL_REGULAR  = 1;
    const ACCOUNT_LEVEL_GOLD     = 2;
    const ACCOUNT_LEVEL_PLATINUM = 3;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getAccountLevelId()
    {
        return $this->accountLevelId;
    }

    /**
     * @return null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getTrackingCode()
    {
        return $this->trackingCode;
    }

    protected $username = '';
    protected $password = '';
    protected $firstName = '';
    protected $lastName = '';
    protected $phone = '';

    /**
     * Two-letter ISO code If not supplied, country code is automatically filled according to registration IP.
     *
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $currencyCode;

    protected $email = '';

    /**
     * Determines how trader is treated regarding things such as trading limits, bonuses etc. (1=regular, 2=gold, 3=platinum).
     *
     * @var int
     */
    protected $accountLevelId = self::ACCOUNT_LEVEL_REGULAR;

    /**
     * Language ISO code; If not supplied, filled automatically according to country default.
     *
     * @var null
     */
    protected $language = null;

    protected $trackingCode;
}
