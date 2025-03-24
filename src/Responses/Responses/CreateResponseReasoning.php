<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseReasoning
{
    private function __construct(
        public readonly ?string $effort,
        public readonly ?string $generateSummary,
    ) {}

    /**
     * @param  array{effort: string|null, generate_summary: string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['effort'] ?? null,
            $attributes['generate_summary'] ?? null,
        );
    }

    /**
     * @return array{effort: string|null, generate_summary: string|null}
     */
    public function toArray(): array
    {
        $result = [
            'effort' => $this->effort,
            'generate_summary' => $this->generateSummary,
        ];

        return $result;
    }
}
