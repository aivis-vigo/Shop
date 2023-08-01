<?php declare(strict_types=1);

namespace App\Exceptions;

use Couchbase\BadInputException;

class PasswordsDoNotMatchException extends UserAlreadyExistsException
{
}