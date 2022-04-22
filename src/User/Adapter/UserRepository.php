<?php

namespace App\User\Adapter;

use App\User\Domain\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository implements LoadUserPort
{
	/**
	 * @var ServiceEntityRepository
	 */
	private ServiceEntityRepository $serviceEntityRepository;

	/**
	 * NoteRepository constructor.
	 *
	 * @param ServiceEntityRepository $serviceEntityRepository
	 */
	public function __construct(ServiceEntityRepository $serviceEntityRepository)
	{
		$this->serviceEntityRepository = $serviceEntityRepository;
	}

	/**
	 * @return User[]
	 */
	public function getAllUsers(): array
	{
		return $this->serviceEntityRepository->findAll();
	}

	public function getById(string $userId): User
	{
		$user = $this->serviceEntityRepository->findOneBy(['id' => $userId]);

		if (! $user instanceof User) {
			throw new NotFoundHttpException(
				'User not found,'
			);
		}

		return $user;
	}
}