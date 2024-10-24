<?php

declare(strict_types=1);

namespace PhpStanCustomRules\Tests\Data;

function testArrayMergeInLoop(): void
{
	$arrays = [
		['a' => 1],
		['b' => 2],
	];

	$result = [];
	foreach ($arrays as $array) {
		$result = array_merge($result, $array); // This should trigger an error
	}
}