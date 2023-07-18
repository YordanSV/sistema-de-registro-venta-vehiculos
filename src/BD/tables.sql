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

