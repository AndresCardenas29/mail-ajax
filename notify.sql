CREATE TABLE usuarios (
    id INT  PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100),
    usuario VARCHAR(100),
    clave VARCHAR(100)
);


CREATE TABLE publicaciones (
  id INT  PRIMARY KEY NOT NULL AUTO_INCREMENT,
  titulo VARCHAR(100),
  texto VARCHAR(255)
);

CREATE TABLE notificaciones (
    id INT  PRIMARY KEY NOT NULL AUTO_INCREMENT,
    remitente INT,
    destinario INT,
    tipo INT,
    publicacion INT,
    estado INT,
    hora DATE
);

CREATE TABLE mensajes(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  	destinario VARCHAR(100),
  	remitente VARCHAR(100),
  	mensaje TEXT,
  	estado INT,
  	hora DATE
)
