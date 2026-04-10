<?php

// 🔒 Error reporting (development ke liye ON, production me OFF kar dena)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$db   = "utop";

// ✅ Create connection
$conn = new mysqli($host, $user, $pass, $db);

// ❌ Check connection (API format me error)
if ($conn->connect_error) {
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed"
    ]);
    exit;
}

// ✅ Set charset (important for security)
$conn->set_charset("utf8mb4");

?>