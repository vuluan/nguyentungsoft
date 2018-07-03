<?php

namespace Base\AdminBundle\Entity;

/**
 * Class Product
 * @package Base\AdminBundle\Entity
 */
class Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $mainImage;

    /**
     * @var string
     */
    private $subImages;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $salePrice;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var bool
     */
    private $removedRecord;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \DateTime
     */
    private $updatedDate;

    /**
     * Account constructor.
     */
    public function __construct()
    {
        $this->setActive(true);
        $this->setRemovedRecord(false);
        $this->setCreatedDate(new \DateTime());
        $this->setUpdatedDate(new \DateTime());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMainImage(): string
    {
        return $this->mainImage;
    }

    /**
     * @param string $mainImage
     */
    public function setMainImage(string $mainImage)
    {
        $this->mainImage = $mainImage;
    }

    /**
     * @return string
     */
    public function getSubImages(): string
    {
        return $this->subImages;
    }

    /**
     * @param string $subImages
     */
    public function setSubImages(string $subImages)
    {
        $this->subImages = $subImages;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getSalePrice(): float
    {
        return $this->salePrice;
    }

    /**
     * @param float $salePrice
     */
    public function setSalePrice(float $salePrice)
    {
        $this->salePrice = $salePrice;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isRemovedRecord(): bool
    {
        return $this->removedRecord;
    }

    /**
     * @param bool $removedRecord
     */
    public function setRemovedRecord(bool $removedRecord)
    {
        $this->removedRecord = $removedRecord;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }

    /**
     * @param \DateTime $createdDate
     */
    public function setCreatedDate(\DateTime $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedDate(): \DateTime
    {
        return $this->updatedDate;
    }

    /**
     * @param \DateTime $updatedDate
     */
    public function setUpdatedDate(\DateTime $updatedDate)
    {
        $this->updatedDate = $updatedDate;
    }

}
