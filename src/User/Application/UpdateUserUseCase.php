<?php

namespace App\User\Application;

interface UpdateUserUseCase
{
	/**
	 * @param UpdateUserCommand $command
	 */
	public function update(UpdateUserCommand $command): void;
}