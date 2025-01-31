<?php

declare(strict_types=1);

namespace TwigCsFixer\Sniff;

use TwigCsFixer\Token\Token;

/**
 * Ensure there is no consecutive spaces inside operator names.
 */
final class OperatorNameSpacingSniff extends AbstractSniff
{
    protected function process(int $tokenPosition, array $tokens): void
    {
        $token = $tokens[$tokenPosition];
        if (!$this->isTokenMatching($token, Token::OPERATOR_TYPE)) {
            return;
        }

        $value = $token->getValue();
        // Ignore multi lines operators
        if (1 === preg_match('#\n#', $value)) {
            return;
        }

        $newValue = preg_replace('#\s+#', ' ', $value);
        if (!\is_string($newValue) || $value === $newValue) {
            return;
        }

        $fixer = $this->addFixableError(
            'A single line operator should not have consecutive spaces.',
            $token
        );

        if (null === $fixer) {
            return;
        }

        $fixer->replaceToken($tokenPosition, $newValue);
    }
}
