Use mysql;
#select Database();


DROP TABLE VehiculoXpropietario;
DROP TABLE ImagenesXauto;
DROP TABLE Vehiculo;
DROP TABLE Propietario;
DROP TABLE Usuario;


CREATE TABLE Propietario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(255),
  direccion VARCHAR(255),
  telefono VARCHAR(15)
);

CREATE TABLE Vehiculo (
  id INT PRIMARY KEY AUTO_INCREMENT,
  placa VARCHAR(10),
  num_motor VARCHAR(50),
  anio INT,
  marca VARCHAR(50),
  modelo VARCHAR(50),
  precio DECIMAL(10, 2),
  kilometraje DECIMAL(10, 2),
  cilindraje INT,
  transmision VARCHAR(50),
  combustible VARCHAR(50),
  color_exterior VARCHAR(50),
  color_interior VARCHAR(50),
  fecha_registro DATE
);

CREATE TABLE Usuario (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre_usuario VARCHAR(50) UNIQUE,
  contrasena VARCHAR(255),
  tipo_usuario ENUM('Administrador', 'Cliente')
);

CREATE TABLE ImagenesXauto (
  id INT PRIMARY KEY AUTO_INCREMENT,
  vehiculo_id INT,
  url VARCHAR(255),
  FOREIGN KEY (vehiculo_id) REFERENCES Vehiculo(id)
);

CREATE TABLE VehiculoXpropietario (
  vehiculo_id INT,
  propietario_id INT,
  PRIMARY KEY (vehiculo_id, propietario_id),
  FOREIGN KEY (vehiculo_id) REFERENCES Vehiculo(id),
  FOREIGN KEY (propietario_id) REFERENCES Propietario(id)
);


SHOW PROCEDURE STATUS;
DROP PROCEDURE IF EXISTS CrearPropietario;
DROP PROCEDURE IF EXISTS CrearUsuario;
DROP PROCEDURE IF EXISTS CrearVehiculo;
DROP PROCEDURE IF EXISTS ObtenerVehiculosFiltrados;

#Procedimientos almacenados
DELIMITER $$

#--------------------CrearUsuario----------------------------
CREATE PROCEDURE CrearUsuario(
  IN p_nombre VARCHAR(50),
  IN p_contrasena VARCHAR(255),
  IN p_tipo ENUM('Administrador', 'Cliente')
)
BEGIN
  INSERT INTO USUARIO (nombre_usuario, contrasena, tipo)
  VALUES (p_nombre, p_contrasena, p_tipo);
END$$

#--------------------CrearPropietario----------------------------
CREATE PROCEDURE CrearPropietario(
  IN p_nombre VARCHAR(255),
  IN p_direccion VARCHAR(255),
  IN p_telefono VARCHAR(15)
)
BEGIN
  INSERT INTO PROPIETARIO (nombre, direccion, telefono)
  VALUES (p_nombre, p_direccion, p_telefono);
END$$



#--------------------CrearVehiculo----------------------------
CREATE PROCEDURE CrearVehiculo(
  IN p_placa VARCHAR(10),
  IN p_num_motor VARCHAR(50),
  IN p_anio INT,
  IN p_marca VARCHAR(50),
  IN p_modelo VARCHAR(50),
  IN p_precio DECIMAL(10, 2),
  IN p_kilometraje DECIMAL(10, 2),
  IN p_cilindraje INT,
  IN p_transmision VARCHAR(50),
  IN p_combustible VARCHAR(50),
  IN p_color_exterior VARCHAR(50),
  IN p_color_interior VARCHAR(50),
  IN p_fecha_registro DATE
)
BEGIN
  INSERT INTO VEHICULOS (placa, num_motor, anio, marca, modelo, precio, kilometraje, cilindraje, transmision, combustible, color_exterior, color_interior, fecha_registro)
  VALUES (p_placa, p_num_motor, p_anio, p_marca, p_modelo, p_precio, p_kilometraje, p_cilindraje, p_transmision, p_combustible, p_color_exterior, p_color_interior, p_fecha_registro);
END$$


#--------------------ObtenerVehiculosFiltrados----------------------------
CREATE PROCEDURE ObtenerVehiculosFiltrados(
  IN p_marca VARCHAR(50),
  IN p_modelo VARCHAR(50),
  IN p_transmision VARCHAR(50),
  IN p_combustible VARCHAR(50),
  IN p_precio_min DECIMAL(10, 2),
  IN p_precio_max DECIMAL(10, 2),
  IN p_anio_min INT,
  IN p_anio_max INT
)
BEGIN
  SELECT *
  FROM Vehiculos
  WHERE (p_marca IS NULL OR marca = p_marca)
    AND (p_modelo IS NULL OR modelo = p_modelo)
    AND (p_transmision IS NULL OR transmision = p_transmision)
    AND (p_combustible IS NULL OR combustible = p_combustible)
    AND (p_precio_min IS NULL OR precio >= p_precio_min)
    AND (p_precio_max IS NULL OR precio <= p_precio_max)
    AND (p_anio_min IS NULL OR anio >= p_anio_min)
    AND (p_anio_max IS NULL OR anio <= p_anio_max);
END$$

DELIMITER ;
