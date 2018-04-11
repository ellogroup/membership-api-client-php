<?php

namespace MembershipClient\Model;

class Membership
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTimeImmutable
     */
    private $started;

    /**
     * @var \DateTimeImmutable
     */
    private $expires;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $cardNumber;

    /**
     * @var string
     */
    private $cardholderName;

    public function __construct(
        string $id,
        string $status,
        \DateTimeImmutable $started,
        \DateTimeImmutable $expires,
        ?string $type,
        ?string $number,
        ?string $cardNumber,
        ?string $cardholderName
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->started = $started;
        $this->expires = $expires;
        $this->type = $type;
        $this->number = $number;
        $this->cardNumber = $cardNumber;
        $this->cardholderName = $cardholderName;
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStarted(): \DateTimeImmutable
    {
        return $this->started;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getExpires(): \DateTimeImmutable
    {
        return $this->expires;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    /**
     * @return string
     */
    public function getCardholderName(): ?string
    {
        return $this->cardholderName;
    }
}
