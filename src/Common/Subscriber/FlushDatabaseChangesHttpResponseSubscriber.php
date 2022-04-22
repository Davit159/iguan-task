<?php

namespace App\Common\Subscriber;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class FlushDatabaseChangesHttpResponseSubscriber implements EventSubscriberInterface
{
	private EntityManagerInterface $entityManager;

	/**
	 * FinishRequestSubscriber constructor.
	 *
	 * @param EntityManagerInterface $entityManager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @return array<string, array<int, array<int, int|string>>>
	 */
	public static function getSubscribedEvents()
	{
		return [
			KernelEvents::RESPONSE => [
				['processDatabaseFlush', 10],
			],
		];
	}

	public function processDatabaseFlush(ResponseEvent $event): void
	{
		$this->entityManager->flush();
	}
}