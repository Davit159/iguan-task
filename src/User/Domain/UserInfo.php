<?php

namespace App\User\Domain;

use App\Common\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_info")
 */
class UserInfo
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="guid")
	 */
	private string $id;


	/**
	 * @ORM\Column(type="string", length=180, unique=true)
	 */
	private string $phone;

	/**
	 * @ORM\Column(type="string", length=180, unique=true)
	 */
	private string $passport;

	/**
	 * @ORM\OneToOne(targetEntity="App\User\Domain\User",  inversedBy="userInfo")
	 * @ORM\JoinColumn(name="user_id",
	 *     referencedColumnName="id")
	 */
	private User $user;

	public function __construct(
		UuidInterface $id,
		string $passport,
		string $phone,
		User $user
	) {
	    $this->id = $id->toString();
		$this->passport = $passport;
		$this->phone = $phone;
		$this->user = $user;
	}

	/**
	 * @param string $passport
	 */
	public function setPassport(string $passport): void
	{
		$this->passport = $passport;
	}

	/**
	 * @param string $phone
	 */
	public function setPhone(string $phone): void
	{
		$this->phone = $phone;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @return User
	 */
	public function getUser(): User
	{
		return $this->user;
	}

	/**
	 * @return string
	 */
	public function getPassport(): string
	{
		return $this->passport;
	}

	/**
	 * @return string
	 */
	public function getPhone(): string
	{
		return $this->phone;
	}
}