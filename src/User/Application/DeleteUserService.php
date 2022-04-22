<?php

namespace App\User\Application;

use App\User\Adapter\UserPersistenceAdapter;
use App\User\Domain\User;

class DeleteUserService implements DeleteUserUseCase
{
	public UserPersistenceAdapter $persistenceAdapter;

	public function __construct(UserPersistenceAdapter $persistenceAdapter)
	{
		$this->persistenceAdapter = $persistenceAdapter;
	}

	public function delete(User $user)
	{
		$this->persistenceAdapter->delete($user);
	}
}