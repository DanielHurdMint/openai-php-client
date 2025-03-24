<?php

namespace OpenAI\Testing\Resources;

use OpenAI\Contracts\Resources\ResponsesContract;
use OpenAI\Resources\Responses;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\ListResponse;
use OpenAI\Responses\Responses\RetrieveResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\Testing\Resources\Concerns\Testable;

final class ResponsesTestResource implements ResponsesContract
{
    use Testable;

    protected function resource(): string
    {
        return Responses::class;
    }

    public function create(array $parameters): CreateResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    // public function retrieve(string $id): RetrieveResponse
    // {
    //     return $this->record(__FUNCTION__, func_get_args());
    // }

    // public function list(array $parameters = []): ListResponse
    // {
    //     return $this->record(__FUNCTION__, func_get_args());
    // }
}
