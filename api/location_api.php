<?php
header("Content-Type: application/json");

// Database connection
$conn = new mysqli("127.0.0.1", "root", "", "utop", 3306);

// Check connection
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit();
}

// Only GET allowed
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "success" => false,
        "message" => "Only GET method allowed"
    ]);
    exit();
}

// Get type
$type = isset($_GET['type']) ? trim($_GET['type']) : '';

if ($type === '') {
    echo json_encode([
        "success" => false,
        "message" => "type parameter is required"
    ]);
    exit();
}

// Countries
if ($type === 'countries') {

    $sql = "SELECT id, name FROM countries ORDER BY name ASC";
    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode([
            "success" => false,
            "message" => "Countries query failed: " . $conn->error
        ]);
        exit();
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "success" => true,
        "count" => count($data),
        "data" => $data
    ]);
}

// States
elseif ($type === 'states') {

    $country_id = isset($_GET['country_id']) ? (int)$_GET['country_id'] : 0;

    if ($country_id <= 0) {
        echo json_encode([
            "success" => false,
            "message" => "Valid country_id parameter is required"
        ]);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, country_id FROM states WHERE country_id = ? ORDER BY name ASC");

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Prepare failed: " . $conn->error
        ]);
        exit();
    }

    $stmt->bind_param("i", $country_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "success" => true,
        "count" => count($data),
        "data" => $data
    ]);

    $stmt->close();
}

// Cities
elseif ($type === 'cities') {

    $state_id = isset($_GET['state_id']) ? (int)$_GET['state_id'] : 0;

    if ($state_id <= 0) {
        echo json_encode([
            "success" => false,
            "message" => "Valid state_id parameter is required"
        ]);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, state_id FROM cities WHERE state_id = ? ORDER BY name ASC");

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Prepare failed: " . $conn->error
        ]);
        exit();
    }

    $stmt->bind_param("i", $state_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "success" => true,
        "count" => count($data),
        "data" => $data
    ]);

    $stmt->close();
}
// Cities
elseif ($type === 'area') {

    $city_id = isset($_GET['city_id']) ? (int)$_GET['city_id'] : 0;

    if ($city_id <= 0) {
        echo json_encode([
            "success" => false,
            "message" => "Valid city_id parameter is required"
        ]);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, city_id FROM area WHERE city_id = ? ORDER BY name ASC");

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Prepare failed: " . $conn->error
        ]);
        exit();
    }

    $stmt->bind_param("i", $city_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "success" => true,
        "count" => count($data),
        "data" => $data
    ]);

    $stmt->close();
}
// Invalid type
else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid type. Use: countries, states, cities"
    ]);
}

$conn->close();
?>