<?php

declare(strict_types=1);

namespace TwigCsFixer\Sniff;

use TwigCsFixer\Token\Token;

/**
 * Ensure there is one space before and after block names.
 */
final class BlockNameSpacingSniff extends AbstractSpacingSniff
{
    /**
     * @param array<int, Token> $tokens
     */
    protected function getSpaceBefore(int $tokenPosition, array $tokens): ?int
    {
        $token = $tokens[$tokenPosition];

        if ($this->isTokenMatching($token, Token::BLOCK_NAME_TYPE)) {
            return 1;
        }

        return null;
    }

    /**
     * @param array<int, Token> $tokens
     */
    protected function getSpaceAfter(int $tokenPosition, array $tokens): ?int
    {
        $token = $tokens[$tokenPosition];

        if ($this->isTokenMatching($token, Token::BLOCK_NAME_TYPE)) {
            return 1;
        }

        return null;
    }
}
