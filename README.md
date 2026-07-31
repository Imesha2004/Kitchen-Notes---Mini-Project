# Kitchen Notes – A Digital Recipe Book 🍳📖

**Course**: ICT 1209 – Web Technologies | Rajarata University of Sri Lanka (2023/2024 Batch)  
**GitHub Repository**: [https://github.com/Imesha2004/Kitchen-Notes---Mini-Project.git](https://github.com/Imesha2004/Kitchen-Notes---Mini-Project.git)

---

## 👥 Group Project Members

1. **I.A. Udayasiri**
   - **Reg. No**: ITT/2024/110
   - **Index No**: 2795
2. **A.M.S.C.M Abesingha**
   - **Reg. No**: ITT/2024/002
   - **Index No**: 2687

---

## 📝 Project Overview

**Kitchen Notes** is a clean, modern, and interactive web application designed for home cooks, students, and food enthusiasts to store, organize, and discover delicious recipes. Built strictly adhering to the **ICT 1209 Mini Project Guidelines** and wireframes.

### Features:
- **Wireframe Blueprint 1 (Landing Page)**: Hero search bar, quick category filter chips (Italian, Breakfast, Asian, Dessert), dynamic recipe grid (`repeat(auto-fill, minmax(280px, 1fr))`), and automatic featured recipe image slider.
- **Wireframe Blueprint 2 (Profile Dashboard)**: User profile card showcasing user avatar, stats (recipes published, favorites, followers), and recipe card tabs.
- **Wireframe Blueprint 3 (Add Recipe)**: Interactive recipe creation form with dynamic JavaScript field generation for `+ Add Ingredients` and `+ Add Step`.
- **Wireframe Blueprint 3 (Contact Form)**: Client-side inquiry form with instant JS validation, storing submissions directly into the MySQL `messages` database table.
- **Authentication**: BCRYPT password hashing (`password_hash()`), PDO prepared statements to eliminate SQL Injection, and `session_regenerate_id()` protection.

---

## 🛠️ Required Technology Stack

| Layer | Technology Used |
|---|---|
| **Frontend Structure** | HTML5, CSS3, Bootstrap 5 |
| **Client-Side Logic** | Vanilla JavaScript |
| **Backend Logic** | PHP 8 (PDO) |
| **Database** | MySQL (XAMPP / WAMP) |
| **Version Control** | Git & GitHub |

---

## ⚡ How to Run the Project (XAMPP Setup Instructions)

1. **Install XAMPP** (with Apache and MySQL enabled).
2. **Clone / Extract Project**:
   Copy the project directory to `C:/xampp/htdocs/Kitchen-Notes-Mini-Project`.
3. **Database Import**:
   - Open browser and go to `http://localhost/phpmyadmin`.
   - Create a new database named `recipe_book`.
   - Click on the `Import` tab, select `database.sql` from the project folder, and click **Go**.
4. **Launch Application**:
   - Start Apache and MySQL in the XAMPP Control Panel.
   - Open your web browser and navigate to:  
     `http://localhost/Kitchen-Notes-Mini-Project/index.php`
