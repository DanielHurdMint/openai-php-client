<?php

use OpenAI\Resources\Responses;
use OpenAI\Responses\Responses\CreateResponse;
use OpenAI\Responses\Responses\CreateStreamedResponse;
use OpenAI\Testing\ClientFake;

it('records a responses create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->responses()->create([
        'model' => 'gpt-4o',
        'input' => 'Tell me a three sentence bedtime story about a unicorn.'
    ]);

    $fake->assertSent(Responses::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'gpt-4o' &&
            $parameters['input'] === 'Tell me a three sentence bedtime story about a unicorn.';
    });
});

// it('records a streamed create create request', function () {
//     $fake = new ClientFake([
//         CreateStreamedResponse::fake(),
//     ]);

//     $fake->chat()->createStreamed([
//         'model' => 'gpt-3.5-turbo',
//         'messages' => [
//             ['role' => 'user', 'content' => 'Hello!'],
//         ],
//     ]);

//     $fake->assertSent(Chat::class, function ($method, $parameters) {
//         return $method === 'createStreamed' &&
//             $parameters['model'] === 'gpt-3.5-turbo' &&
//             $parameters['messages'][0]['role'] === 'user' &&
//             $parameters['messages'][0]['content'] === 'Hello!';
//     });
// });
