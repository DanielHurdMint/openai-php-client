<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseOutputMessageContentText
{
    /**
     * @param  array<int, CreateResponseOutputMessageContentTextAnnotationFileCitation|CreateResponseOutputMessageContentTextAnnotationURLCitation|CreateResponseOutputMessageContentTextAnnotationFilePath>  $annotations
     */
    private function __construct(
        public readonly string $type,
        public readonly array $annotations,
        public readonly string $text,
    ) {}

    /**
     * @param  array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}  $attributes
     */
    public static function from(array $attributes): self
    {

        $annotations = array_map(function (array $result) {
            switch ($result['type']) {
                case 'file_citation':
                    return CreateResponseOutputMessageContentTextAnnotationFileCitation::from(['type' => $result['type'], 'file_id' => $result['file_id'] ?? '', 'index' => $result['index'] ?? 0]);
                case 'url_citation':
                    return CreateResponseOutputMessageContentTextAnnotationURLCitation::from(['type' => $result['type'], 'title' => $result['title'] ?? '', 'url' => $result['url'] ?? '', 'start_index' => $result['start_index'] ?? 0, 'end_index' => $result['end_index'] ?? 0]);
                case 'file_path':
                    return CreateResponseOutputMessageContentTextAnnotationFilePath::from(['type' => $result['type'], 'file_id' => $result['file_id'] ?? '', 'index' => $result['index'] ?? 0]);
                default:
                    throw new \Exception('Invalid annotation type');
            }
        }, $attributes['annotations']);

        return new self(
            $attributes['type'],
            $annotations,
            $attributes['text'],
        );
    }

    /**
     * @return array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}
     */
    public function toArray(): array
    {
        $annotations = array_map(fn (CreateResponseOutputMessageContentTextAnnotationFileCitation|CreateResponseOutputMessageContentTextAnnotationURLCitation|CreateResponseOutputMessageContentTextAnnotationFilePath $annotation): array => $annotation->toArray(), $this->annotations);

        $result = [
            'type' => $this->type,
            'annotations' => $annotations,
            'text' => $this->text,
        ];

        return $result;
    }
}
