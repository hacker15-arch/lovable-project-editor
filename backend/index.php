<?php
// backend/index.php - Backend landing page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentHome Backend API</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .container {
            text-align: center;
            max-width: 600px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .subtitle {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }
        
        .links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .link-card {
            background: rgba(255, 255, 255, 0.2);
            padding: 24px;
            border-radius: 12px;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .link-card:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-5px);
        }
        
        .link-card h3 {
            font-size: 1.25rem;
            margin-bottom: 8px;
        }
        
        .link-card p {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .api-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 24px;
            border-radius: 12px;
            text-align: left;
        }
        
        .api-info h3 {
            margin-bottom: 16px;
            color: #fff;
        }
        
        .endpoint {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .endpoint:last-child {
            border-bottom: none;
        }
        
        .method {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .method.get { background: rgba(34, 197, 94, 0.3); }
        .method.post { background: rgba(59, 130, 246, 0.3); }
        .method.put { background: rgba(245, 158, 11, 0.3); }
        .method.delete { background: rgba(239, 68, 68, 0.3); }
        
        .status {
            margin-top: 30px;
            padding: 16px;
            background: rgba(34, 197, 94, 0.2);
            border-radius: 8px;
            border-left: 4px solid #22c55e;
        }
        
        .status.error {
            background: rgba(239, 68, 68, 0.2);
            border-left-color: #ef4444;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">🏠</div>
        <h1>RentHome Backend</h1>
        <p class="subtitle">MySQL Database & PHP REST API</p>
        
        <div class="links">
            <a href="admin/" class="link-card">
                <h3>📊 Admin Dashboard</h3>
                <p>Manage properties and view statistics</p>
            </a>
            
            <a href="test_api.php" class="link-card">
                <h3>🧪 API Tester</h3>
                <p>Interactive API testing interface</p>
            </a>
            
            <a href="api/properties.php" class="link-card">
                <h3>🔌 Properties API</h3>
                <p>Direct access to properties endpoint</p>
            </a>
        </div>
        
        <div class="api-info">
            <h3>Available API Endpoints</h3>
            
            <div class="endpoint">
                <span>/api/properties.php</span>
                <div>
                    <span class="method get">GET</span>
                    <span class="method post">POST</span>
                </div>
            </div>
            
            <div class="endpoint">
                <span>/api/property.php?id={id}</span>
                <div>
                    <span class="method get">GET</span>
                    <span class="method put">PUT</span>
                    <span class="method delete">DELETE</span>
                </div>
            </div>
            
            <div class="endpoint">
                <span>/api/search.php</span>
                <span class="method get">GET</span>
            </div>
        </div>
        
        <?php
        // Test database connection
        try {
            require_once 'db.php';
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM properties");
            $count = $stmt->fetch()['count'];
            echo '<div class="status">✅ Database Connected - ' . $count . ' properties loaded</div>';
        } catch (Exception $e) {
            echo '<div class="status error">❌ Database Connection Failed - Check config.php</div>';
        }
        ?>
    </div>
</body>
</html>
