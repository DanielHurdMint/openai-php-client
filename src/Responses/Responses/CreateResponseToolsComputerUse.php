<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

final class CreateResponseToolsComputerUse
{
    private function __construct(
        public readonly string $type,
        public readonly int $displayHeight,
        public readonly int $displayWidth,
        public readonly string $environment,
    ) {}

    /**
     * @param  array{type: string, display_height: int, display_width: int, environment: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['display_height'],
            $attributes['display_width'],
            $attributes['environment'],
        );
    }

    /**
     * @return array{type: string, display_height: int, display_width: int, environment: string}
     */
    public function toArray(): array
    {
        $result = [
            'type' => $this->type,
            'display_height' => $this->displayHeight,
            'display_width' => $this->displayWidth,
            'environment' => $this->environment,
        ];

        return $result;
    }
}
