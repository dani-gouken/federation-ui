<?php

return [
    "dashboard_route_name_prefix" => env('FEDERATION_ROUTE_NAME_PREFIX', "admin"),
    "server" => [
        "host" => env("FEDERATION_SERVER_HOST", "0.0.0.0"),
        "port" => env("FEDERATION_SERVER_PORT", 8142)
    ],
    "cdn" => [
        "url" => env('FEDERATION_CDN_URL', "http://0.0.0.0:8142")
    ]
];