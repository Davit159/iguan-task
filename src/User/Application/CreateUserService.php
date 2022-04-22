<?php

namespace App\User\Application;

use App\User\Adapter\UserPersistenceAdapter;
use App\User\Domain\User;
use App\User\Domain\UserFactory;

class CreateUserService implements CreateUserUseCase
{
	public UserFactory $userFactory;

	public UserPersistenceAdapter $persistenceAdapter;

	public function __construct(UserFactory $userFactory, UserPersistenceAdapter $persistenceAdapter)
	{
	    $this->userFactory = $userFactory;
	    $this->persistenceAdapter = $persistenceAdapter;
	}

	public function createByCommand(CreateUserCommand $command): User
	{
		$user = $this->userFactory->create($command);

		$this->persistenceAdapter->save($user);

		return $user;
	}
}