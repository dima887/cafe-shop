<?php

namespace App\Dto\Auth;

class AuthLoginDto
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $email,
        public string $password,
    )
    {}
}
