<?php

namespace App\Common;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ServiceEntityRepositoryFactory
{
	/**
	 * @var ManagerRegistry
	 */
	private $registry;

	/**
	 * ServiceEntityRepositoryFactory constructor.
	 *
	 * @param ManagerRegistry $registry
	 */
	public function __construct(ManagerRegistry $registry)
	{
		$this->registry = $registry;
	}

	/**
	 * @param class-string $entityClassName
	 *
	 * @return ServiceEntityRepository
	 */
	public function create(string $entityClassName): ServiceEntityRepository
	{
		return new ServiceEntityRepository($this->registry, $entityClassName);
	}
}