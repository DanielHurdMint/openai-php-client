<?php

declare(strict_types=1);

namespace OpenAI\Responses\Responses;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @implements ResponseContract<array{type: 'response.created'|'response.inprogress'|'response.completed'|'response.failed'|'response.incomplete', array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}}|array{type: 'response.output_item.added'|'response.output_item.done', array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}}|array{type: 'response.content_part.added'|'response.content_part.done', array{type: string, item_id: string, output_index: int, content_index: int, part: array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}}}|array{type: 'response.output_text.delta', array{type: string, item_id: string, output_index: int, content_index: int, delta: string}}|array{type: 'response.output_text.annotation.added', array{type: string, item_id: string, output_index: int, content_index: int, annotation_index: int, annotation: array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}}}|array{type: 'response.output_text.done', array{type: string, item_id: string, output_index: int, content_index: int, text: string}}|array{type: 'response.refusal.delta', array{type: string, item_id: string, output_index: int, content_index: int, delta: string}}|array{type: 'response.refusal.done', array{type: string, item_id: string, output_index: int, content_index: int, refusal: string}}|array{type: 'response.function_call_arguments.delta', array{type: string, item_id: string, output_index: int, delta: string}}|array{type: 'response.function_call_arguments.done', array{type: string, item_id: string, output_index: int, arguments: string}}|array{type: 'response.file_search_call.in_progress'|'response.file_search_call.searching'|'response.file_search_call.completed', array{type: string, item_id: string, output_index: int}}|array{type: 'response.web_search_call.in_progress'|'response.web_search_call.searching'|'response.web_search_call.completed', array{type: string, item_id: string, output_index: int}}|array{type: 'error', code: ?string, ?message: ?string, param: ?string}>
 */
final class CreateStreamedResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: 'response.created'|'response.inprogress'|'response.completed'|'response.failed'|'response.incomplete', array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}}|array{type: 'response.output_item.added'|'response.output_item.done', array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}}|array{type: 'response.content_part.added'|'response.content_part.done', array{type: string, item_id: string, output_index: int, content_index: int, part: array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}}}|array{type: 'response.output_text.delta', array{type: string, item_id: string, output_index: int, content_index: int, delta: string}}|array{type: 'response.output_text.annotation.added', array{type: string, item_id: string, output_index: int, content_index: int, annotation_index: int, annotation: array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}}}|array{type: 'response.output_text.done', array{type: string, item_id: string, output_index: int, content_index: int, text: string}}|array{type: 'response.refusal.delta', array{type: string, item_id: string, output_index: int, content_index: int, delta: string}}|array{type: 'response.refusal.done', array{type: string, item_id: string, output_index: int, content_index: int, refusal: string}}|array{type: 'response.function_call_arguments.delta', array{type: string, item_id: string, output_index: int, delta: string}}|array{type: 'response.function_call_arguments.done', array{type: string, item_id: string, output_index: int, arguments: string}}|array{type: 'response.file_search_call.in_progress'|'response.file_search_call.searching'|'response.file_search_call.completed', array{type: string, item_id: string, output_index: int}}|array{type: 'response.web_search_call.in_progress'|'response.web_search_call.searching'|'response.web_search_call.completed', array{type: string, item_id: string, output_index: int}}|array{type: 'error', code: ?string, ?message: ?string, param: ?string}>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    private function __construct(
        public readonly string $type,
        public readonly CreateStreamedResponseMainEvent|null $response,
        public readonly ?string $code,
        public readonly ?string $message,
        public readonly ?string $param,
        public readonly ?int $outputIndex,
        public readonly ?int $contentIndex,
        public readonly ?string $itemId,
        public readonly ?int $annotationIndex,
        public readonly CreateResponseOutputMessage|CreateResponseOutputFileSearchTool|CreateResponseOutputFunctionTool|CreateResponseOutputWebSearchTool|CreateResponseOutputComputerTool|CreateResponseOutputReasoning|null $item,
        public readonly CreateResponseOutputMessageContentText|CreateResponseOutputMessageContentRefusal|null $part,
        public readonly ?string $delta,
        public readonly CreateResponseOutputMessageContentTextAnnotationFileCitation|CreateResponseOutputMessageContentTextAnnotationURLCitation|CreateResponseOutputMessageContentTextAnnotationFilePath|null $annotation,
        public readonly ?string $text,
        public readonly ?string $refusal,
        public readonly ?string $arguments,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: 'response.created'|'response.inprogress'|'response.completed'|'response.failed'|'response.incomplete', array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}}|
     * array{type: 'response.output_item.added'|'response.output_item.done', 'item': array{id: string,object: string,created_at: int,status: string,error: ?array{code: string, message: string},incomplete_details: ?array{reason: string},instructions: ?string,max_output_tokens: ?int,model: string,output: array<int, array{type: string, id: string, role: string, status: string, content: array<int, array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}>}|array{type: string, id: string, queries: list<string>, status: string, results: ?array<int, array{attributes: array<int|string, mixed>, file_id: string, filename: string, score: float, text: string}>}|array{type: string, id: string, call_id: string, name: string, arguments: string, status: string}|array{type: string, id: string, status: string}|array{type: string, id: string, call_id: string, status: string, action: array<int|string, mixed>, pending_safety_checks: array<int, mixed>}|array{type: string, id: string, status: string, summary: ?array<int, array{type: string, text: string}>}>,parallel_tool_calls: bool,previous_response_id: ?string,reasoning: ?array{effort: string|null, generate_summary: string|null},store: ?bool,temperature: ?float,text: array{format: array{type: 'json_object'|'text'}|array{type: 'json_schema', name: string, description: string, schema: array<string, mixed>, strict: bool|null}},tool_choice: string|array{type: string}|array{name: string, type: string},tools: array<int, array{type: string, vector_store_ids: array<int, mixed>, filters: array{type: 'and'|'or', filters: array<int, mixed>}|array{type: 'eq'|'gt'|'gte'|'lt'|'lte'|'neq', key: string, value: bool|float|string}, max_num_results: int, ranking_options: array{ranker: string, score_threshold: float}}|array{type: string, name: string, description: string|null, parameters: array<string, mixed>, strict: bool}|array{type: string, display_height: int, display_width: int, environment: string}|array{type: string, search_context_size: string, user_location: ?array{type: string, city: string, country: string, region: string, timezone: string}}>,top_p: float,truncation: ?string,usage: array{input_tokens: int, output_tokens: int, input_tokens_details?:array{cached_tokens:int}, output_tokens_details?:array{reasoning_tokens:int}},user: ?string}}|array{type: 'response.content_part.added'|'response.content_part.done', array{type: string, item_id: string, output_index: int, content_index: int, part: array{type: string, annotations: array<int, array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}>, text: string}|array{type: string, refusal: string}}}|array{type: 'response.output_text.delta', array{type: string, item_id: string, output_index: int, content_index: int, delta: string}}|array{type: 'response.output_text.annotation.added', array{type: string, item_id: string, output_index: int, content_index: int, annotation_index: int, annotation: array{type: string, file_id: string, index: int}|array{type: string, title: string, url: string, start_index: int, end_index: int}}}|array{type: 'response.output_text.done', array{type: string, item_id: string, output_index: int, content_index: int, text: string}}|array{type: 'response.refusal.delta', array{type: string, item_id: string, output_index: int, content_index: int, delta: string}}|array{type: 'response.refusal.done', array{type: string, item_id: string, output_index: int, content_index: int, refusal: string}}|array{type: 'response.function_call_arguments.delta', array{type: string, item_id: string, output_index: int, delta: string}}|array{type: 'response.function_call_arguments.done', array{type: string, item_id: string, output_index: int, arguments: string}}|array{type: 'response.file_search_call.in_progress'|'response.file_search_call.searching'|'response.file_search_call.completed', array{type: string, item_id: string, output_index: int}}|array{type: 'response.web_search_call.in_progress'|'response.web_search_call.searching'|'response.web_search_call.completed', array{type: string, item_id: string, output_index: int}}|array{type: 'error', code: ?string, ?message: ?string, param: ?string}   $attributes
     */
    public static function from(array $attributes): self
    {
        $data = null;
        $item = null;
        $outputIndex = null;
        $contentIndex = null;
        $itemId = null;
        $annotationIndex = null;
        $part = null;
        $delta = null;
        $annotation = null;
        $text = null;
        $refusal = null;
        $arguments = null;
        switch ($attributes['type']) {
            case 'response.created':
            case 'response.in_progress':
            case 'response.completed':
            case 'response.failed':
            case 'response.incomplete':
                $data = CreateStreamedResponseMainEvent::from($attributes['response']);
                break;
            case 'response.output_item.added':
            case 'response.output_item.done':
                $item = null;
                switch ($attributes['item']['type']) {
                    case 'message':
                        $item = CreateResponseOutputMessage::from(['type' => 'message', 'id' => $attributes['item']['id'], 'role' => $attributes['item']['role'] ?? '', 'status' => $attributes['item']['status'], 'content' => $attributes['item']['content'] ?? []]);
                        break;
                    case 'file_search_call':
                        $item = CreateResponseOutputFileSearchTool::from(['type' => 'file_search_call', 'id' => $attributes['item']['id'], 'queries' => $attributes['item']['queries'] ?? [], 'status' => $attributes['item']['status'], 'results' => $attributes['item']['results'] ?? []]);
                        break;
                    case 'function_call':
                        $item = CreateResponseOutputFunctionTool::from(['type' => 'function_call', 'id' => $attributes['item']['id'], 'call_id' => $attributes['item']['call_id'] ?? '', 'name' => $attributes['item']['name'] ?? '', 'arguments' => $attributes['item']['arguments'] ?? '', 'status' => $attributes['item']['status']]);
                        break;
                    case 'web_search_call':
                        $item = CreateResponseOutputWebSearchTool::from(['type' => 'web_search_call', 'id' => $attributes['item']['id'], 'queries' => $attributes['item']['queries'] ?? [], 'status' => $attributes['item']['status'], 'results' => $attributes['item']['results'] ?? []]);
                        break;
                    case 'computer_call':
                        $item = CreateResponseOutputComputerTool::from(['type' => 'computer_call', 'id' => $attributes['item']['id'], 'call_id' => $attributes['item']['call_id'] ?? '', 'action' => $attributes['item']['action'] ?? [], 'pending_safety_checks' => $attributes['item']['pending_safety_checks'] ?? [], 'status' => $attributes['item']['status']]);
                        break;
                    case 'reasoning':
                        $item = CreateResponseOutputReasoning::from(['type' => 'reasoning', 'id' => $attributes['item']['id'], 'status' => $attributes['item']['status'], 'summary' => $attributes['item']['summary'] ?? []]);
                        break;
                    default:
                        throw new \Exception('Invalid item type');
                }
                $outputIndex = $attributes['output_index'];
                break;
            case 'response.content_part.added':
            case 'response.content_part.done':
                $contentIndex = $attributes['content_index'];
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $part = null;
                switch ($attributes['part']['type']) {
                    case 'output_text':
                        $part = CreateResponseOutputMessageContentText::from(['type' => $attributes['part']['type'], 'annotations' => $attributes['part']['annotations'] ?? [], 'text' => $attributes['part']['text'] ?? '']);
                        break;
                    case 'refusal':
                        $part = CreateResponseOutputMessageContentRefusal::from(['type' => $attributes['part']['type'], 'refusal' => $attributes['part']['refusal'] ?? '']);
                        break;
                    default:
                        throw new \Exception('Invalid part type');
                }
                break;
            case 'response.output_text.delta':
                $contentIndex = $attributes['content_index'];
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $delta = $attributes['delta'];
                break;
            case 'response.output_text.annotation.added':
                $contentIndex = $attributes['content_index'];
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $annotationIndex = $attributes['annotation_index'];
                switch ($attributes['annotation']['type']) {
                    case 'file_citation':
                        $annotation = CreateResponseOutputMessageContentTextAnnotationFileCitation::from(['type' => $attributes['annotation']['type'], 'file_id' => $attributes['annotation']['file_id'] ?? '', 'index' => $attributes['annotation']['index'] ?? 0]);
                        break;
                    case 'file_path':
                        $annotation = CreateResponseOutputMessageContentTextAnnotationFilePath::from(['type' => $attributes['annotation']['type'], 'file_id' => $attributes['annotation']['file_id'] ?? '', 'index' => $attributes['annotation']['index'] ?? 0]);
                        break;
                    case 'url_citation':
                        $annotation = CreateResponseOutputMessageContentTextAnnotationUrlCitation::from(['type' => $attributes['annotation']['type'], 'url' => $attributes['annotation']['url'] ?? '', 'title' => $attributes['annotation']['title'] ?? '', 'start_index' => $attributes['annotation']['start_index'] ?? 0, 'end_index' => $attributes['annotation']['end_index'] ?? 0]);
                        break;
                    default:
                        throw new \Exception('Invalid part type');
                }
                break;
            case 'response.output_text.done':
                $contentIndex = $attributes['content_index'];
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $text = $attributes['text'];
                break;
            case 'response.refusal.delta':
                $contentIndex = $attributes['content_index'];
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $delta = $attributes['delta'];
                break;
            case 'response.refusal.done':
                $contentIndex = $attributes['content_index'];
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $refusal = $attributes['refusal'];
                break;
            case 'response.function_call_arguments.delta':
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $delta = $attributes['delta'];
                break;
            case 'response.function_call_arguments.done':
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                $arguments = $attributes['arguments'];
                break;
            case 'response.file_search_call.in_progress':
            case 'response.file_search_call.searching':
            case 'response.file_search_call.completed':
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                break;
            case 'response.web_search_call.in_progress':
            case 'response.web_search_call.searching':
            case 'response.web_search_call.completed':
                $outputIndex = $attributes['output_index'];
                $itemId = $attributes['item_id'];
                break;
            case 'error':
                break;
            default:
                throw new \Exception('Invalid type: ' . $attributes['type'] . " JSON Dump: " . json_encode($attributes, JSON_PRETTY_PRINT));
        }

        return new self(
            $attributes['type'],
            $data,
            $attributes['code'] ?? null,
            $attributes['message'] ?? null,
            $attributes['param'] ?? null,
            $outputIndex,
            $contentIndex,
            $itemId,
            $annotationIndex,
            $item,
            $part,
            $delta,
            $annotation,
            $text,
            $refusal,
            $arguments,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        // the only field we know will exist for sure is the type
        $result = [
            'type' => $this->type,
            'response' => is_null($this->response) ? null : $this->response->toArray(),
            'code' => is_null($this->code) ? null : $this->code,
            'message' => is_null($this->message) ? null : $this->message,
            'param' => is_null($this->param) ? null : $this->param,
            'output_index' => is_null($this->outputIndex) ? null : $this->outputIndex,
            'content_index' => is_null($this->contentIndex) ? null : $this->contentIndex,
            'item_id' => is_null($this->itemId) ? null : $this->itemId,
            'annotation_index' => is_null($this->annotationIndex) ? null : $this->annotationIndex,
            'item' => is_null($this->item) ? null : $this->item->toArray(),
            'part' => is_null($this->part) ? null : $this->part->toArray(),
            'delta' => is_null($this->delta) ? null : $this->delta,
            'annotation' => is_null($this->annotation) ? null : $this->annotation->toArray(),
            'text' => is_null($this->text) ? null : $this->text,
            'refusal' => is_null($this->refusal) ? null : $this->refusal,
            'arguments' => is_null($this->arguments) ? null : $this->arguments,
        ];

        return array_filter($result, fn(mixed $value): bool => ! is_null($value));
    }
}
