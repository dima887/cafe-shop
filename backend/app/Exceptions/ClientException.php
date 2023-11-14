<?php

namespace App\Exceptions;

class ClientException extends \Exception
{
    /**
     * @var string
     */
    private string $userMessage;
    /**
     * @var int
     */
    private int $userCode;

    public function __construct(string $userMessage, $userCode)
    {
        $this->userMessage = $userMessage;
        $this->userCode = $userCode;
        parent::__construct($userMessage, $userCode);
    }

    /**
     * @return string
     */
    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    /**
     * @return int
     */
    public function getUserCode(): int
    {
        return $this->userCode;
    }
}
