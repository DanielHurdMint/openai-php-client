<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputReasoningSummary
{
    private function __construct(
        public readonly string $type,
        public readonly string $text,
    ) {}

    /**
     * @param  array{type: string, text: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['text'],
        );
    }

    /**
     * @return array{type: string, text: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'text' => $this->text,
        ];

        return $result;
    }
}
