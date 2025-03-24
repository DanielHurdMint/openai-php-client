<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputMessageContentTextAnnotationFileCitation
{
    private function __construct(
        public readonly string $type,
        public readonly string $fileId,
        public readonly int $index,
    ) {}

    /**
     * @param  array{type: string, file_id: string, index: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['file_id'],
            $attributes['index'],
        );
    }

    /**
     * @return array{type: string, file_id: string, index: int}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'file_id' => $this->fileId,
            'index' => $this->index,
        ];

        return $result;
    }
}
