<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseTextFormatJsonObject
{
    /**
     * @param  'json_object'  $type
     */
    private function __construct(
        public readonly string $type,
    ) {}

    /**
     * @param  array{type: 'json_object'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
        );
    }

    /**
     * @return array{type: 'json_object'}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
        ];

        return $result;
    }
}
