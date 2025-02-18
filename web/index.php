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
} else if ($resource === "products") {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        getProduct($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        createProduct();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        updateProduct($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        deleteProduct($id);
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
    } 
} else if ($resource === "register") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        register();
    }
} 
else if ($resource === "login") {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        getProduct($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        login();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        updateProduct($id);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        deleteProduct($id);
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
    } 
}
else {
    http_response_code(404);
    echo json_encode(["error" => "Resource not found"]);
}

function register() {
    $entityBody = file_get_contents('php://input');
    echo $entityBody;
    echo extract($_POST);
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    echo json_encode([$username,$_POST['password']],JSON_UNESCAPED_UNICODE);
    $stmt = $pdo->prepare("INSERT INTO users (username) VALUES (?)");
    $stmt->execute([$username]);
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    echo json_encode($stmt2);
}

// Function to get user
function getProduct($id) {
  	global $pdo;
    $sku = $_GET['sku'];
    
    if (!$id) {
        if ($sku); {
            $statement = $pdo->prepare("SELECT * FROM products WHERE sku = ?");
            $statement->execute([$sku]);
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($row, JSON_UNESCAPED_UNICODE);
            return;
        }
        $statement = $pdo->prepare("SELECT * FROM products");
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }else{
        
    $statement = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $statement->execute([$id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
}

// Function to get user
function getUser($id) {
  	global $pdo;
    if (!$id) {
        $statement = $pdo->prepare("SELECT * FROM users");
        $statement->execute();
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }else{
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $statement->execute([$id]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
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
