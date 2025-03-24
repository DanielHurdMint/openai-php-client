<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolsWebSearchUserLocation
{
    private function __construct(
        public readonly string $type,
        public readonly string $city,
        public readonly string $country,
        public readonly string $region,
        public readonly string $timezone,
    ) {}

    /**
     * @param  array{type: string, city: string, country: string, region: string, timezone: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['city'],
            $attributes['country'],
            $attributes['region'],
            $attributes['timezone'],
        );
    }

    /**
     * @return array{type: string, city: string, country: string, region: string, timezone: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'city' => $this->city,
            'country' => $this->country,
            'region' => $this->region,
            'timezone' => $this->timezone,
        ];

        return $result;
    }
}
