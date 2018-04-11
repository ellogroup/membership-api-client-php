<?php

namespace MembershipClient\Model;

class Address
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
    private $companyName;

    /**
     * @var string
     */
    private $addressLine1;

    /**
     * @var string
     */
    private $addressLine2;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $district;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $countryCode;

    public function __construct(
        string $id,
        ?string $title,
        ?string $firstName,
        ?string $lastName,
        ?string $companyName,
        ?string $addressLine1,
        ?string $addressLine2,
        ?string $town,
        ?string $district,
        ?string $postalCode,
        ?string $countryCode
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->companyName = $companyName;
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->town = $town;
        $this->district = $district;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
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
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    /**
     * @return string
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }
}
