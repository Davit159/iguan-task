<?php

namespace App\User\Domain;

use App\Common\UuidGeneratorInterface;
use App\User\Application\CreateUserCommand;

class UserFactory
{
	private UuidGeneratorInterface $uuidGenerator;

	public function __construct(UuidGeneratorInterface $uuidGenerator)
	{
		$this->uuidGenerator = $uuidGenerator;
	}

	public function create(CreateUserCommand $command)
	{


		$user = new User(
			$this->uuidGenerator->getUuid(),
			$command->getName(),
			$command->getEmail()
		);
		$userInfo = new UserInfo($this->uuidGenerator->getUuid(),$command->getPassport(), $command->getPhone(), $user);

		$user->setUserInfo($userInfo);

		return $user;
	}
}