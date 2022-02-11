
CREATE TABLE usuario
(
	codusuario TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(30) NOT NULL,
	username VARCHAR(20) NOT NULL,
	senha VARCHAR(20) NOT NULL,
	PRIMARY KEY(codusuario)
);

CREATE TABLE local
(
	codlocal TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(20) NOT NULL,
	sublocal VARCHAR(20) NULL,
	PRIMARY KEY(codlocal)
);

CREATE TABLE item
(
	coditem INT UNSIGNED NOT NULL AUTO_INCREMENT,
	barcode CHAR(13) NULL,
	nome VARCHAR(50) NOT NULL,
	categoria VARCHAR(30) NULL,
	unidademedida VARCHAR(10) NOT NULL,
	quantidade DECIMAL(6,2) NOT NULL,
	codlocal TINYINT UNSIGNED NOT NULL,
	PRIMARY KEY(coditem),
	FOREIGN KEY(codlocal) REFERENCES local(codlocal)
);

CREATE INDEX ix_item_local
ON item(codlocal);

SELECT * FROM usuario;
SELECT * FROM local;
SELECT * FROM item;

/*
DROP TABLE item, local, usuario;
*/