<?php

function conectar(){
$host = 'localhost';
$username = 'root';
$password='mysql';

    try {
        $pdo = new PDO("mysql:host=$host", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function generarBaseDatos(){
    $pdo=conectar();
    $sql="CREATE DATABASE pedidos;

-- Usar la base de datos
USE pedidos;

-- Tabla 'Cafeterias'
CREATE TABLE Cafeterias (
    CodCafe INT PRIMARY KEY,
    Nombre VARCHAR(45),
    Ciudad VARCHAR(45)
);

-- Tabla 'Resultados'
CREATE TABLE Resultados (
    CodRes INT PRIMARY KEY,
    Fecha DATE,
    CodCafe INT,
    FOREIGN KEY (CodCafe) REFERENCES Cafeterias(CodCafe)
);

-- Tabla 'Categorias'
CREATE TABLE Categorias (
    CodCat INT PRIMARY KEY,
    Nombre VARCHAR(45),
    Descripcion VARCHAR(200)
);

-- Tabla 'Productos'
CREATE TABLE Productos (
    CodProd INT PRIMARY KEY,
    Nombre VARCHAR(45),
    Descripcion VARCHAR(200),
    Stock REAL,
    Precio INTEGER,
    CodCat INT,
    FOREIGN KEY (CodCat) REFERENCES Categorias(CodCat)
);

-- Tabla 'PedidosProductos'
CREATE TABLE PedidosProductos (
    CodPedidoProd INT PRIMARY KEY,
    CodRes INT,
    CodProd INT,
    Cantidad INTEGER,
    FOREIGN KEY (CodRes) REFERENCES Resultados(CodRes),
    FOREIGN KEY (CodProd) REFERENCES Productos(CodProd)
);";
    if($pdo->exec($sql)){
        echo "base de datos creada";
    }else{
        echo "no se ha creado la base de datos";
    }
}

?>