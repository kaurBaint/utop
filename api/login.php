<?php
session_start();
include "config.php";

header("Content-Type: application/json");

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => false,
        "message" => "Invalid request method"
    ]);
    exit;
}

// Default values
$phone = '';
$password = '';

// Detect request type
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
$rawInput = file_get_contents("php://input");

// If JSON request
if (stripos($contentType, 'application/json') !== false) {
    $data = json_decode($rawInput, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        echo json_encode([
            "status" => false,
            "message" => "Invalid JSON data"
        ]);
        exit;
    }

    $phone = isset($data['phone']) ? trim((string)$data['phone']) : '';
    $password = isset($data['password']) ? trim((string)$data['password']) : '';
} else {
    // For x-www-form-urlencoded or form-data
    $phone = isset($_POST['phone']) ? trim((string)$_POST['phone']) : '';
    $password = isset($_POST['password']) ? trim((string)$_POST['password']) : '';
}

// Validation
if ($phone === '' || $password === '') {
    echo json_encode([
        "status" => false,
        "message" => "Phone and Password required"
    ]);
    exit;
}

// Indian mobile validation
if (!preg_match('/^[6-9][0-9]{9}$/', $phone)) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid phone number"
    ]);
    exit;
}

// Check DB connection
if (!isset($conn) || !$conn) {
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed"
    ]);
    exit;
}

// Prepared statement
$stmt = $conn->prepare("SELECT id, name, phone, password, user_type FROM users WHERE phone = ? LIMIT 1");

if (!$stmt) {
    echo json_encode([
        "status" => false,
        "message" => "Server error: prepare failed - " . $conn->error
    ]);
    exit;
}

$stmt->bind_param("s", $phone);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Password verify
    if (password_verify($password, $user['password'])) {

        // Session set
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_type'] = $user['user_type'];

        echo json_encode([
            "status" => true,
            "message" => "Login Success",
            "data" => [
                "user_id" => (int)$user['id'],
                "name" => $user['name'],
                "phone" => $user['phone'],
                "user_type" => $user['user_type']
            ]
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Wrong Password"
        ]);
    }
} else {
    echo json_encode([
        "status" => false,
        "message" => "User not found"
    ]);
}

// Close
$stmt->close();
$conn->close();
?>