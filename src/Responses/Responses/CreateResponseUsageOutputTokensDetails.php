<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseUsageOutputTokensDetails
{
    private function __construct(
        public readonly int $reasoningTokens,
    ) {}

    /**
     * @param  array{reasoning_tokens:int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['reasoning_tokens'],
        );
    }

    /**
     * @return array{reasoning_tokens:int}
     */
    public function toArray(): array
    {
        $result = [
            'reasoning_tokens' => $this->reasoningTokens,
        ];

        return $result;
    }
}
