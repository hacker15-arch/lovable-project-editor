# RentHome Backend - MySQL & PHP API

This backend provides a complete REST API for the RentHome property rental application using MySQL database and PHP.

## 📁 Project Structure

```
backend/
├── schema.sql              # Database schema and sample data
├── config.php             # Database configuration
├── db.php                 # Database connection
├── api/
│   ├── properties.php     # CRUD operations for all properties
│   ├── property.php       # Single property operations
│   └── search.php         # Property search functionality
├── admin/
│   └── index.php          # Admin dashboard
├── test_api.php           # API testing interface
└── README.md              # This file
```

## 🚀 Quick Setup

### 1. Database Setup

1. **Create MySQL Database:**
   ```sql
   mysql -u root -p
   ```
   
2. **Import Schema:**
   ```bash
   mysql -u root -p < backend/schema.sql
   ```
   
   Or manually run the SQL commands from `schema.sql` in your MySQL client.

### 2. Configure Database Connection

Edit `backend/config.php` with your MySQL credentials:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'renthome');
define('DB_USER', 'your_username');    // Change this
define('DB_PASS', 'your_password');    // Change this
```

### 3. Web Server Setup

**Option A: Using XAMPP/WAMP/MAMP**
1. Copy the `backend` folder to your web server directory (htdocs/www)
2. Start Apache and MySQL services
3. Access: `http://localhost/backend/`

**Option B: Using PHP Built-in Server**
```bash
cd backend
php -S localhost:8080
```

### 4. Test the Setup

1. **Admin Dashboard:** `http://localhost/backend/admin/`
2. **API Tester:** `http://localhost/backend/test_api.php`
3. **Direct API:** `http://localhost/backend/api/properties.php`

## 🔌 API Endpoints

### Properties Collection

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/api/properties.php` | Get all properties |
| POST   | `/api/properties.php` | Add new property |

### Single Property

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/api/property.php?id=1` | Get property by ID |
| PUT    | `/api/property.php?id=1` | Update property |
| DELETE | `/api/property.php?id=1` | Delete property |

### Search

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | `/api/search.php` | Search properties with filters |

## 📝 API Usage Examples

### Get All Properties
```javascript
fetch('http://localhost/backend/api/properties.php')
  .then(response => response.json())
  .then(data => console.log(data));
```

### Add New Property
```javascript
const propertyData = {
  title: "Modern Villa",
  location: "Mumbai, Maharashtra",
  price: 75000,
  bedrooms: 3,
  bathrooms: 2,
  parking: 1,
  type: "Villa",
  image: "villa.jpg"
};

fetch('http://localhost/backend/api/properties.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify(propertyData)
});
```

### Search Properties
```javascript
const searchParams = new URLSearchParams({
  location: 'Mumbai',
  type: 'Villa',
  min_price: 50000,
  max_price: 100000
});

fetch(`http://localhost/backend/api/search.php?${searchParams}`)
  .then(response => response.json())
  .then(data => console.log(data));
```

## 🔍 Search Parameters

| Parameter | Type | Description |
|-----------|------|-------------|
| `location` | string | Search in location field |
| `type` | string | Property type (Villa, Apartment, etc.) |
| `min_price` | number | Minimum price filter |
| `max_price` | number | Maximum price filter |
| `bedrooms` | number | Minimum bedrooms |
| `bathrooms` | number | Minimum bathrooms |
| `parking` | boolean | Parking availability (0/1) |
| `limit` | number | Results per page (default: 50) |
| `offset` | number | Pagination offset (default: 0) |

## 🗄️ Database Schema

### Properties Table

| Column | Type | Description |
|--------|------|-------------|
| `id` | INT AUTO_INCREMENT | Primary key |
| `image` | VARCHAR(255) | Image filename |
| `title` | VARCHAR(255) | Property title |
| `location` | VARCHAR(255) | Property location |
| `price` | DECIMAL(10,2) | Monthly rent price |
| `bedrooms` | INT | Number of bedrooms |
| `bathrooms` | INT | Number of bathrooms |
| `parking` | TINYINT(1) | Parking available (0/1) |
| `type` | VARCHAR(50) | Property type |
| `created_at` | TIMESTAMP | Creation timestamp |
| `updated_at` | TIMESTAMP | Last update timestamp |

## 🔒 Security Features

- **SQL Injection Protection:** All queries use prepared statements
- **Input Validation:** Required fields validation
- **Error Handling:** Proper HTTP status codes and error messages
- **CORS Headers:** Configured for frontend integration

## 🛠️ Development Tools

### Admin Dashboard
- View all properties with statistics
- Modern, responsive design
- Property type badges and formatting
- Real-time data from database

### API Tester
- Interactive testing interface
- Test all endpoints without external tools
- Form-based property creation
- Real-time response display

## 🔧 Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check MySQL service is running
   - Verify credentials in `config.php`
   - Ensure database `renthome` exists

2. **CORS Errors**
   - Check `Access-Control-Allow-Origin` headers
   - Verify frontend URL is allowed

3. **404 Not Found**
   - Check web server configuration
   - Verify file paths and permissions

4. **500 Internal Server Error**
   - Check PHP error logs
   - Verify database connection
   - Check file permissions

### Enable PHP Error Reporting
Add to the top of PHP files for debugging:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 🚀 Integration with React Frontend

To connect your existing React app with this backend:

1. **Update API calls** in your React components:
```javascript
// Replace mock data with API calls
const fetchProperties = async () => {
  const response = await fetch('http://localhost/backend/api/properties.php');
  return response.json();
};
```

2. **Handle CORS** if needed:
```javascript
// Add to your fetch requests if required
const response = await fetch(url, {
  mode: 'cors',
  headers: {
    'Content-Type': 'application/json',
  }
});
```

## 📈 Performance Considerations

- **Indexing:** Add database indexes for frequently searched columns
- **Caching:** Implement caching for frequently accessed data
- **Pagination:** Use limit/offset for large datasets
- **Connection Pooling:** Consider connection pooling for high traffic

## 🔄 Future Enhancements

- User authentication and authorization
- Image upload functionality
- Property favorites system
- Advanced filtering options
- Email notifications
- Property booking system
- Payment integration

---

**Need Help?** Check the API tester at `/test_api.php` or admin dashboard at `/admin/` for interactive testing and management.
