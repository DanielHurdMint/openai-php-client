<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputMessageContentRefusal
{
    private function __construct(
        public readonly string $type,
        public readonly string $refusal,
    ) {}

    /**
     * @param  array{type: string, refusal: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['refusal'],
        );
    }

    /**
     * @return array{type: string, refusal: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'refusal' => $this->refusal,
        ];

        return $result;
    }
}
