<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputFileSearchToolResult
{
    /**
     * @param  array<string|int, mixed>  $attributes
     */
    private function __construct(
        public readonly array $attributes,
        public readonly string $fileId,
        public readonly string $filename,
        public readonly float $score,
        public readonly string $text,
    ) {}

    /**
     * @param  array{attributes: array<string|int, mixed>, file_id: string, filename: string, score: float, text: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['attributes'],
            $attributes['file_id'],
            $attributes['filename'],
            $attributes['score'],
            $attributes['text'],
        );
    }

    /**
     * @return array{attributes: array<string|int, mixed>, file_id: string, filename: string, score: float, text: string}
     */
    public function toArray(): array
    {
        $result = [
            'attributes' => $this->attributes,
            'file_id' => $this->fileId,
            'filename' => $this->filename,
            'score' => $this->score,
            'text' => $this->text,
        ];

        return $result;
    }
}
