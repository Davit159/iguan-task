<?php

namespace App\Common;

use Symfony\Component\Uid\AbstractUid;

class Uuid implements UuidInterface
{
	/**
	 * @var AbstractUid
	 */
	private $abstractUuid;

	/**
	 * Uuid constructor.
	 *
	 * @param AbstractUid $abstractUuid
	 */
	public function __construct(AbstractUid $abstractUuid)
	{
		$this->abstractUuid = $abstractUuid;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getUuidRfc4122(): string
	{
		return $this->abstractUuid->toRfc4122();
	}

	/**
	 * {@inheritDoc}
	 */
	public function toString(): string
	{
		return $this->getUuidRfc4122();
	}
}
