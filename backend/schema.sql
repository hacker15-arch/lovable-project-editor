-- Create database
CREATE DATABASE IF NOT EXISTS renthome CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE renthome;

-- Create properties table
CREATE TABLE IF NOT EXISTS properties (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  location VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  bedrooms INT NOT NULL,
  bathrooms INT NOT NULL,
  parking TINYINT(1) NOT NULL DEFAULT 0,
  type VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO properties (image, title, location, price, bedrooms, bathrooms, parking, type)
VALUES 
('house1.jpg', 'Modern Luxury Villa', 'Bandra West, Mumbai', 85000, 3, 2, 1, 'Villa'),
('house2.jpg', 'Elegant Pool Villa', 'Koramangala, Bangalore', 65000, 4, 3, 1, 'Villa'),
('house3.jpg', 'Urban Apartment Complex', 'Cyber City, Gurgaon', 35000, 2, 2, 1, 'Apartment'),
('house1.jpg', 'Premium Penthouse', 'Anna Nagar, Chennai', 95000, 4, 4, 1, 'Penthouse'),
('house2.jpg', 'Family Villa with Garden', 'Jubilee Hills, Hyderabad', 72000, 3, 3, 1, 'Villa'),
('house3.jpg', 'Modern Studio Apartment', 'Connaught Place, Delhi', 45000, 1, 1, 0, 'Studio');
