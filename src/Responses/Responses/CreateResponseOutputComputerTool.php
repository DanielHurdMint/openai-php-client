<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputComputerTool
{
    // TODO: Implement the class for the action and pending safety checks
    /**
     * @param  array<mixed, mixed>  $action
     * @param  array<int, mixed>  $pendingSafetyChecks
     */
    private function __construct(
        public readonly string $type,
        public readonly string $id,
        public readonly string $callId,
        public readonly string $status,
        public readonly array $action,
        public readonly array $pendingSafetyChecks,
    ) {}

    /**
     * @param  array{type: string, id: string, call_id: string, status: string, action: array<mixed, mixed>, pending_safety_checks: array<int, mixed>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['id'],
            $attributes['call_id'],
            $attributes['status'],
            $attributes['action'],
            $attributes['pending_safety_checks'],
        );
    }

    /**
     * @return array{type: string, id: string, call_id: string, status: string, action: array<mixed, mixed>, pending_safety_checks: array<int, mixed>}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'id' => $this->id,
            'call_id' => $this->callId,
            'status' => $this->status,
            'action' => $this->action,
            'pending_safety_checks' => $this->pendingSafetyChecks,
        ];

        return $result;
    }
}
