<?php
require('db.php');

// Allow requests from localhost or from your React Native app's domain
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
	header("Content-Type: application/json; charset=UTF-8");

$requestUri = explode('/', trim($_GET['request'], '/'));

// Extract resource and ID
$resource = $requestUri[0] ?? null;
$id = $requestUri[1] ?? null;

// Check if accessing users resource
if ($resource === "users") {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        getUser($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        createUser();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        updateUser($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        deleteUser($id);
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
    }
} else if ($resource === "items") {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        getItem($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        createItem();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        updateItem($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        deleteItem($id);
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
    }
} else {
    http_response_code(404);
    echo json_encode(["error" => "Resource not found"]);
}

// Function to get user
function getItem($id) {
    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "User ID required"]);
        return;
    }
    // Dummy data
    echo json_encode(["id" => $id, "name" => "Item 1"]);
}

// Function to get user
function getUser($id) {
  	global $pdo;
    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "User ID required"]);
        return;
    }
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $statement->execute([$id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
    // Dummy data
    //echo json_encode(["id" => $id, "name" => "John Doe"]);
}

// Function to create user
function createUser() {
    $input = json_decode(file_get_contents("php://input"), true);
    if (!$input || !isset($input['name'])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid input"]);
        return;
    }
    echo json_encode(["message" => "User created", "data" => $input]);
}

// Function to update user
function updateUser($id) {
    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "User ID required"]);
        return;
    }
    $input = json_decode(file_get_contents("php://input"), true);
    echo json_encode(["message" => "User $id updated", "data" => $input]);
}

// Function to delete user
function deleteUser($id) {
    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "User ID required"]);
        return;
    }
    echo json_encode(["message" => "User $id deleted"]);
}
?>
