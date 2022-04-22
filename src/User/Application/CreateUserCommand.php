<?php

namespace App\User\Application;

class CreateUserCommand
{
	private string $email;

	private string $name;

	private string $phone;

	private string $passport;

	public function __construct(
		string $name,
		string $email,
		string $phone,
		string $passport
	) {
		$this->email = $email;
		$this->name = $name;
		$this->phone = $phone;
		$this->passport = $passport;
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
	 * @return string
	 */
	public function getPhone(): string
	{
		return $this->phone;
	}

	/**
	 * @return string
	 */
	public function getPassport(): string
	{
		return $this->passport;
	}
}