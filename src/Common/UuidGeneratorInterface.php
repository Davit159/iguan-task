<?php

namespace App\Common;

interface UuidGeneratorInterface
{
	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface;

	/**
	 * @param string $uuid
	 *
	 * @return UuidInterface
	 */
	public function fromString(string $uuid): UuidInterface;
}
