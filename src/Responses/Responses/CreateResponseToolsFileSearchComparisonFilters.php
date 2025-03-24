<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolsFileSearchComparisonFilters
{
    /**
     * @param  'eq'|'neq'|'gt'|'gte'|'lt'|'lte'  $type
     */
    private function __construct(
        public readonly string $type,
        public readonly string $key,
        public readonly string|float|bool $value,
    ) {}

    /**
     * @param  array{type: 'eq'|'neq'|'gt'|'gte'|'lt'|'lte', key: string, value: string|float|bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['key'],
            $attributes['value'],
        );
    }

    /**
     * @return array{type: 'eq'|'neq'|'gt'|'gte'|'lt'|'lte', key: string, value: string|float|bool}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'key' => $this->key,
            'value' => $this->value,
        ];

        return $result;
    }
}
