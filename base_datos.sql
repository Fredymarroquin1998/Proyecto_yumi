//primero crear base de datos yumi
CREATE TABLE usuarios (
	id_usuario varchar(20) PRIMARY KEY NOT NULL,
	correo varchar(50) UNIQUE NOT NULL,
	nombre_usuario varchar(50) NOT NULL,
	apellido_usuario varchar(50) NOT NULL,
	contrasena varchar(25) NOT NULL,
	descripcion varchar(200),
	foto_perfil blob,
	foto_portada blob
);

CREATE TABLE recetas (
	id_receta int PRIMARY KEY,
	id_usuario varchar(30),
	nombre_receta varchar(50),
	descripcion varchar(200),
	tipo int,
	ingredientes text,
	calificacion int,
	complejidad int,
	cantidad_personas int,
	imagen blob,
	elaboracion text,
	costo double,
	tiempo int,
	calorias int,
	FOREIGN KEY(id_usuario) REFERENCES USUARIOS(id_usuario) 
);

CREATE TABLE preferencias (
	id_usuario varchar(50),
	id_receta int,
	FOREIGN KEY(id_usuario) REFERENCES USUARIOS(id_usuario),
	FOREIGN KEY(id_receta) REFERENCES RECETAS(id_receta)
);

CREATE TABLE correlativo (
	id int;
);