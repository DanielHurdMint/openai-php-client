<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolChoiceHosted
{
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  array{type: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
        );
    }

    /**
     * @return array{type: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
        ];

        return $result;
    }
}
