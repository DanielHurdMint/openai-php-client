<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolsFunction
{
    /**
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        public readonly string $type,
        public readonly string $name,
        public readonly ?string $description,
        public readonly array $parameters,
        public readonly bool $strict,
    ) {}

    /**
     * @param  array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['name'],
            $attributes['description'] ?? null,
            $attributes['parameters'],
            $attributes['strict'],
        );
    }

    /**
     * @return array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'parameters' => $this->parameters,
            'strict' => $this->strict,
        ];

        return $result;
    }
}
