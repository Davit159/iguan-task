<?php

namespace App\User\Application;

use App\User\Domain\User;

interface CreateUserUseCase
{
	public function createByCommand(CreateUserCommand $command): User;
}