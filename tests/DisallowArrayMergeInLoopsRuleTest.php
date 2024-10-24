<?php

namespace PhpStanCustomRules\Tests;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PhpStanCustomRules\DisallowArrayMergeInLoopsRule;

/**
 * @extends RuleTestCase<DisallowArrayMergeInLoopsRule>
 */
class DisallowArrayMergeInLoopsRuleTest extends RuleTestCase
{
	protected function getRule(): Rule
	{
		return new DisallowArrayMergeInLoopsRule(
			$this->createReflectionProvider()
		);
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__ . '/data/array-merge-in-loop.php'], [
			[
				'Do not use array_merge inside foreach or for loops.',
				16,
			],
		]);
	}
}