<?php
// Setup script to create database and tables

try {
    // Connect to MySQL without selecting database
    $pdo = new PDO('mysql:host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS dbactividades");

    // Select the database
    $pdo->exec("USE dbactividades");

    // Drop tables if they exist to avoid conflicts
    $pdo->exec("DROP TABLE IF EXISTS actividades");
    $pdo->exec("DROP TABLE IF EXISTS user");

    // Create user table
    $pdo->exec("
        CREATE TABLE user (
          id int(11) NOT NULL AUTO_INCREMENT,
          nombre varchar(100) NOT NULL,
          apellido varchar(100) NOT NULL,
          email varchar(150) NOT NULL,
          usuario varchar(50) NOT NULL,
          password varchar(255) NOT NULL,
          fecha_de_creacion timestamp NOT NULL DEFAULT current_timestamp(),
          fecha_de_actualizacion timestamp NOT NULL DEFAULT current_timestamp(),
          PRIMARY KEY (id),
          UNIQUE KEY email (email),
          UNIQUE KEY usuario (usuario)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");

    // Create actividades table
    $pdo->exec("
        CREATE TABLE actividades (
          id int(11) NOT NULL AUTO_INCREMENT,
          user_id int(11) NOT NULL,
          actividad varchar(500) NOT NULL,
          descripcion text NOT NULL,
          estado varchar(50) NOT NULL,
          tipo varchar(50) NOT NULL,
          fecha_de_creacion timestamp NOT NULL DEFAULT current_timestamp(),
          fecha_de_actualizacion timestamp NOT NULL DEFAULT current_timestamp(),
          PRIMARY KEY (id),
          KEY user_id (user_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    ");

    // Insert sample data
    $pdo->exec("
        INSERT INTO actividades (id, user_id, actividad, descripcion, estado, tipo, fecha_de_creacion, fecha_de_actualizacion) VALUES
        (2, 1, 'Revisión bibliográfica 2025', 'Investigación de fuentes teóricas y antecedentes relacionados.', 'En Progreso', 'Estudio', '2025-10-24 22:38:45', '2025-10-24 22:38:45'),
        (3, 1, 'Deberes de calculo 4', 'Deberes de calculo Completos wq', 'Pendiente', 'Estudio', '2025-10-24 23:31:19', '2025-10-24 23:31:19'),
        (4, 1, 'Deberes de calculo 6', 'Deberes de calculo Completos  Practica nueva ', 'Completada', 'Estudio', '2025-10-24 23:32:54', '2025-10-24 23:32:54'),
        (5, 1, 'Valdes Jokabeth', 'Estudiantes del curso de 3a Materia Programación Web Y Diseño', 'Pendiente', 'Trabajo', '2025-10-24 23:34:34', '2025-10-24 23:34:34'),
        (6, 1, 'Valdes Jokabeth2', 'Estudiantes del curso de 3a Materia Programación Web Y Diseño', 'En Progreso', 'Trabajo', '2025-10-24 23:58:56', '2025-10-24 23:58:56'),
        (7, 1, 'Deberes de calculo 6', 'Deberes de calculo Completos wq', 'Pendiente', 'Estudio', '2025-10-24 23:59:24', '2025-10-24 23:59:24')
    ");

    echo "Database and tables created successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
