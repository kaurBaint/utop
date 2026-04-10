<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// file ka full path banate hain
$file = __DIR__ . $uri;

// agar file exist karti hai to usko run karo
if (file_exists($file) && !is_dir($file)) {
    require $file;
    return;
}

// nahi mile to default response
echo json_encode([
    "status" => "error",
    "message" => "Route not found"
]);