<?php

namespace PhpStanWpformsRules;

use PHPStan\Reflection\ReflectionProvider;
use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @implements Rule<FuncCall>
 */
class DisallowArrayMergeInLoopsRule implements Rule
{
	/** @var ReflectionProvider */
	private $reflectionProvider;

	public function __construct(ReflectionProvider $reflectionProvider)
	{
		$this->reflectionProvider = $reflectionProvider;
	}

	public function getNodeType(): string
	{
		return FuncCall::class;
	}

	/**
	 * Disallow array_merge inside foreach and for loops.
	 *
	 * @param FuncCall $node
	 * @param Scope $scope
	 * @return array<string>
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (!($node instanceof FuncCall)) {
			return [];
		}

		if (!$node->name instanceof Node\Name) {
			return [];
		}

		$functionName = $node->name->toString();

		if ($functionName !== 'array_merge') {
			return [];
		}

		// Check if we're inside a foreach or for loop
		$parent = $node->getAttribute('parent');
		while ($parent !== null) {
			if ($parent instanceof Node\Stmt\Foreach_ || $parent instanceof Node\Stmt\For_) {
				return [
					'Do not use array_merge inside foreach or for loops.',
				];
			}
			$parent = $parent->getAttribute('parent');
		}

		return [];
	}
}