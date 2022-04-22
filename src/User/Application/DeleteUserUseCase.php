<?php

namespace App\User\Application;

use App\User\Domain\User;

interface DeleteUserUseCase
{
	public function delete(User $user);
}