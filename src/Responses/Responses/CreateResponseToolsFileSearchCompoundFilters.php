<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolsFileSearchCompoundFilters
{
    /**
     * @param  'and'|'or'  $type
     * @param  array<int, CreateResponseToolsFileSearchComparisonFilters|CreateResponseToolsFileSearchCompoundFilters>  $filters
     */
    private function __construct(
        public readonly string $type,
        public readonly array $filters,
    ) {}

    /**
     * @param  array{type: 'and'|'or', filters: array<int, array{type: 'eq'|'neq'|'gt'|'gte'|'lt'|'lte', key: string, value: string|float|bool}|mixed>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $filters = array_map(function (mixed $filter): CreateResponseToolsFileSearchComparisonFilters|CreateResponseToolsFileSearchCompoundFilters {
            if (!is_array($filter) || !isset($filter['type'])) {
                throw new \InvalidArgumentException('Invalid filter');
            }

            switch ($filter['type']) {
                case 'or':
                case 'and':
                    return self::from([
                        'type' => $filter['type'],
                        'filters' => $filter['filters'],
                    ]);
                case 'eq':
                case 'neq':
                case 'gt':
                case 'gte':
                case 'lt':
                case 'lte':
                    return CreateResponseToolsFileSearchComparisonFilters::from([
                        'type' => $filter['type'],
                        'key' => $filter['key'],
                        'value' => $filter['value'],
                    ]);
                default:
                    throw new \InvalidArgumentException('Invalid filter type');
            }
        }, $attributes['filters']);

        return new self(
            $attributes['type'],
            $filters,
        );
    }

    /**
     * @return array{type: 'and'|'or', filters: array<int, array{type: 'eq'|'neq'|'gt'|'gte'|'lt'|'lte', key: string, value: string|float|bool}|mixed>}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'filters' => array_map(fn (CreateResponseToolsFileSearchComparisonFilters|CreateResponseToolsFileSearchCompoundFilters $filter): array => $filter->toArray(), $this->filters),
        ];

        return $result;
    }
}
