<?php

namespace MembershipClient\Model;

class Customer
{
    private $id;
    private $title;
    private $firstName;
    private $lastName;
    private $emailAddress;
    private $phoneNumber;
    private $mobilePhone;

    public function __construct(
        string $id,
        string $title,
        string $firstName,
        string $lastName,
        string $emailAddress,
        string $phoneNumber,
        string $mobilePhone
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->emailAddress = $emailAddress;
        $this->phoneNumber = $phoneNumber;
        $this->mobilePhone = $mobilePhone;
    }
}
