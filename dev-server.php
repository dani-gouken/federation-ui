<?php
$allowed_origins = "*";
function _log($level, $msg)
{
    $debug = false;
    if($debug) {
        file_put_contents("php://stdout", "[" . $level . "] " . $msg . "\n");
    }
}

function cors_headers($origin)
{
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Accept');
}

if (preg_match('/\.(?:png|jpg|jpeg|gif|csv)$/', $_SERVER["REQUEST_URI"])) {
    _log('info', "Transparent routing for : " . $_SERVER["REQUEST_URI"]);
    return false;
}

if (!preg_match('/^.*$/i', $_SERVER["REQUEST_URI"])) {
    return false;
}

$root = rtrim($_SERVER['DOCUMENT_ROOT'], "/");
$requested = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), "/");
$file_path = "$root/$requested";

cors_headers($allowed_origins);

if (!file_exists($file_path) || is_dir($file_path)) {
    _log('info', "file not found: " . $_SERVER["REQUEST_URI"]);
    http_response_code(404);
    return true;
}

$mime = mime_content_type($file_path);
$custom_mappings = [
    'js' => 'text/javascript',
    'css' => 'text/css',
];

$ext = pathinfo($file_path, PATHINFO_EXTENSION);
if (array_key_exists($ext, $custom_mappings)) {
    $mime = $custom_mappings[$ext];
}

_log('info', "CORS added to file {$mime} : {$file_path}");
header("Content-type: {$mime}");
echo file_get_contents($file_path);

return true;