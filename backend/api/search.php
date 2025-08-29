<?php
// backend/api/search.php - Property search functionality

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../db.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'GET':
        searchProperties();
        break;
    case 'OPTIONS':
        http_response_code(200);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

function searchProperties() {
    global $pdo;
    
    // Get search parameters
    $location = isset($_GET['location']) ? trim($_GET['location']) : '';
    $type = isset($_GET['type']) ? trim($_GET['type']) : '';
    $minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
    $maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 0;
    $bedrooms = isset($_GET['bedrooms']) ? (int)$_GET['bedrooms'] : 0;
    $bathrooms = isset($_GET['bathrooms']) ? (int)$_GET['bathrooms'] : 0;
    $parking = isset($_GET['parking']) ? (int)$_GET['parking'] : -1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 50;
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
    
    try {
        // Build dynamic query
        $sql = "SELECT * FROM properties WHERE 1=1";
        $params = [];
        
        if (!empty($location)) {
            $sql .= " AND location LIKE :location";
            $params[':location'] = '%' . $location . '%';
        }
        
        if (!empty($type)) {
            $sql .= " AND type = :type";
            $params[':type'] = $type;
        }
        
        if ($minPrice > 0) {
            $sql .= " AND price >= :min_price";
            $params[':min_price'] = $minPrice;
        }
        
        if ($maxPrice > 0) {
            $sql .= " AND price <= :max_price";
            $params[':max_price'] = $maxPrice;
        }
        
        if ($bedrooms > 0) {
            $sql .= " AND bedrooms >= :bedrooms";
            $params[':bedrooms'] = $bedrooms;
        }
        
        if ($bathrooms > 0) {
            $sql .= " AND bathrooms >= :bathrooms";
            $params[':bathrooms'] = $bathrooms;
        }
        
        if ($parking >= 0) {
            $sql .= " AND parking = :parking";
            $params[':parking'] = $parking;
        }
        
        $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        $properties = $stmt->fetchAll();
        
        // Get total count for pagination
        $countSql = str_replace("SELECT *", "SELECT COUNT(*)", $sql);
        $countSql = preg_replace('/ORDER BY.*LIMIT.*OFFSET.*/', '', $countSql);
        
        $countStmt = $pdo->prepare($countSql);
        foreach ($params as $key => $value) {
            $countStmt->bindValue($key, $value);
        }
        $countStmt->execute();
        $totalCount = $countStmt->fetchColumn();
        
        echo json_encode([
            'properties' => $properties,
            'total' => (int)$totalCount,
            'limit' => $limit,
            'offset' => $offset,
            'has_more' => ($offset + $limit) < $totalCount
        ]);
        
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Search failed']);
    }
}
?>
