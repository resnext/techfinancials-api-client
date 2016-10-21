<?php

namespace TechFinancials\Responses;

use TechFinancials\Payload;
use TechFinancials\Response;

class RegisterTraderResponse extends Response
{
    const FIELDS_PREFIX = 'apiaccountview';

    const FIELD_ID = 'id';

    /**
     * @var null
     */
    protected $id = null;

    public function __construct(Payload $payload)
    {
        parent::__construct($payload);

        if (!$this->isSuccess()) {
            return;
        }

        $data = $payload->getData();

        $this->id = $data[self::FIELD_RESULT][self::FIELDS_PREFIX . '_' . self::FIELD_ID];
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
}
