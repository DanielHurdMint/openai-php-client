<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputFunctionTool
{
    private function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly string $callId,
        public readonly string $name,
        public readonly string $arguments,
        public readonly string $status,
    ) {}

    /**
     * @param  array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['id'],
            $attributes['call_id'],
            $attributes['name'],
            $attributes['arguments'],
            $attributes['status'],
        );
    }

    /**
     * @return array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'id' => $this->id,
            'call_id' => $this->callId,
            'name' => $this->name,
            'arguments' => $this->arguments,
            'status' => $this->status,
        ];

        return $result;
    }
}
