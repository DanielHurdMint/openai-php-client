<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

final class CreateStreamedResponseMainEvent
{
    /**
     * @param  array<int, CreateResponseOutputMessage|CreateResponseOutputFileSearchTool|CreateResponseOutputFunctionTool|CreateResponseOutputWebSearchTool|CreateResponseOutputComputerTool|CreateResponseOutputReasoning>  $output
     * @param  array<int, CreateResponseToolsFileSearch|CreateResponseToolsFunction|CreateResponseToolsComputerUse|CreateResponseToolsWebSearch>  $tools
     */
    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $createdAt,
        public readonly string $status,
        public readonly ?CreateResponseError $error,
        public readonly ?CreateResponseIncompleteDetails $incompleteDetails,
        public readonly ?string $instructions,
        public readonly ?int $maxOutputTokens,
        public readonly string $model,
        public readonly array $output,
        public readonly bool $parallelToolCalls,
        public readonly ?string $previousResponseId,
        public readonly ?CreateResponseReasoning $reasoning,
        public readonly ?bool $store,
        public readonly ?float $temperature,
        public readonly CreateResponseTextFormat $text,
        public readonly string|CreateResponseToolChoiceHosted|CreateResponseToolChoiceFunction $toolChoice,
        public readonly array $tools,
        public readonly float $topP,
        public readonly ?string $truncation,
        public readonly ?CreateResponseUsage $usage,
        public readonly ?string $user,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        $output = array_map(function (array $output): CreateResponseOutputMessage|CreateResponseOutputFileSearchTool|CreateResponseOutputFunctionTool|CreateResponseOutputWebSearchTool|CreateResponseOutputComputerTool|CreateResponseOutputReasoning {
            switch ($output['type']) {
                case 'message':
                    return CreateResponseOutputMessage::from(['type' => 'message', 'id' => $output['id'], 'role' => $output['role'] ?? '', 'status' => $output['status'], 'content' => $output['content'] ?? []]);
                case 'file_search_call':
                    return CreateResponseOutputFileSearchTool::from(['type' => 'file_search_call', 'id' => $output['id'], 'queries' => $output['queries'] ?? [], 'status' => $output['status'], 'results' => $output['results'] ?? []]);
                case 'function_call':
                    return CreateResponseOutputFunctionTool::from(['type' => 'function_call', 'id' => $output['id'], 'call_id' => $output['call_id'] ?? '', 'name' => $output['name'] ?? '', 'arguments' => $output['arguments'] ?? '', 'status' => $output['status']]);
                case 'web_search_call':
                    return CreateResponseOutputWebSearchTool::from(['type' => 'web_search_call', 'id' => $output['id'], 'queries' => $output['queries'] ?? [], 'status' => $output['status'], 'results' => $output['results'] ?? []]);
                case 'computer_call':
                    return CreateResponseOutputComputerTool::from(['type' => 'computer_call', 'id' => $output['id'], 'call_id' => $output['call_id'] ?? '', 'action' => $output['action'] ?? [], 'pending_safety_checks' => $output['pending_safety_checks'] ?? [], 'status' => $output['status']]);
                case 'reasoning':
                    return CreateResponseOutputReasoning::from(['type' => 'reasoning', 'id' => $output['id'], 'status' => $output['status'], 'summary' => $output['summary'] ?? []]);
                default:
                    throw new \Exception('Invalid output type: ' . $output['type'] . " JSON Dump: " . json_encode($output, JSON_PRETTY_PRINT));
            }
        }, $attributes['output']);

        $toolChoice = $attributes['tool_choice'];
        if (is_array($toolChoice)) {
            if ($toolChoice['type'] === 'function') {
                $toolChoice = CreateResponseToolChoiceFunction::from(['type' => 'function', 'name' => $toolChoice['name'] ?? '']);
            } else {
                $toolChoice = CreateResponseToolChoiceHosted::from(['type' => $toolChoice['type']]);
            }
        }

        $text = CreateResponseTextFormat::from($attributes['text']);

        $tools = array_map(function (array $tool): CreateResponseToolsFileSearch|CreateResponseToolsFunction|CreateResponseToolsComputerUse|CreateResponseToolsWebSearch {
            switch ($tool['type']) {
                case 'file_search':
                    return CreateResponseToolsFileSearch::from(['type' => 'file_search', 'vector_store_ids' => $tool['vector_store_ids'] ?? [], 'filters' => $tool['filters'] ?? ['type' => 'and', 'filters' => []], 'max_num_results' => $tool['max_num_results'] ?? 0, 'ranking_options' => $tool['ranking_options'] ?? ['ranker' => 'relevance', 'score_threshold' => 0.0]]);
                case 'function':
                    return CreateResponseToolsFunction::from(['type' => 'function', 'name' => $tool['name'] ?? '', 'description' => $tool['description'] ?? '', 'parameters' => $tool['parameters'] ?? [], 'strict' => $tool['strict'] ?? false]);
                case 'computer_use_preview':
                    return CreateResponseToolsComputerUse::from(['type' => 'computer_use_preview', 'display_height' => $tool['display_height'] ?? 0, 'display_width' => $tool['display_width'] ?? 0, 'environment' => $tool['environment'] ?? '']);
                case 'web_search_preview_2025_03_11':
                case 'web_search_preview':
                    return CreateResponseToolsWebSearch::from(['type' => $tool['type'], 'name' => $tool['name'] ?? '', 'search_context_size' => $tool['search_context_size'] ?? '', 'user_location' => $tool['user_location'] ?? null]);
                default:
                    throw new \Exception('Invalid type: ' . $tool['type'] . " JSON Dump: " . json_encode($tool, JSON_PRETTY_PRINT));
            }
        }, $attributes['tools']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['status'],
            isset($attributes['error']) ? CreateResponseError::from($attributes['error']) : null,
            isset($attributes['incomplete_details']) ? CreateResponseIncompleteDetails::from($attributes['incomplete_details']) : null,
            $attributes['instructions'] ?? null,
            $attributes['max_output_tokens'] ?? null,
            $attributes['model'],
            $output,
            $attributes['parallel_tool_calls'],
            $attributes['previous_response_id'] ?? null,
            isset($attributes['reasoning']) ? CreateResponseReasoning::from($attributes['reasoning']) : null,
            $attributes['store'] ?? null,
            $attributes['temperature'] ?? null,
            $text,
            $toolChoice,
            $tools,
            $attributes['top_p'],
            $attributes['truncation'] ?? null,
            isset($attributes['usage']) ? CreateResponseUsage::from($attributes['usage']) : null,
            $attributes['user'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        $output = array_map(function (CreateResponseOutputMessage|CreateResponseOutputFileSearchTool|CreateResponseOutputFunctionTool|CreateResponseOutputWebSearchTool|CreateResponseOutputComputerTool|CreateResponseOutputReasoning $output): array {
            return $output->toArray();
        }, $this->output);

        $result = [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'status' => $this->status,
            'instructions' => $this->instructions ?? '',
            'max_output_tokens' => $this->maxOutputTokens ?? null,
            'model' => $this->model,
            'output' => $output,
            'parallel_tool_calls' => $this->parallelToolCalls,
            'previous_response_id' => $this->previousResponseId ?? null,
            'reasoning' => is_null($this->reasoning) ? null : $this->reasoning->toArray(),
            'store' => $this->store ?? null,
            'temperature' => $this->temperature ?? null,
            'top_p' => $this->topP,
            'truncation' => $this->truncation ?? null,
            'text' => $this->text->toArray(),
            'tool_choice' => is_string($this->toolChoice) ? $this->toolChoice : $this->toolChoice->toArray(),
            'tools' => array_map(function (CreateResponseToolsFileSearch|CreateResponseToolsFunction|CreateResponseToolsComputerUse|CreateResponseToolsWebSearch $tool): array {
                return $tool->toArray();
            }, $this->tools),
            'usage' => is_null($this->usage) ? null : $this->usage->toArray(),
            'user' => $this->user ?? null,
        ];

        if (!is_null($this->error)) {
            $result['error'] = $this->error->toArray();
        }

        if (!is_null($this->incompleteDetails)) {
            $result['incomplete_details'] = $this->incompleteDetails->toArray();
        }

        return array_filter($result, fn (mixed $value): bool => ! is_null($value));
    }
}
