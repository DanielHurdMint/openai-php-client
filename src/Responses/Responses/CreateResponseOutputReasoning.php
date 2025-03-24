<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputReasoning
{
    /**
     * @param  ?array<int, CreateResponseOutputReasoningSummary>  $summary
     */
    private function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly string $status,
        public readonly ?array $summary,
    ) {}

    /**
     * @param  array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $summary = array_map(
            fn (array $result): CreateResponseOutputReasoningSummary => CreateResponseOutputReasoningSummary::from($result),
            $attributes['summary'] ?? []
        );

        return new self(
            $attributes['type'],
            $attributes['id'],
            $attributes['status'],
            $summary,
        );
    }

    /**
     * @return array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}
     */
    public function toArray(): array
    {
        $summary = array_map(
            static fn (CreateResponseOutputReasoningSummary $result): array => $result->toArray(),
            $this->summary ?? [],
        );

        $result = [
            'type' => $this->type,
            'id' => $this->id,
            'status' => $this->status,
            'summary' => $summary,
        ];

        return $result;
    }
}
