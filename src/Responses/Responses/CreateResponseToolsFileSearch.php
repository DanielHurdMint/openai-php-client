<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

/**
 * @phpstan-type ComparisonFilter array{
 *   type: 'eq'|'neq'|'gt'|'gte'|'lt'|'lte',
 *   key: string,
 *   value: string|float|bool
 * }
 * @phpstan-type CompoundFilter array{
 *   type: 'and'|'or',
 *   filters: list<Filter>
 * }
 * @phpstan-type Filter ComparisonFilter|CompoundFilter
 * @phpstan-type Tool array{
 *   type: string,
 *   vector_store_ids: list<mixed>,
 *   filters: Filter,
 *   max_num_results: int,
 *   ranking_options: array{
 *     ranker: string,
 *     score_threshold: float
 *   }
 * }
 */
final class CreateResponseToolsFileSearch
{
    /**
     * @param  array<int, mixed>  $vectorStoreIds
     * @param  CreateResponseToolsFileSearchComparisonFilters|CreateResponseToolsFileSearchCompoundFilters  $filters
     */
    private function __construct(
        public readonly string $type,
        public readonly array $vectorStoreIds,
        public readonly CreateResponseToolsFileSearchComparisonFilters|CreateResponseToolsFileSearchCompoundFilters $filters,
        public readonly int $maxNumResults,
        public readonly CreateResponseToolsFileSearchRankingOptions $rankingOptions,
    ) {}

    /**
     * @param Tool $attributes
     */
    public static function from(array $attributes): self
    {
        if ($attributes['filters']['type'] === 'and' || $attributes['filters']['type'] === 'or') {
            $filters = CreateResponseToolsFileSearchCompoundFilters::from(['type' => $attributes['filters']['type'], 'filters' => $attributes['filters']['filters']]);
        } else if ($attributes['filters']['type'] === 'eq' || $attributes['filters']['type'] === 'neq' || $attributes['filters']['type'] === 'gt' || $attributes['filters']['type'] === 'gte' || $attributes['filters']['type'] === 'lt' || $attributes['filters']['type'] === 'lte') {

            $filters = CreateResponseToolsFileSearchComparisonFilters::from(['type' => $attributes['filters']['type'], 'key' => $attributes['filters']['key'], 'value' => $attributes['filters']['value']]);
        }

        return new self(
            $attributes['type'],
            $attributes['vector_store_ids'],
            $filters,
            $attributes['max_num_results'],
            CreateResponseToolsFileSearchRankingOptions::from($attributes['ranking_options']),
        );
    }

    /**
     * @return Tool
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'vector_store_ids' => $this->vectorStoreIds,
            'filters' => $this->filters->toArray(),
            'max_num_results' => $this->maxNumResults,
            'ranking_options' => $this->rankingOptions->toArray(),
        ];

        return $result;
    }
}
