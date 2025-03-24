<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputFileSearchTool
{
    /**
     * @param  list<string>  $queries
     * @param  ?array<int, CreateResponseOutputFileSearchToolResult>  $results
     */
    private function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly array $queries,
        public readonly string $status,
        public readonly ?array $results,
    ) {}

    /**
     * @param  array{type: string, id: string, queries: list<string>, status: string, results?: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $results = null;
        if (array_key_exists('results', $attributes) && is_array($attributes['results'])) {
            $results = array_map(
                fn (array $result): CreateResponseOutputFileSearchToolResult => CreateResponseOutputFileSearchToolResult::from($result),
                $attributes['results']
            );
        }

        return new self(
            $attributes['type'],
            $attributes['id'],
            $attributes['queries'],
            $attributes['status'],
            $results,
        );
    }

    /**
     * @return array{type: string, id: string, queries: list<string>, status: string, results?: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}
     */
    public function toArray(): array
    {
        $results = null;
        if (is_array($this->results)) {
            $results = array_map(
                static fn (CreateResponseOutputFileSearchToolResult $result): array => $result->toArray(),
                $this->results,
            );
        }

        $result = [
            'type' => $this->type,
            'id' => $this->id,
            'queries' => $this->queries,
            'status' => $this->status,
            'results' => $results,
        ];

        return $result;
    }
}
