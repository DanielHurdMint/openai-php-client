<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolsFileSearchRankingOptions
{
    private function __construct(
        public readonly string $ranker,
        public readonly float $scoreThreshold,
    ) {}

    /**
     * @param  array{ranker: string, score_threshold: float}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['ranker'],
            $attributes['score_threshold'],
        );
    }

    /**
     * @return array{ranker: string, score_threshold: float}
     */
    public function toArray(): array
    {
        $result = [
            'ranker' => $this->ranker,
            'score_threshold' => $this->scoreThreshold,
        ];

        return $result;
    }
}
