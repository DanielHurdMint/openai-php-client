<?php

namespace OpenAI\Contracts\Resources;

use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\DeleteResponse;
use OpenAI\Responses\Responses\GetResponse;
use OpenAI\Responses\Responses\ListInputItemsResponse;
use OpenAI\Responses\StreamResponse;

interface ResponsesContract
{
    /**
     * Creates a call to the responses API
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;

    /**
     * Creates a call to the responses API with streaming
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse;

    // /**
    //  * Get a response.
    //  *
    //  * @see https://platform.openai.com/docs/api-reference/responses/get
    //  */
    // public function get(string $id): GetResponse;

    // /**
    //  * Delete a response.
    //  *
    //  * @see https://platform.openai.com/docs/api-reference/responses/delete
    //  */
    // public function delete(string $id): DeleteResponse;

    // /**
    //  * Returns a list of responses input items.
    //  *
    //  * @see https://platform.openai.com/docs/api-reference/responses/input-items
    //  *
    //  * @param  array<string, mixed>  $parameters
    //  */
    // public function listInputItems(array $parameters = []): ListInputItemsResponse;
}
