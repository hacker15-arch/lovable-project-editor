<?php
// backend/test_api.php - Simple API testing interface

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentHome API Tester</title>
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
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
        }
        
        .test-section {
            background: white;
            margin-bottom: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .section-header {
            background: #f8fafc;
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .section-header h3 {
            color: #1e293b;
            font-size: 1.25rem;
        }
        
        .section-content {
            padding: 20px;
        }
        
        .test-button {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: background-color 0.2s;
        }
        
        .test-button:hover {
            background: #5a67d8;
        }
        
        .response-area {
            background: #1e293b;
            color: #e2e8f0;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            white-space: pre-wrap;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>RentHome API Tester</h1>
            <p>Test your PHP API endpoints</p>
        </div>

        <!-- Get All Properties -->
        <div class="test-section">
            <div class="section-header">
                <h3>Get All Properties</h3>
            </div>
            <div class="section-content">
                <button class="test-button" onclick="testGetProperties()">GET /api/properties.php</button>
                <div class="response-area" id="properties-response">Click the button to test...</div>
            </div>
        </div>

        <!-- Search Properties -->
        <div class="test-section">
            <div class="section-header">
                <h3>Search Properties</h3>
            </div>
            <div class="section-content">
                <div class="form-row">
                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" id="search-location" placeholder="e.g., Mumbai">
                    </div>
                    <div class="form-group">
                        <label>Type:</label>
                        <select id="search-type">
                            <option value="">Any</option>
                            <option value="Villa">Villa</option>
                            <option value="Apartment">Apartment</option>
                            <option value="Penthouse">Penthouse</option>
                            <option value="Studio">Studio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Min Price:</label>
                        <input type="number" id="search-min-price" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label>Max Price:</label>
                        <input type="number" id="search-max-price" placeholder="100000">
                    </div>
                </div>
                <button class="test-button" onclick="testSearchProperties()">Search Properties</button>
                <div class="response-area" id="search-response">Enter search criteria and click search...</div>
            </div>
        </div>

        <!-- Add Property -->
        <div class="test-section">
            <div class="section-header">
                <h3>Add New Property</h3>
            </div>
            <div class="section-content">
                <div class="form-row">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" id="add-title" placeholder="Property Title">
                    </div>
                    <div class="form-group">
                        <label>Location:</label>
                        <input type="text" id="add-location" placeholder="City, State">
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input type="number" id="add-price" placeholder="50000">
                    </div>
                    <div class="form-group">
                        <label>Type:</label>
                        <select id="add-type">
                            <option value="Villa">Villa</option>
                            <option value="Apartment">Apartment</option>
                            <option value="Penthouse">Penthouse</option>
                            <option value="Studio">Studio</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Bedrooms:</label>
                        <input type="number" id="add-bedrooms" placeholder="2" min="1">
                    </div>
                    <div class="form-group">
                        <label>Bathrooms:</label>
                        <input type="number" id="add-bathrooms" placeholder="2" min="1">
                    </div>
                    <div class="form-group">
                        <label>Parking:</label>
                        <select id="add-parking">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="text" id="add-image" placeholder="house1.jpg">
                    </div>
                </div>
                <button class="test-button" onclick="testAddProperty()">Add Property</button>
                <div class="response-area" id="add-response">Fill the form and click add...</div>
            </div>
        </div>
    </div>

    <script>
        async function testGetProperties() {
            const responseArea = document.getElementById('properties-response');
            responseArea.textContent = 'Loading...';
            
            try {
                const response = await fetch('./api/properties.php');
                const data = await response.json();
                responseArea.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                responseArea.textContent = 'Error: ' + error.message;
            }
        }

        async function testSearchProperties() {
            const responseArea = document.getElementById('search-response');
            responseArea.textContent = 'Searching...';
            
            const params = new URLSearchParams();
            const location = document.getElementById('search-location').value;
            const type = document.getElementById('search-type').value;
            const minPrice = document.getElementById('search-min-price').value;
            const maxPrice = document.getElementById('search-max-price').value;
            
            if (location) params.append('location', location);
            if (type) params.append('type', type);
            if (minPrice) params.append('min_price', minPrice);
            if (maxPrice) params.append('max_price', maxPrice);
            
            try {
                const response = await fetch(`./api/search.php?${params.toString()}`);
                const data = await response.json();
                responseArea.textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                responseArea.textContent = 'Error: ' + error.message;
            }
        }

        async function testAddProperty() {
            const responseArea = document.getElementById('add-response');
            responseArea.textContent = 'Adding property...';
            
            const propertyData = {
                title: document.getElementById('add-title').value,
                location: document.getElementById('add-location').value,
                price: parseFloat(document.getElementById('add-price').value),
                type: document.getElementById('add-type').value,
                bedrooms: parseInt(document.getElementById('add-bedrooms').value),
                bathrooms: parseInt(document.getElementById('add-bathrooms').value),
                parking: parseInt(document.getElementById('add-parking').value),
                image: document.getElementById('add-image').value || 'house1.jpg'
            };
            
            try {
                const response = await fetch('./api/properties.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(propertyData)
                });
                const data = await response.json();
                responseArea.textContent = JSON.stringify(data, null, 2);
                
                if (response.ok) {
                    // Clear form on success
                    document.getElementById('add-title').value = '';
                    document.getElementById('add-location').value = '';
                    document.getElementById('add-price').value = '';
                    document.getElementById('add-bedrooms').value = '';
                    document.getElementById('add-bathrooms').value = '';
                    document.getElementById('add-image').value = '';
                }
            } catch (error) {
                responseArea.textContent = 'Error: ' + error.message;
            }
        }
    </script>
</body>
</html>
