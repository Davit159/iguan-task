<?php

namespace App\User\Adapter;


use App\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;

class UserPersistenceAdapter implements UpdateUserStatePort
{
	private EntityManagerInterface $entityManager;

	/**
	 * UserPersistenceAdapter constructor.
	 *
	 * @param EntityManagerInterface $entityManager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * {@inheritDoc}
	 */
	public function save(User $user): void
	{
		$this->entityManager->persist($user);
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete(User $user): void
	{
		$this->entityManager->remove($user);
	}
}