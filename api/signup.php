<?php
include "config.php";

header('Content-Type: application/json');

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => false,
        "message" => "Invalid request method"
    ]);
    exit;
}

// Default values
$name = '';
$password = '';
$phone = '';
$user_type = '';

// Content-Type detect
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
$rawInput = file_get_contents("php://input");

// If JSON data
if (stripos($contentType, 'application/json') !== false) {
    $data = json_decode($rawInput, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        echo json_encode([
            "status" => false,
            "message" => "Invalid JSON data"
        ]);
        exit;
    }

    $name      = isset($data['name']) ? trim($data['name']) : '';
    $password  = isset($data['password']) ? trim((string)$data['password']) : '';
    $phone     = isset($data['phone']) ? trim((string)$data['phone']) : '';
    $user_type = isset($data['userType']) ? trim($data['userType']) : '';
} else {
    // For x-www-form-urlencoded or form-data
    $name      = isset($_POST['name']) ? trim($_POST['name']) : '';
    $password  = isset($_POST['password']) ? trim((string)$_POST['password']) : '';
    $phone     = isset($_POST['phone']) ? trim((string)$_POST['phone']) : '';
    $user_type = isset($_POST['userType']) ? trim($_POST['userType']) : '';
}

// Required fields validation
if ($name === '' || $password === '' || $phone === '' || $user_type === '') {
    echo json_encode([
        "status" => false,
        "message" => "All fields are required"
    ]);
    exit;
}

// Name validation
if (strlen($name) < 2) {
    echo json_encode([
        "status" => false,
        "message" => "Name too short"
    ]);
    exit;
}

// Indian phone validation
if (!preg_match('/^[6-9][0-9]{9}$/', $phone)) {
    echo json_encode([
        "status" => false,
        "message" => "Enter valid Indian mobile number"
    ]);
    exit;
}

// Fake/test phone block
$invalidPhones = [
    '1234567890',
    '0987654321',
    '1111111111',
    '2222222222',
    '3333333333',
    '4444444444',
    '5555555555',
    '6666666666',
    '7777777777',
    '8888888888',
    '9999999999',
    '0000000000'
];

if (in_array($phone, $invalidPhones, true)) {
    echo json_encode([
        "status" => false,
        "message" => "Please enter a valid phone number"
    ]);
    exit;
}

// Password validation
if (strlen($password) < 6) {
    echo json_encode([
        "status" => false,
        "message" => "Password must be at least 6 characters"
    ]);
    exit;
}

// User type validation
if (!in_array($user_type, ['u', 'p'], true)) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid user type"
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

// Check existing phone
$check_stmt = $conn->prepare("SELECT id FROM users WHERE phone = ? LIMIT 1");

if (!$check_stmt) {
    echo json_encode([
        "status" => false,
        "message" => "Server error: check prepare failed - " . $conn->error
    ]);
    exit;
}

$check_stmt->bind_param("s", $phone);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result && $check_result->num_rows > 0) {
    $check_stmt->close();
    echo json_encode([
        "status" => false,
        "message" => "Phone number already exists"
    ]);
    $conn->close();
    exit;
}

$check_stmt->close();

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$insert_stmt = $conn->prepare("INSERT INTO users (name, password, phone, user_type) VALUES (?, ?, ?, ?)");

if (!$insert_stmt) {
    echo json_encode([
        "status" => false,
        "message" => "Server error: insert prepare failed - " . $conn->error
    ]);
    $conn->close();
    exit;
}

$insert_stmt->bind_param("ssss", $name, $hashed_password, $phone, $user_type);

if ($insert_stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "User Registered Successfully"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Something went wrong: " . $insert_stmt->error
    ]);
}

$insert_stmt->close();
$conn->close();
?>