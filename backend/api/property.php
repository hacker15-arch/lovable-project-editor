<?php
// backend/api/property.php - Single property operations

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../db.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

// Get property ID from URL parameter
$propertyId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($propertyId <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Valid property ID is required']);
    exit;
}

switch ($requestMethod) {
    case 'GET':
        getProperty($propertyId);
        break;
    case 'PUT':
        updateProperty($propertyId);
        break;
    case 'DELETE':
        deleteProperty($propertyId);
        break;
    case 'OPTIONS':
        http_response_code(200);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

// Function to get a single property
function getProperty($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM properties WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $property = $stmt->fetch();
        
        if ($property) {
            echo json_encode($property);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Property not found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch property']);
    }
}

// Function to update a property
function updateProperty($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate required fields
    if (
        !isset($data['title']) || 
        !isset($data['location']) || 
        !isset($data['price']) ||
        !isset($data['bedrooms']) || 
        !isset($data['bathrooms']) || 
        !isset($data['type'])
    ) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
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
                type = :type,
                updated_at = CURRENT_TIMESTAMP
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':id'        => $id,
            ':image'     => $data['image'] ?? '',
            ':title'     => $data['title'],
            ':location'  => $data['location'],
            ':price'     => $data['price'],
            ':bedrooms'  => $data['bedrooms'],
            ':bathrooms' => $data['bathrooms'],
            ':parking'   => isset($data['parking']) ? (int)$data['parking'] : 0,
            ':type'      => $data['type']
        ]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Property updated successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Property not found or no changes made']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update property']);
    }
}

// Function to delete a property
function deleteProperty($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM properties WHERE id = :id");
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Property deleted successfully']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Property not found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete property']);
    }
}
?>
