<?php

declare(strict_types=1);

namespace OpenAI\Resources;

use OpenAI\Contracts\Resources\ResponsesContract;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\StreamResponse;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\Response;

final class Responses implements ResponsesContract
{
    use Concerns\Streamable;
    use Concerns\Transportable;

    /**
     * Creates a completion for the chat message
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse
    {
        $this->ensureNotStreamed($parameters);

        $payload = Payload::create('responses', $parameters);

        /** @var Response<array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }

    /**
     * Creates a streamed completion for the chat message
     *
     * @see https://platform.openai.com/docs/api-reference/responses/create
     *
     * @param  array<string, mixed>  $parameters
     * @return StreamResponse<CreateStreamedResponse>
     */
    public function createStreamed(array $parameters): StreamResponse
    {
        $parameters = $this->setStreamParameter($parameters);

        $payload = Payload::create('responses', $parameters);

        $response = $this->transporter->requestStream($payload);

        return new StreamResponse(CreateStreamedResponse::class, $response);
    }

    /**
     * Retrieves a response by ID
     *
     * @see https://platform.openai.com/docs/api-reference/responses/get
     *
     * @param  array<string, mixed>  $parameters
     */
    public function get(string $id, array $parameters = []): CreateResponse
    {
        $payload = Payload::create('responses/' . $id, $parameters);

        /** @var Response<array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}> $response */
        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }
}
