<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseTextFormatJsonSchema
{

    /**
     * @param  'json_schema'  $type
     * @param  array<string, mixed>  $schema
     */
    private function __construct(
        public readonly string $type,
        public readonly string $name,
        public readonly string $description,
        public readonly array $schema,
        public readonly ?bool $strict,
    ) {}

    /**
     * @param  array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['name'],
            $attributes['description'],
            $attributes['schema'],
            $attributes['strict'] ?? null,
        );
    }

    /**
     * @return array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'schema' => $this->schema,
            'strict' => $this->strict,
        ];

        return $result;
    }
}
