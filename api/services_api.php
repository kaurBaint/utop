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
 

    $sql = "SELECT id, name FROM services ORDER BY name ASC";
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
        "data" => $data,
        "data" => $data
    ]); 

$conn->close();
?>