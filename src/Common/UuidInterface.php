<?php

namespace App\Common;

interface UuidInterface
{
	/**
	 * Return V4 Rfc4122 uuid
	 *
	 * @return string
	 */
	public function getUuidRfc4122(): string;

	/**
	 * @return string
	 */
	public function toString(): string;
}