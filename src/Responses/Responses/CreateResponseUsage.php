<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseUsage
{
    private function __construct(
        public readonly int $inputTokens,
        public readonly int $outputTokens,
        public readonly ?CreateResponseUsageInputTokensDetails $inputTokensDetails,
        public readonly ?CreateResponseUsageOutputTokensDetails $outputTokensDetails
    ) {}

    /**
     * @param  array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['input_tokens'],
            $attributes['output_tokens'],
            isset($attributes['input_tokens_details']) ? CreateResponseUsageInputTokensDetails::from($attributes['input_tokens_details']) : null,
            isset($attributes['output_tokens_details']) ? CreateResponseUsageOutputTokensDetails::from($attributes['output_tokens_details']) : null
        );
    }

    /**
     * @return array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}}
     */
    public function toArray(): array
    {
        $result = [
            'input_tokens' => $this->inputTokens,
            'output_tokens' => $this->outputTokens,
        ];

        if ($this->inputTokensDetails) {
            $result['input_tokens_details'] = $this->inputTokensDetails->toArray();
        }

        if ($this->outputTokensDetails) {
            $result['output_tokens_details'] = $this->outputTokensDetails->toArray();
        }

        return $result;
    }
}
