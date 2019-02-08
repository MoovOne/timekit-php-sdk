<?php

namespace MoovOne\TimekitPhpSdk\Model;

/**
 * Class Customer
 * @package MoovOne\TimekitPhpSdk\Model
 */
class Customer implements \JsonSerializable
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * serialize the object.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
