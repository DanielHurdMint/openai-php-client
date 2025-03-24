<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputMessage
{
    /**
     * @param  array<int, CreateResponseOutputMessageContentText|CreateResponseOutputMessageContentRefusal>  $content
     */
    private function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly string $role,
        public readonly string $status,
        public readonly array $content,
    ) {}

    /**
     * @param  array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $content = array_map(fn (array $result): CreateResponseOutputMessageContentText|CreateResponseOutputMessageContentRefusal => $result['type'] === 'output_text' ? CreateResponseOutputMessageContentText::from(['type' => $result['type'], 'annotations' => $result['annotations'] ?? [], 'text' => $result['text'] ?? '']) : CreateResponseOutputMessageContentRefusal::from(['type' => $result['type'], 'refusal' => $result['refusal'] ?? '']), $attributes['content']);

        return new self(
            $attributes['type'],
            $attributes['id'],
            $attributes['role'],
            $attributes['status'],
            $content,
        );
    }

    /**
     * @return array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}
     */
    public function toArray(): array
    {
        $content = array_map(
            static fn (CreateResponseOutputMessageContentText|CreateResponseOutputMessageContentRefusal $content): array => $content->toArray(),
            $this->content,
        );

        $result = [
            'type' => $this->type,
            'id' => $this->id,
            'role' => $this->role,
            'status' => $this->status,
            'content' => $content,
        ];

        return $result;
    }
}
