<?php

namespace Base\AdminBundle\Entity;

/**
 * Class Product
 * @package Base\AdminBundle\Entity
 */
class Product
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $linkDetail;

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
     * @var string
     */
    private $categoryId;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var bool
     */
    private $saleStatus;

    /**
     * @var bool
     */
    private $newStatus;

    /**
     * @var string
     */
    private $seoTitle;

    /**
     * @var string
     */
    private $seoDescription;

    /**
     * @var string
     */
    private $seoKeyword;

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
        $this->setId(md5(uniqid(rand(), true)));
        $this->setActive(true);
        $this->setName("");
        $this->setSlug("");
        $this->setSeoTitle("");
        $this->setSeoDescription("");
        $this->setSeoKeyword("");
        $this->setRemovedRecord(false);
        $this->setCreatedDate(new \DateTime());
        $this->setUpdatedDate(new \DateTime());
        $this->setMainImage("");
        $this->setPrice(0);
        $this->setSalePrice(0);
        $this->setCategoryId(0);
        $this->setSubImages("");
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
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
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getLinkDetail(): string
    {
        return sprintf("%s-%s.html", $this->getId(), $this->getSlug());
    }

    /**
     * @param string $linkDetail
     */
    public function setLinkDetail(string $linkDetail)
    {
        $this->linkDetail = $linkDetail;
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
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @param string $categoryId
     */
    public function setCategoryId(string $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
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
    public function isSaleStatus(): bool
    {
        if ($this->salePrice < $this->price) {
            return true;
        }
        return false;
    }

    /**
     * @param bool $saleStatus
     */
    public function setSaleStatus(bool $saleStatus)
    {
        $this->saleStatus = $saleStatus;
    }

    /**
     * @return bool
     */
    public function isNewStatus(): bool
    {
        $updateDate = strtotime($this->getUpdatedDate()->format('Y-m-d h:i:s'));
        $now = strtotime("-1 month");
        if ($updateDate > $now) {
            return true;
        }
        return false;
    }

    /**
     * @param bool $newStatus
     */
    public function setNewStatus(bool $newStatus)
    {
        $this->newStatus = $newStatus;
    }

    /**
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * @param string $seoTitle
     */
    public function setSeoTitle(string $seoTitle)
    {
        $this->seoTitle = $seoTitle;
    }

    /**
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * @param string $seoDescription
     */
    public function setSeoDescription(string $seoDescription)
    {
        $this->seoDescription = $seoDescription;
    }

    /**
     * @return string
     */
    public function getSeoKeyword()
    {
        return $this->seoKeyword;
    }

    /**
     * @param string $seoKeyword
     */
    public function setSeoKeyword(string $seoKeyword)
    {
        $this->seoKeyword = $seoKeyword;
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
