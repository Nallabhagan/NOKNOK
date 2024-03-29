<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'yGPMa8oZc7PEJXxEnOIAhZscjujizzCPt028vCSG',
            'length' => 6,
        ],

        'create_question' => [
            'salt' => 'CreateQuestionNokNokqwertyuiopasdfghjklzxcvbnmQETUOADGJLZCBM',
            'length' => 30,
        ],
        'answer_slug' => [
            'salt' => 'AnswerSlugUserIdNokNokqwertyuiopasdfghjklzxcvbnmQETUOADGJLZCBM',
            'length' => 2,
        ],
        'full_interview' => [
            'salt' => 'FullInterviewNokNokqwertyuiopasdfghjklzxcvbnmQETUOADGJLZCBM',
            'length' => 30,
        ],
        'user' => [
            'salt' => 'NokNokUsersqwertyuiopasdfghjklzxcvbnmQETUOADGJLZCBM',
            'length' => 5
        ],
        'qparty' => [
            'salt' => 'QPartyqwertyuiopasdfghjklzxcvbnmQETUOADGJLZCBMMediaHouse',
            'length' => 30,
        ],
        'qparty_slug' => [
            'salt' => 'QPartyqwertyuiopasdfghjklzxcvbnmQETUOADGJLZCBMMediaHouse',
            'length' => 2,
        ],
        'nokit' => [
            'salt' => 'NokItqwertyuiopasdfghjklzxcvbnmQETUOADGJLZCBMNokIt',
            'length' => 5,
        ]

    ],

];
