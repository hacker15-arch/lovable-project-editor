<?php
// backend/api/properties.php

header("Content-Type: application/json");
// Allow CORS for development; adjust as needed in production
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../db.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'GET':
        getProperties();
        break;
    case 'POST':
        addProperty();
        break;
    case 'PUT':
        updateProperty();
        break;
    case 'DELETE':
        deleteProperty();
        break;
    case 'OPTIONS':
        // Preflight request for CORS
        http_response_code(200);
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

// Function to fetch properties from the database
function getProperties() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
        $properties = $stmt->fetchAll();
        echo json_encode($properties);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch properties.']);
    }
}

// Function to add a new property to the database
function addProperty() {
    global $pdo;
    // Read and decode JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate required fields
    if (
        !isset($data['image']) || 
        !isset($data['title']) || 
        !isset($data['location']) || 
        !isset($data['price']) ||
        !isset($data['bedrooms']) || 
        !isset($data['bathrooms']) || 
        !isset($data['parking']) || 
        !isset($data['type'])
    ) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required property fields.']);
        exit;
    }

    try {
        $sql = "INSERT INTO properties (image, title, location, price, bedrooms, bathrooms, parking, type) 
                VALUES (:image, :title, :location, :price, :bedrooms, :bathrooms, :parking, :type)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':image'     => $data['image'],
            ':title'     => $data['title'],
            ':location'  => $data['location'],
            ':price'     => $data['price'],
            ':bedrooms'  => $data['bedrooms'],
            ':bathrooms' => $data['bathrooms'],
            ':parking'   => $data['parking'],
            ':type'      => $data['type']
        ]);

        $propertyId = $pdo->lastInsertId();
        http_response_code(201);
        echo json_encode(['message' => 'Property added successfully', 'id' => $propertyId]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to add property.']);
    }
}

// Function to update an existing property
function updateProperty() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Property ID is required.']);
        exit;
    }

    try {
        $sql = "UPDATE properties SET 
                image = :image, 
                title = :title, 
                location = :location, 
                price = :price, 
                bedrooms = :bedrooms, 
                bathrooms = :bathrooms, 
                parking = :parking, 
                type = :type 
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id'        => $data['id'],
            ':image'     => $data['image'],
            ':title'     => $data['title'],
            ':location'  => $data['location'],
            ':price'     => $data['price'],
            ':bedrooms'  => $data['bedrooms'],
            ':bathrooms' => $data['bathrooms'],
            ':parking'   => $data['parking'],
            ':type'      => $data['type']
        ]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Property updated successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Property not found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update property.']);
    }
}

// Function to delete a property
function deleteProperty() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Property ID is required.']);
        exit;
    }

    try {
        $sql = "DELETE FROM properties WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $data['id']]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Property deleted successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Property not found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete property.']);
    }
}
?>
