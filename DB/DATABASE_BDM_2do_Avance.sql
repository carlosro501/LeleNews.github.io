CREATE DATABASE IF NOT EXISTS PAPERNEWS;
USE PAPERNEWS;
CREATE TABLE IF NOT EXISTS USER_TYPES(
    `USER_TYPE_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla USER_TYPES",
    `TYPE` VARCHAR(200) NOT NULL COMMENT "Nombre del tipo de usuario",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha de creacion del registro",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (USER_TYPE_ID)
);


CREATE TABLE IF NOT EXISTS USERS (
    `USER_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla USERS",
    `EMAIL` VARCHAR(200) NOT NULL COMMENT "Correo principal, con el se accede al sitio",
    `PASS` VARCHAR(200) NOT NULL COMMENT "Contraseña para ingresar al sitio",
    `PROFILE_PIC` MEDIUMBLOB COMMENT "Foto de perfil del usuario",
    `USER_FULL_NAME` VARCHAR(200) COMMENT "Nombre completo del usuario",
    `USER_NAME` VARCHAR(100) COMMENT "Nombre de usuario",
    `PHONE` VARCHAR(15) COMMENT "Telefono del usuario",
    `STATUS` VARCHAR(3) DEFAULT 'A' COMMENT "Status del usuario",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha de creacion del registro",
     `USER_STATUS` VARCHAR(1) NOT NULL COMMENT "Valor del Status, A-ACTIVO, B-BLOQUEADO, I-INACTIVO",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    
    PRIMARY KEY (`USER_ID`),
	`USER_TYPE_ID` INT NOT NULL COMMENT "Llave primaria de la tabla USER_TYPES",
    FOREIGN KEY (`USER_TYPE_ID`) REFERENCES USER_TYPES(`USER_TYPE_ID`)
);

CREATE TABLE IF NOT EXISTS CATEGORIES(
    `CATEGORIES_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla NEWS_SECTION",
    `DESCRIPTION` VARCHAR(200) NOT NULL COMMENT "Nombre de la seccion",
    `COLOR` VARCHAR(100) NOT NULL COMMENT "Color de la seccion",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (`CATEGORIES_ID`)
);

CREATE TABLE IF NOT EXISTS COMMENTS(
    `COMMENT_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla COMMENTS",
    `COMMENT_TEXT` VARCHAR(200) NOT NULL COMMENT "Comentario realizado",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha de creacion del registro",
    `CREATED_BY` INT NOT NULL COMMENT "Usuario que dio de alta el registro",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (`COMMENT_ID`)
);



CREATE TABLE IF NOT EXISTS NEWS(
	`NEWS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla NEWS",
	`CATEGORIES_ID` INT NOT NULL COMMENT "Llave primaria de la tabla NEWS_CATEGORY",
	`SIGN` VARCHAR(100) NOT NULL COMMENT "Firma del reportero",
	`TITLE` VARCHAR(100) NOT NULL COMMENT "Titulo de la noticia",
	`DESCRIPTION` VARCHAR(300) NOT NULL COMMENT "Resumen de la noticia",
	`TEXT` VARCHAR(300) NOT NULL COMMENT "Informacion de la noticia",
	`CITY` VARCHAR(100) NOT NULL COMMENT "Ciudad de la noticia",
	`SUBURB` VARCHAR(100) NOT NULL COMMENT "Colonia de la noticia",
	`COUNTRY` VARCHAR(100) NOT NULL COMMENT "Pais de la noticia",
	`STATUS` VARCHAR(100) NOT NULL COMMENT "Estatus de la noticia",
    `KEY_WORDS` VARCHAR(300) NOT NULL COMMENT "Palabras claves para buscar la noticia",
    `LIKES` INT DEFAULT 0 COMMENT "Likes de las noticias",
    `DATE_OF_NEWS` DATETIME NOT NULL COMMENT "Fecha de publicacion",
    `DATE_OF_EVENTS` DATETIME NOT NULL COMMENT "Fecha en que ocurrio la noticia",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha en que se escribio la noticia",
    `CREATED_BY` INT NOT NULL COMMENT "Usuario que dio de alta el registro",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",
    PRIMARY KEY (`NEWS_ID`),
    FOREIGN KEY (`CATEGORIES_ID`) REFERENCES CATEGORIES(`CATEGORIES_ID`),
    FOREIGN KEY (`CREATED_BY`) REFERENCES USERS(`USER_ID`)
);

CREATE TABLE IF NOT EXISTS NEWS_COMENTS(
    `NEWS_COMENTS_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla NEWS_COMMENTS",
    `NEWS_ID` INT NOT NULL COMMENT "Llave primaria de la tabla NEWS",
    `PARENT_ID` INT COMMENT "Nos indica si otro ID de la tabla de NEWS_COMMENT se respondio con este mensaje",
    `CREATION_DATE` DATETIME NOT NULL COMMENT "Fecha de creacion del registro",
    `ACTIVE` BOOLEAN DEFAULT TRUE NOT NULL COMMENT "Indica si el registro esta activo en la base de datos",

    PRIMARY KEY (`NEWS_COMENTS_ID`) COMMENT "Llave primaria compuesta de 2 columnas",
    
    INDEX (`PARENT_ID`) COMMENT "Indice que optimiza la busqueda de esta columna",
	`COMMENT_ID` INT NOT NULL COMMENT "Llave primaria de la tabla COMMENTS",
    FOREIGN KEY (`COMMENT_ID`) REFERENCES COMMENTS(`COMMENT_ID`),
	FOREIGN KEY (`NEWS_ID`) REFERENCES NEWS(`NEWS_ID`)
);

CREATE TABLE IF NOT EXISTS MULTIMEDIA(
`MULTIMEDIA_ID` INT NOT NULL AUTO_INCREMENT COMMENT "Llave primaria de la tabla MULTIMEDIA",
`IMAGEN` BLOB NOT NULL COMMENT "Imagen de la noticia",
`VIDEO` BLOB COMMENT "Video de la noticia",

 PRIMARY KEY (`MULTIMEDIA_ID`) COMMENT "Llave primaria de la tabla multimedia",
 `NEWS_ID` INT NOT NULL COMMENT "Llave primaria de la tabla NEWS",
FOREIGN KEY (`NEWS_ID`) REFERENCES NEWS(`NEWS_ID`)
);

