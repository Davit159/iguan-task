<?php

namespace App\User\Application;

use App\User\Adapter\UpdateUserStatePort;
use App\User\Domain\UserInfo;

class UpdateUserService implements UpdateUserUseCase
{
	public function update(UpdateUserCommand $command): void
	{
		$user = $command->getUser();

		$user->setEmail($command->getEmail());
		$user->setName($command->getName());

		$userInfo = $user->getUserInfo();
		$userInfo->setPassport($command->getPassport());
		$userInfo->setPhone($command->getPhone());

		$user->setUserInfo($userInfo);
	}
}