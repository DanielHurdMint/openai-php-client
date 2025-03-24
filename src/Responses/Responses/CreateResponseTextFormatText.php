<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseTextFormatText
{
    /**
     * @param  'text'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  array{type: 'text'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
        );
    }

    /**
     * @return array{type: 'text'}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
        ];

        return $result;
    }
}
