<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputWebSearchTool
{
    private function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly string $status,
    ) {}

    /**
     * @param  array{type: string, id: string, status: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['id'],
            $attributes['status'],
        );
    }

    /**
     * @return array{type: string, id: string, status: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'id' => $this->id,
            'status' => $this->status,
        ];

        return $result;
    }
}
