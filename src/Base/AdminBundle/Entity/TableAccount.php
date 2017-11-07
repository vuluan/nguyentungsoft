<?php

namespace Base\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TableAccount
 *
 * @ORM\Table(name="tbl_account")
 * @ORM\Entity(repositoryClass="Base\AdminBundle\Repository\TableAccountRepository")
 */
class TableAccount
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;


    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="identityCard", type="string", length=50, nullable=true)
     */
    private $identityCard;

    /**
     * @var string
     *
     * @ORM\Column(name="homeTown", type="text", nullable=true)
     */
    private $homeTown;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="text", nullable=true)
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255, nullable=true)
     */
    private $position;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dayOfBirth", type="datetime", nullable=true)
     */
    private $dayOfBirth;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startWorkingDate", type="datetime", nullable=true)
     */
    private $startWorkingDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="contractDuration", type="datetime", nullable=true)
     */
    private $contractDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="basicSalary", type="string", length=50, nullable=true)
     */
    private $basicSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="permanentResidence", type="text", nullable=true)
     */
    private $permanentResidence;

    /**
     * @var string
     *
     * @ORM\Column(name="permission", type="text", nullable=true)
     */
    private $permission;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=true)
     */
    private $password;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean", nullable=true)
     */
    private $visible;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createDate", type="datetime", nullable=true)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime", nullable=true)
     */
    private $updateDate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TableAccount
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return TableAccount
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return TableAccount
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return TableAccount
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getIdentityCard()
    {
        return $this->identityCard;
    }

    /**
     * @param string $identityCard
     * @return TableAccount
     */
    public function setIdentityCard($identityCard)
    {
        $this->identityCard = $identityCard;

        return $this;
    }

    /**
     * @return string
     */
    public function getHomeTown()
    {
        return $this->homeTown;
    }

    /**
     * @param string $homeTown
     * @return TableAccount
     */
    public function setHomeTown($homeTown)
    {
        $this->homeTown = $homeTown;

        return $this;
    }

    /**
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param string $experience
     * @return TableAccount
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return TableAccount
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDayOfBirth()
    {
        return $this->dayOfBirth;
    }

    /**
     * @param \DateTime $dayOfBirth
     * @return TableAccount
     */
    public function setDayOfBirth($dayOfBirth)
    {
        $this->dayOfBirth = $dayOfBirth;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartWorkingDate()
    {
        return $this->startWorkingDate;
    }

    /**
     * @param \DateTime $startWorkingDate
     * @return TableAccount
     */
    public function setStartWorkingDate($startWorkingDate)
    {
        $this->startWorkingDate = $startWorkingDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getContractDuration()
    {
        return $this->contractDuration;
    }

    /**
     * @param \DateTime $contractDuration
     * @return TableAccount
     */
    public function setContractDuration($contractDuration)
    {
        $this->contractDuration = $contractDuration;

        return $this;
    }

    /**
     * @return string
     */
    public function getBasicSalary()
    {
        return $this->basicSalary;
    }

    /**
     * @param string $basicSalary
     * @return TableAccount
     */
    public function setBasicSalary($basicSalary)
    {
        $this->basicSalary = $basicSalary;

        return $this;
    }

    /**
     * @return string
     */
    public function getPermanentResidence()
    {
        return $this->permanentResidence;
    }

    /**
     * @param string $permanentResidence
     * @return TableAccount
     */
    public function setPermanentResidence($permanentResidence)
    {
        $this->permanentResidence = $permanentResidence;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPermission()
    {
        if (!empty($this->permission)) {
            return unserialize($this->permission);
        }
        return $this->permission;
    }

    /**
     * @param $permission
     * @return TableAccount
     */
    public function setPermission($permission)
    {
        if (!empty($permission)) {
            $permission = serialize($permission);
        } else {
            $permission = null;
        }
        $this->permission = $permission;

        return $this;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return TableAccount
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return TableAccount
     */
    public function setPassword($password)
    {
        $this->password = md5($password);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return TableAccount
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * @param $visible
     * @return mixed
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return TableAccount
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param $updateDate
     * @return mixed
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }
}

