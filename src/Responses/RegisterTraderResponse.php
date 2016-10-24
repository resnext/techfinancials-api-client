<?php

namespace TechFinancials\Responses;

use TechFinancials\Exceptions\EmailAlreadyExistsException;
use TechFinancials\Payload;
use TechFinancials\Response;

class RegisterTraderResponse extends Response
{
    const FIELDS_PREFIX = 'apiaccountview';

    const FIELD_ID = 'id';

    const FIELD_LINKS = 'hyperMediaLinks';

    const FIELD_LINK_TO_DEPOSIT_PAGE = 'TF_DEPOSIT';

    /**
     * @var null
     */
    protected $id = null;

    protected $depositPageUrl = null;

    public function __construct(Payload $payload)
    {
        parent::__construct($payload);

        if (!$this->isSuccess()) {
            $this->processErrors();

            return;
        }

        $data = $payload->getData();

        $this->id = $data[self::FIELD_RESULT][self::FIELDS_PREFIX . '_' . self::FIELD_ID];

        if (isset($data[self::FIELD_LINKS][self::FIELD_LINK_TO_DEPOSIT_PAGE])) {
            $this->depositPageUrl = $data[self::FIELD_LINKS][self::FIELD_LINK_TO_DEPOSIT_PAGE];
        }
    }

    /**
     * Returns ID of registered trader in the TF platform.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns URL for deposit page with auto-login.
     *
     * @return string
     */
    public function getDepositPageUrl()
    {
        return $this->depositPageUrl;
    }

    protected function processErrors()
    {
        // We have not another ways for this error detection... Thank you, TF.
        if ($this->getErrorCodes() == 'Identical user ID already found in the system. Please enter different user ID.') {
            throw new EmailAlreadyExistsException($this, 'Email already exists');
        }
    }
}
