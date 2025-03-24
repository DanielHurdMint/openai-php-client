<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolChoiceFunction
{
    private function __construct(
        public readonly string $name,
        public readonly string $type,
    ) {}

    /**
     * @param  array{name: string, type: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
            $attributes['type'],
        );
    }

    /**
     * @return array{name: string, type: string}
     */
    public function toArray(): array
    {
        $result = [
            'name' => $this->name,
            'type' => $this->type,
        ];

        return $result;
    }
}
