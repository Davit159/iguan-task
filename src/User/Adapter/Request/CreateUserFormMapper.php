<?php

namespace App\User\Adapter\Request;

use App\User\Application\CreateUserCommand;
use App\User\Application\UpdateUserCommand;
use App\User\Domain\User;

class CreateUserFormMapper
{
	public function mapToCreateUserCommand(CreateUserForm $formData): CreateUserCommand
	{
		return new CreateUserCommand($formData->Name, $formData->Email, $formData->Phone, $formData->Passport);
	}

	public function mapToUpdateUserCommand(CreateUserForm $formData, User $user)
	{
		return new UpdateUserCommand($user, $formData->Name,$formData->Email, $formData->Phone, $formData->Passport);
	}
}