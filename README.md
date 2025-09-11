# 🍔 Advanced Food Ordering System

> A comprehensive geospatial-enabled food ordering platform built with PHP and MySQL, demonstrating advanced database concepts and full-stack web development.

## 📋 Table of Contents

- [Overview](#overview)
- [Key Features](#key-features)
- [Technical Architecture](#technical-architecture)
- [Database Design](#database-design)
- [Installation & Setup](#installation--setup)
- [Usage](#usage)
- [Technical Highlights](#technical-highlights)
- [Skills Demonstrated](#skills-demonstrated)
- [Screenshots](#screenshots)

## 🎯 Overview

This project is a sophisticated food ordering system developed as a comprehensive database course final project. It showcases advanced database concepts including **geospatial data processing**, **complex query optimization**, and **real-time data validation**. The system serves both customers and restaurant owners with distinct interfaces and functionality.

**🎥 [Live Demo](#) | 📊 [Database Schema](#)**

## ✨ Key Features

### 🔐 **Dual-Role Authentication System**
- Secure user registration and login with salted password hashing
- Role-based access control (Customer/Shop Owner)
- Session management with comprehensive security measures
- Real-time account validation and duplicate checking

### 🗺️ **Geospatial Functionality**
- **Location-based restaurant discovery** using MySQL spatial functions
- Distance calculations with `ST_Distance_Sphere()` for precise proximity search
- Geographic data storage using `POINT` geometry types
- Advanced location filtering (near/medium/far distance ranges)

### 🔍 **Advanced Search & Filtering**
- **Multi-parameter search**: location, price range, meal name, category
- Real-time search suggestions and filtering
- Complex SQL queries with JOINs and subqueries
- Optimized database queries for performance

### 🏪 **Restaurant Management**
- Shop registration with geospatial coordinates
- Product catalog management with image uploads
- Real-time inventory tracking
- Dynamic pricing and availability updates

### 🎨 **Modern Web Interface**
- Responsive Bootstrap-based UI
- AJAX-powered real-time form validation
- Interactive map integration concepts
- Professional UX/UI design patterns

## 🏗️ Technical Architecture

### **Backend Stack**
- **PHP 7.4+** - Server-side logic and API endpoints
- **MySQL 8.0+** - Database with spatial extensions
- **PDO** - Secure database connections with prepared statements
- **Session-based Authentication** - Secure user state management
f dgf
### **Frontend Stack**
- **HTML5/CSS3** - Semantic markup and modern styling
- **Bootstrap 4** - Responsive grid system and components
- **jQuery** - DOM manipulation and AJAX requests
- **JavaScript ES6** - Client-side validation and interactions

### **Project Structure**
```
├── php/
│   ├── back/          # Authentication & core backend logic
│   ├── nav/           # Navigation and business logic
│   └── shit/          # Shared components (head/foot)
├── css/               # Stylesheets and themes
├── js/                # Client-side JavaScript
├── images/            # Static assets and uploaded content
└── fonts/             # Typography resources
```

## 🗄️ Database Design

### **Core Tables & Relationships**

#### **Users Table**
```sql
- UID (Primary Key)
- account, username, phoneNum
- password (SHA-256 hashed with salt)
- location (POINT geometry type)
- balance, identity (customer/owner flag)
```

#### **Shops Table**
```sql
- SID (Primary Key)
- UID (Foreign Key → Users)
- shopname, category
- location (POINT geometry type)
- phoneNum
```

#### **Products Table**
```sql
- PID (Primary Key) 
- SID (Foreign Key → Shops)
- productName, price, quantity
- image (BLOB/file path)
```

### **Advanced Spatial Queries**
```sql
-- Distance-based restaurant search
SELECT * FROM shops 
WHERE ST_Distance_Sphere(POINT(?, ?), location) < ?

-- Price range filtering with product joins
SELECT SID FROM shops 
NATURAL JOIN products 
WHERE price BETWEEN ? AND ? 
GROUP BY SID
```

## ⚙️ Installation & Setup

### **Prerequisites**
- **XAMPP/LAMP** stack (Apache, MySQL, PHP)
- **MySQL 8.0+** with spatial extension support
- **Web browser** with JavaScript enabled

### **Installation Steps**

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/food-ordering-system
   cd food-ordering-system
   ```

2. **Configure Database**
   ```bash
   # Create database
   mysql -u root -p
   CREATE DATABASE acdb;
   USE acdb;
   
   # Import schema (create your schema based on the code structure)
   SOURCE database/schema.sql;
   ```

3. **Update Database Configuration**
   ```php
   // Update in php/back/login.php and other config files
   $dbusername = 'your_username';
   $dbpassword = 'your_password';
   ```

4. **Deploy to Web Server**
   ```bash
   # Copy to web server directory
   cp -r . /var/www/html/food-ordering-system/
   ```

5. **Access Application**
   - Navigate to `http://localhost/food-ordering-system/`
   - Register new account or use demo credentials

## 🚀 Usage

### **For Customers**
1. **Register Account**: Create account with location coordinates
2. **Search Restaurants**: Find restaurants by distance, cuisine, or price range
3. **Browse Menus**: View product catalogs with images and pricing
4. **Place Orders**: Select items and manage shopping cart

### **For Restaurant Owners**  
1. **Register Business**: Set up restaurant profile with geospatial data
2. **Manage Products**: Add/edit menu items with images and pricing
3. **Update Inventory**: Real-time quantity and availability management
4. **Business Analytics**: Track orders and customer engagement

## 💡 Technical Highlights

### **🗺️ Geospatial Data Processing**
- Implemented MySQL spatial functions (`ST_GeomFromText`, `ST_Distance_Sphere`)
- Efficient distance calculations using spherical geometry
- Geographic coordinate validation and processing
- Location-based proximity search with configurable ranges

### **🔒 Security Best Practices**
- **Password Security**: SHA-256 hashing with unique salts per user
- **SQL Injection Prevention**: Parameterized queries with PDO
- **Input Validation**: Comprehensive client-side and server-side validation
- **Session Security**: Proper session management with cleanup and timeout

### **⚡ Performance Optimizations**
- **Complex Query Optimization**: Efficient JOINs and spatial calculations
- **Real-time Validation**: AJAX-powered duplicate checking without page reload
- **Database Indexing**: Strategic indexes on spatial and frequently queried columns
- **Optimized Loading**: Dynamic content loading and image optimization

### **🎯 Advanced Database Concepts**
- **Spatial Data Types**: POINT geometry for precise coordinate storage
- **Foreign Key Constraints**: Proper referential integrity maintenance
- **Complex Aggregations**: GROUP BY with spatial distance calculations
- **Transaction Management**: Consistent multi-table operations

## 🛠️ Skills Demonstrated

### **Database & Backend Development**
- ✅ **Advanced MySQL**: Spatial functions, complex queries, performance optimization
- ✅ **Database Design**: Proper normalization, foreign keys, spatial indexing
- ✅ **PHP Development**: Object-oriented programming, PDO, session management
- ✅ **Security Implementation**: Authentication, authorization, data validation
- ✅ **API Design**: RESTful endpoints, JSON responses, error handling

### **Frontend & User Experience**
- ✅ **Responsive Design**: Bootstrap framework, mobile-first approach
- ✅ **Interactive JavaScript**: jQuery, AJAX, real-time validation
- ✅ **Form Handling**: Dynamic validation, file uploads, user feedback
- ✅ **UI/UX Design**: Clean interfaces, intuitive navigation, accessibility

### **System Architecture & Design**
- ✅ **MVC Patterns**: Separation of concerns, modular architecture
- ✅ **File Management**: Image uploads, file validation, storage optimization
- ✅ **Real-time Features**: Live validation, dynamic content updates
- ✅ **Code Organization**: Maintainable structure, documentation, best practices

## 📸 Screenshots

*Replace this section with actual screenshots of your application:*
- Login/Registration interface
- Customer dashboard with restaurant search
- Restaurant owner product management
- Geospatial search results with distance filtering
- Real-time form validation examples

## 🏆 Project Achievements

- **🗺️ Complex Geospatial Integration**: Successfully implemented MySQL spatial functions for location-based restaurant discovery with precise distance calculations
- **👥 Dual-Role Architecture**: Created distinct, secure interfaces for customers and business owners with appropriate access controls
- **🔐 Enterprise-Grade Security**: Implemented comprehensive security measures including salted password hashing, SQL injection prevention, and session management
- **⚡ Real-time Features**: Built AJAX-powered validation, dynamic content updates, and responsive user interactions
- **🎨 Professional UI/UX**: Developed responsive, accessible interface following modern web design principles and usability standards

## 🚀 Future Enhancements

- **Payment Integration**: Stripe/PayPal integration for online transactions
- **Order Tracking**: Real-time order status updates and delivery tracking
- **Mobile App**: React Native or Flutter mobile application
- **Analytics Dashboard**: Advanced reporting and business intelligence features
- **Machine Learning**: Recommendation system based on user preferences and order history

---

*This project demonstrates proficiency in full-stack web development, advanced database concepts, geospatial data processing, and modern software engineering practices suitable for enterprise-level applications.*
