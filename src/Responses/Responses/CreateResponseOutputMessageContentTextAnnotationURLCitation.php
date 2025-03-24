<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputMessageContentTextAnnotationURLCitation
{
    private function __construct(
        public readonly string $type,
        public readonly string $title,
        public readonly string $url,
        public readonly int $startIndex,
        public readonly int $endIndex,
    ) {}

    /**
     * @param  array{type: string, title: string, url: string, start_index: int, end_index: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['title'],
            $attributes['url'],
            $attributes['start_index'],
            $attributes['end_index'],
        );
    }

    /**
     * @return array{type: string, title: string, url: string, start_index: int, end_index: int}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'title' => $this->title,
            'url' => $this->url,
            'start_index' => $this->startIndex,
            'end_index' => $this->endIndex,
        ];

        return $result;
    }
}
