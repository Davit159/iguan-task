<?php

namespace App\User\Adapter;

use App\User\Domain\User;

interface LoadUserPort
{
	/**
	 * @return User[]
	 */
	public function getAllUsers(): array;

	public function getById(string $userId): User;
}