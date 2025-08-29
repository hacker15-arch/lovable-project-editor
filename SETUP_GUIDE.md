# 🚀 RentHome Website Setup Guide

This guide will help you run the complete RentHome website with both the React frontend and PHP backend.

## 📋 Prerequisites

Before starting, make sure you have:
- **Node.js** (v16 or higher) - for React frontend
- **PHP** (v7.4 or higher) - for backend API
- **MySQL** (v5.7 or higher) - for database
- **Web Server** (Apache/Nginx) or **XAMPP/WAMP/MAMP**

## 🗄️ Step 1: Database Setup

### Option A: Using MySQL Command Line
```bash
# 1. Login to MySQL
mysql -u root -p

# 2. Create database and import schema
mysql -u root -p < backend/schema.sql
```

### Option B: Using phpMyAdmin (if using XAMPP/WAMP)
1. Open phpMyAdmin in browser: `http://localhost/phpmyadmin`
2. Create new database named `renthome`
3. Import the file `backend/schema.sql`

### Option C: Manual Setup
```sql
-- Run these commands in your MySQL client:
CREATE DATABASE renthome CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE renthome;

-- Then copy and paste the contents of backend/schema.sql
```

## ⚙️ Step 2: Configure Backend

1. **Edit Database Configuration:**
   Open `backend/config.php` and update your MySQL credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'renthome');
   define('DB_USER', 'root');          // Your MySQL username
   define('DB_PASS', 'your_password'); // Your MySQL password
   ```

## 🌐 Step 3: Run the Backend (PHP API)

### Option A: Using XAMPP/WAMP/MAMP
1. **Install XAMPP/WAMP/MAMP** if not already installed
2. **Copy backend folder** to your web server directory:
   - XAMPP: `C:\xampp\htdocs\` (Windows) or `/Applications/XAMPP/htdocs/` (Mac)
   - WAMP: `C:\wamp64\www\`
   - MAMP: `/Applications/MAMP/htdocs/`
3. **Start Apache and MySQL** services from XAMPP/WAMP/MAMP control panel
4. **Test backend:** Open `http://localhost/backend/` in your browser

### Option B: Using PHP Built-in Server
```bash
# Navigate to backend directory
cd backend

# Start PHP server on port 8080
php -S localhost:8080

# Test: Open http://localhost:8080 in browser
```

### Option C: Using Apache/Nginx
1. Configure your web server to serve the backend directory
2. Ensure PHP and MySQL modules are enabled
3. Set appropriate permissions for the backend files

## ⚛️ Step 4: Run the Frontend (React)

```bash
# Install dependencies (if not already done)
npm install

# Start development server
npm run dev
```

The React app will start on `http://localhost:5173` (or another port if 5173 is busy).

## 🔗 Step 5: Connect Frontend to Backend

The frontend is currently using mock data. To connect it to your PHP backend:

1. **Update API calls** in your React components
2. **Replace mock data** with actual API calls

Example update for `src/pages/Index.tsx`:
```javascript
// Add this at the top of the file
import { useState, useEffect } from 'react';

// Replace the mock properties array with:
const Index = () => {
  const [properties, setProperties] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchProperties();
  }, []);

  const fetchProperties = async () => {
    try {
      const response = await fetch('http://localhost:8080/api/properties.php');
      const data = await response.json();
      setProperties(data);
    } catch (error) {
      console.error('Error fetching properties:', error);
      // Fallback to mock data if API fails
      setProperties(mockProperties);
    } finally {
      setLoading(false);
    }
  };

  // Rest of your component code...
```

## 🧪 Step 6: Test Everything

### Test Backend:
1. **Backend Home:** `http://localhost:8080/` (or `http://localhost/backend/`)
2. **Admin Dashboard:** `http://localhost:8080/admin/`
3. **API Tester:** `http://localhost:8080/test_api.php`
4. **Properties API:** `http://localhost:8080/api/properties.php`

### Test Frontend:
1. **React App:** `http://localhost:5173/`
2. Check browser console for any errors
3. Verify properties are loading from the backend

## 🚀 Quick Start Commands

```bash
# Terminal 1: Start Backend (PHP)
cd backend
php -S localhost:8080

# Terminal 2: Start Frontend (React)
npm run dev
```

Then open:
- **Frontend:** http://localhost:5173
- **Backend:** http://localhost:8080

## 🔧 Troubleshooting

### Common Issues:

1. **Database Connection Failed**
   ```bash
   # Check if MySQL is running
   # Windows: Check XAMPP/WAMP control panel
   # Mac/Linux: 
   sudo service mysql status
   ```

2. **CORS Errors**
   - Backend already includes CORS headers
   - If issues persist, check browser console

3. **Port Already in Use**
   ```bash
   # For PHP backend, try different port:
   php -S localhost:8081
   
   # For React, Vite will automatically suggest another port
   ```

4. **Properties Not Loading**
   - Check backend API: `http://localhost:8080/api/properties.php`
   - Verify database has data
   - Check browser network tab for failed requests

### Enable Debug Mode:
Add to top of PHP files for debugging:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## 📱 Production Deployment

For production deployment:

1. **Frontend:** Build and deploy to static hosting
   ```bash
   npm run build
   # Deploy dist/ folder to Netlify, Vercel, etc.
   ```

2. **Backend:** Deploy to web hosting with PHP/MySQL support
   - Update `config.php` with production database credentials
   - Remove debug settings
   - Configure proper CORS origins

## 🎉 Success!

If everything is working:
- ✅ React frontend running on http://localhost:5173
- ✅ PHP backend running on http://localhost:8080
- ✅ MySQL database connected and populated
- ✅ API endpoints responding correctly
- ✅ Admin dashboard accessible

You now have a fully functional property rental website with:
- Modern React frontend with Tailwind CSS
- RESTful PHP API backend
- MySQL database with sample data
- Admin dashboard for property management
- Search and filtering capabilities

## 📞 Need Help?

- Check the `backend/README.md` for detailed API documentation
- Use the API tester at `http://localhost:8080/test_api.php`
- Check browser console and network tab for errors
- Verify all services (MySQL, PHP, Node.js) are running
