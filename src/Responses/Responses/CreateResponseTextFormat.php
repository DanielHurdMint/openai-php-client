<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseTextFormat
{
    private function __construct(
        public readonly CreateResponseTextFormatText|CreateResponseTextFormatJsonSchema|CreateResponseTextFormatJsonObject $format,
    ) {}

    /**
     * @param  array{format: array{type: 'text'|'json_object'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}}  $attributes
     */
    public static function from(array $attributes): self
    {
        if ($attributes['format']['type'] === 'text') {
            $format = CreateResponseTextFormatText::from(['type' => 'text']);
        } elseif ($attributes['format']['type'] === 'json_schema') {
            $format = CreateResponseTextFormatJsonSchema::from(['type' => 'json_schema', 'name' => $attributes['format']['name'], 'description' => $attributes['format']['description'], 'schema' => $attributes['format']['schema'], 'strict' => $attributes['format']['strict']]);
        } elseif ($attributes['format']['type'] === 'json_object') {
            $format = CreateResponseTextFormatJsonObject::from(['type' => 'json_object']);
        }

        return new self(
            $format,
        );
    }

    /**
     * @return array{format: array{type: 'text'|'json_object'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}}
     */
    public function toArray(): array
    {
        $result = [
            'format' => $this->format->toArray(),
        ];

        return $result;
    }
}
