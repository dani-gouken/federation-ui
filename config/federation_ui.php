<?php

return [
    "server" => [
        "host" => env("FEDERATION_SERVER_HOST", "localhost"),
        "port" => env("FEDERATION_SERVER_PORT", 8142)
    ],
    "cdn" => [
        "url" => env('FEDERATION_CDN_URL', "http://localhost:8142")
    ]
];