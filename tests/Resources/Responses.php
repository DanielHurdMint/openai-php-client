<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateResponseUsage;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Responses\Responses\CreateStreamedResponseChoice;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Responses\Responses\CreateResponseOutputMessage;
use OpenAI\Responses\Responses\CreateResponseOutputMessageContentText;
use OpenAI\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'responses', [
        'model' => 'gpt-4o-2024-08-06',
        'input' => ['role' => 'user', 'content' => 'Hello!'],
    ], \OpenAI\ValueObjects\Transporter\Response::from(responses(), metaHeaders()));

    $result = $client->responses()->create([
        'model' => 'gpt-4o-2024-08-06',
        'input' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('resp_67ccd3a9da748190baa7f1570fe91ac604becb25c45c1d41')
        ->object->toBe('response')
        ->createdAt->toBe(1741476777)
        ->model->toBe('gpt-4o-2024-08-06')
        ->output->toBeArray()->toHaveCount(1)
        ->output->each->toBeInstanceOf(CreateResponseOutputMessage::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->output[0])
        ->role->toBe('assistant')
        ->content->toBeArray()->toHaveCount(1)
        ->content->each->toBeInstanceOf(CreateResponseOutputMessageContentText::class);

    expect($result->output[0]->content[0])
        ->type->toBe('output_text')
        ->text->toBe("The image depicts a scenic landscape with a wooden boardwalk or pathway leading through lush, green grass under a blue sky with some clouds. The setting suggests a peaceful natural area, possibly a park or nature reserve. There are trees and shrubs in the background.");

    expect($result->usage)
        ->inputTokens->toBe(328)
        ->outputTokens->toBe(52);
        // ->totalTokens->toBe(380);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create throws an exception if stream option is true', function () {
    OpenAI::client('foo')->responses()->create([
        'model' => 'gpt-4o',
        'input' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ]);
})->throws(OpenAI\Exceptions\InvalidArgumentException::class, 'Stream option is not supported. Please use the createStreamed() method instead.');

test('create streamed', function () {
    $response = new Response(
        body: new Stream(responsesStream()),
        headers: metaHeaders(),
    );

    $client = mockStreamClient('POST', 'responses', [
        'model' => 'gpt-4o',
        'input' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $result = $client->responses()->createStreamed([
        'model' => 'gpt-4o',
        'input' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    expect($result->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('chatcmpl-6wdIE4DsUtqf1srdMTsfkJp0VWZgz')
        ->object->toBe('chat.completion.chunk')
        ->created->toBe(1679432086)
        ->model->toBe('gpt-4-0314')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateStreamedResponseChoice::class)
        ->usage->toBeNull();

    expect($result->getIterator()->current()->choices[0])
        ->delta->role->toBeNull()
        ->delta->content->toBe('Hello')
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('handles error messages in stream', function () {
    $response = new Response(
        body: new Stream(chatCompletionStreamError())
    );

    $client = mockStreamClient('POST', 'chat/completions', [
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
        'stream' => true,
    ], $response);

    $result = $client->chat()->createStreamed([
        'model' => 'gpt-3.5-turbo',
        'messages' => ['role' => 'user', 'content' => 'Hello!'],
    ]);

    expect(fn () => $result->getIterator()->current())
        ->toThrow(function (OpenAI\Exceptions\ErrorException $e) {
            expect($e->getMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorMessage())->toBe('The server had an error while processing your request. Sorry about that!')
                ->and($e->getErrorCode())->toBeNull()
                ->and($e->getErrorType())->toBe('server_error');
        });
});
