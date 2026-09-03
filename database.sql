-- Kitchen Notes Database Schema
CREATE DATABASE IF NOT EXISTS recipe_book DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE recipe_book;
-- 1. Users Table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) DEFAULT 'user',
  bio TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- 2. Recipes Table
CREATE TABLE IF NOT EXISTS recipes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(150) NOT NULL,
  category VARCHAR(50) NOT NULL,
  short_description TEXT NOT NULL,
  cook_time INT NOT NULL,
  servings INT NOT NULL,
  image VARCHAR(255) DEFAULT 'default_recipe.jpg',
  ingredients TEXT NOT NULL,
  instructions TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- 3. Messages Table (Contact Form)
CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,

created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Sample Seed Data (Default Admin/User & Sample Recipes)
INSERT INTO users (`id`, username, email, password, `bio`) VALUES
(1, 'Amalka Udayasiri', 'amalka@kitchennotes.com', '$2y$10$wE9/tLhQ5Uj.9Ld9pLgIuOqK.J0A/n/tA.P9FpG1gW1gZ8xX9vYmG', 'Home Cook · Passionate about healthy & traditional cuisine');
INSERT INTO recipes (`id`, user_id, title, category, short_description, cook_time, servings, image, ingredients, `instructions`) VALUES
(1, 1, 'Classic Creamy Pasta Carbonara', 'Italian', 'Rich and smooth traditional Italian pasta dish with pancetta and fresh parmesan.', 25, 4, 'pasta_carbonara.jpg', '["200g Spaghetti", "100g Pancetta or Bacon", "2 Large Eggs", "50g Pecorino Cheese", "Black Pepper & Salt"]', '["Boil pasta in salted water.", "Fry pancetta until crispy.", "Beat eggs with grated cheese.", "Combine hot pasta with egg mix off heat to make creamy sauce.", "Serve with extra pepper."]');