<?php

function generatePasswordHash($password, $cost = 13)
{
    if (function_exists('password_hash')) {
        /** @noinspection PhpUndefinedConstantInspection */
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => $cost]);
    }

    $salt = $this->generateSalt($cost);
    $hash = crypt($password, $salt);
    // strlen() is safe since crypt() returns only ascii
    if (!is_string($hash) || strlen($hash) !== 60) {
        throw new Exception('Unknown error occurred while generating hash.');
    }

    return $hash;
}

echo $str = generatePasswordHash('123456');
