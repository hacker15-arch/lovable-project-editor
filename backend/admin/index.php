<?php
// backend/admin/index.php
require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RentHome Admin - Properties</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body { 
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
      background-color: #f8fafc; 
      color: #1e293b;
      line-height: 1.6;
    }
    
    .container { 
      max-width: 1200px; 
      margin: 0 auto; 
      padding: 20px;
    }
    
    .header { 
      text-align: center; 
      margin-bottom: 40px; 
      padding: 40px 0;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .header h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 10px;
    }
    
    .header p {
      font-size: 1.1rem;
      opacity: 0.9;
    }
    
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }
    
    .stat-card {
      background: white;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: center;
      border-left: 4px solid #667eea;
    }
    
    .stat-number {
      font-size: 2rem;
      font-weight: 700;
      color: #667eea;
      margin-bottom: 8px;
    }
    
    .stat-label {
      color: #64748b;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .table-container {
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    
    .table-header {
      padding: 24px;
      border-bottom: 1px solid #e2e8f0;
    }
    
    .table-header h2 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1e293b;
    }
    
    table { 
      width: 100%; 
      border-collapse: collapse;
    }
    
    th, td { 
      padding: 16px 24px; 
      text-align: left; 
      border-bottom: 1px solid #e2e8f0;
    }
    
    th { 
      background-color: #f8fafc; 
      color: #475569;
      font-weight: 600;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    tr:hover { 
      background-color: #f1f5f9; 
    }
    
    .price {
      font-weight: 600;
      color: #059669;
    }
    
    .type-badge {
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .type-villa { background-color: #dbeafe; color: #1e40af; }
    .type-apartment { background-color: #dcfce7; color: #166534; }
    .type-penthouse { background-color: #fef3c7; color: #92400e; }
    .type-studio { background-color: #fce7f3; color: #be185d; }
    
    .no-data {
      text-align: center;
      padding: 60px 20px;
      color: #64748b;
    }
    
    .no-data h3 {
      font-size: 1.25rem;
      margin-bottom: 8px;
    }
    
    @media (max-width: 768px) {
      .container {
        padding: 10px;
      }
      
      .header h1 {
        font-size: 2rem;
      }
      
      table {
        font-size: 0.875rem;
      }
      
      th, td {
        padding: 12px 16px;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>RentHome Admin Dashboard</h1>
    <p>Manage Property Listings & Analytics</p>
  </div>
  
  <?php
  // Get statistics
  try {
      $totalPropertiesStmt = $pdo->query("SELECT COUNT(*) as total FROM properties");
      $totalProperties = $totalPropertiesStmt->fetch()['total'];
      
      $avgPriceStmt = $pdo->query("SELECT AVG(price) as avg_price FROM properties");
      $avgPrice = $avgPriceStmt->fetch()['avg_price'];
      
      $typesStmt = $pdo->query("SELECT COUNT(DISTINCT type) as types FROM properties");
      $totalTypes = $typesStmt->fetch()['types'];
      
      $recentStmt = $pdo->query("SELECT COUNT(*) as recent FROM properties WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)");
      $recentProperties = $recentStmt->fetch()['recent'];
  } catch (PDOException $e) {
      $totalProperties = $avgPrice = $totalTypes = $recentProperties = 0;
  }
  ?>
  
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-number"><?php echo number_format($totalProperties); ?></div>
      <div class="stat-label">Total Properties</div>
    </div>
    <div class="stat-card">
      <div class="stat-number">₹<?php echo number_format($avgPrice, 0); ?></div>
      <div class="stat-label">Average Price</div>
    </div>
    <div class="stat-card">
      <div class="stat-number"><?php echo $totalTypes; ?></div>
      <div class="stat-label">Property Types</div>
    </div>
    <div class="stat-card">
      <div class="stat-number"><?php echo $recentProperties; ?></div>
      <div class="stat-label">Added This Month</div>
    </div>
  </div>
  
  <div class="table-container">
    <div class="table-header">
      <h2>Property Listings</h2>
    </div>
    
    <?php
    try {
        $stmt = $pdo->query("SELECT * FROM properties ORDER BY created_at DESC");
        $properties = $stmt->fetchAll();
        
        if (count($properties) > 0) {
    ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Location</th>
          <th>Price</th>
          <th>Bedrooms</th>
          <th>Bathrooms</th>
          <th>Parking</th>
          <th>Type</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($properties as $row) {
            $typeClass = 'type-' . strtolower($row['type']);
            $parkingStatus = $row['parking'] ? 'Yes' : 'No';
            $createdDate = date('M j, Y', strtotime($row['created_at']));
            
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['location']}</td>
                    <td class='price'>₹" . number_format($row['price'], 0) . "/mo</td>
                    <td>{$row['bedrooms']}</td>
                    <td>{$row['bathrooms']}</td>
                    <td>{$parkingStatus}</td>
                    <td><span class='type-badge {$typeClass}'>{$row['type']}</span></td>
                    <td>{$createdDate}</td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
    <?php
        } else {
    ?>
    <div class="no-data">
      <h3>No Properties Found</h3>
      <p>Start by adding some properties to your database.</p>
    </div>
    <?php
        }
    } catch (PDOException $e) {
    ?>
    <div class="no-data">
      <h3>Error Loading Data</h3>
      <p>Unable to fetch properties from the database.</p>
    </div>
    <?php
    }
    ?>
  </div>
</div>
</body>
</html>
