<?php

namespace MembershipClient\Model;

class Customer
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $mobilePhone;

    /**
     * @var int
     */
    private $consumerId;

    /**
     * @var string
     */
    private $consumerCustomerId;

    /**
     * @var array
     */
    private $addresses;

    /**
     * @var array
     */
    private $memberships;

    public function __construct(
        string $id,
        ?string $title,
        ?string $firstName,
        ?string $lastName,
        ?string $emailAddress,
        ?string $phoneNumber,
        ?string $mobilePhone,
        string $consumerId,
        string $consumerCustomerId,
        array $addresses,
        array $memberships
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->emailAddress = $emailAddress;
        $this->phoneNumber = $phoneNumber;
        $this->mobilePhone = $mobilePhone;
        $this->consumerId = $consumerId;
        $this->consumerCustomerId = $consumerCustomerId;
        $this->addresses = $addresses;
        $this->memberships = $memberships;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @return int
     */
    public function getConsumerId(): int
    {
        return $this->consumerId;
    }

    /**
     * @return string
     */
    public function getConsumerCustomerId(): string
    {
        return $this->consumerCustomerId;
    }

    /**
     * @return Address[]
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @return Membership[]
     */
    public function getMemberships(): array
    {
        return $this->memberships;
    }
}
