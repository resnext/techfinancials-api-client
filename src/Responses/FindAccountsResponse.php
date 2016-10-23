<?php

namespace TechFinancials\Responses;

use TechFinancials\Entities\Account;
use TechFinancials\Payload;
use TechFinancials\Response;

class FindAccountsResponse extends Response
{
    const FIELDS_PREFIX = 'apiaccountview';

    const FIELD_ID      = 'id';

    const FIELD_EMAIL   = 'email';

    /**
     * @var \TechFinancials\Entities\Account[]
     */
    protected $accounts = [];

    public function __construct(Payload $payload)
    {
        parent::__construct($payload);

        if (!$this->isSuccess()) {
            return;
        }

        $data = $payload->getData();

        if (empty($data[self::FIELD_RESULT]) || !is_array($data[self::FIELD_RESULT])) {
            return;
        }

        foreach ($data[self::FIELD_RESULT] as $accountData) {
            $this->accounts[] = new Account([
                'id' => $accountData[self::FIELDS_PREFIX.'_'.self::FIELD_ID],
                'email' => $accountData[self::FIELDS_PREFIX.'_'.self::FIELD_EMAIL],
            ]);
        }
    }

    /**
     * @return \TechFinancials\Entities\Account[]
     */
    public function getAccounts()
    {
        return $this->accounts;
    }
}
