<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolsWebSearch
{
    private function __construct(
        public readonly string $type,
        public readonly string $searchContextSize,
        public readonly ?CreateResponseToolsWebSearchUserLocation $userLocation,
    ) {}

    /**
     * @param  array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['search_context_size'],
            isset($attributes['user_location']) ? CreateResponseToolsWebSearchUserLocation::from($attributes['user_location']) : null,
        );
    }

    /**
     * @return array{type: string, search_context_size: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'search_context_size' => $this->searchContextSize,
        ];

        if ($this->userLocation) {
            $result['user_location'] = $this->userLocation->toArray();
        }

        return $result;
    }
}
