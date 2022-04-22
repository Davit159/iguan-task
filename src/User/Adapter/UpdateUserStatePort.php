<?php

namespace App\User\Adapter;


use App\User\Domain\User;

interface UpdateUserStatePort
{
	/**
	 * @param User $user
	 */
	public function save(User $user): void;
}