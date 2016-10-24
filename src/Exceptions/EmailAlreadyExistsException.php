<?php

namespace TechFinancials\Exceptions;

use TechFinancials\ServerException;

/**
 * This exception thrown when request successfully sent and response successfully received and parsed but from
 * server received message about something is wrong.
 *
 * Class EmailAlreadyExistsException
 * @package TechFinancials\Exceptions
 */
class EmailAlreadyExistsException extends ServerException
{

}
