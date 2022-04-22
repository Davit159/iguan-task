<?php

namespace App\User\Application;

use App\User\Domain\User;

class UpdateUserCommand
{
	private User $user;

	private string $email;

	private string $name;

	private string $phone;

	private string $passport;

	public function __construct(
		User $user,
		string $name,
		string $email,
		string $phone,
		string $passport
	) {
		$this->user = $user;
		$this->email = $email;
		$this->name = $name;
		$this->phone = $phone;
		$this->passport = $passport;
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
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}