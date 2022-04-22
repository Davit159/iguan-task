<?php

namespace App\User\Domain;

use App\Common\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="guid")
	 */
	private string $id;

	/**
	 * @ORM\Column(type="string", length=180, unique=true)
	 */
	private string $name;

	/**
	 * @ORM\Column(type="string", length=180, unique=true)
	 */
	private string $email;

	/**
	 * @ORM\OneToOne(targetEntity="App\User\Domain\UserInfo", mappedBy="user", cascade={"ALL"})
	 */
	private ?UserInfo $userInfo = null;

	public function __construct(
		UuidInterface $id,
		string $name,
		string $email
	) {
		$this->id = $id->toString();
		$this->email = $email;
		$this->name = $name;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
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
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @return UserInfo|null
	 */
	public function getUserInfo(): ?UserInfo
	{
		return $this->userInfo;
	}

	/**
	 * @param UserInfo|null $userInfo
	 */
	public function setUserInfo(?UserInfo $userInfo): void
	{
		$this->userInfo = $userInfo;
	}
}