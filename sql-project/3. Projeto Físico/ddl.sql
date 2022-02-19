
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

CREATE TABLE categoria
(
	codcategoria TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(20) NOT NULL,
	PRIMARY KEY(codcategoria)
);

CREATE TABLE unidademedida
(
	codmedida TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(16) NOT NULL,
	PRIMARY KEY(codmedida)
);

CREATE TABLE item
(
	coditem INT UNSIGNED NOT NULL AUTO_INCREMENT,
	barcode CHAR(13) NULL,
	nome VARCHAR(30) NOT NULL,
	quantidade DECIMAL(6,2) NOT NULL,
	codlocal TINYINT UNSIGNED NOT NULL,
	codcategoria TINYINT UNSIGNED NOT NULL,
	codmedida TINYINT UNSIGNED NOT NULL,
	PRIMARY KEY(coditem),
	FOREIGN KEY(codlocal) REFERENCES local(codlocal),
	FOREIGN KEY(codcategoria) REFERENCES categoria(codcategoria),
	FOREIGN KEY(codmedida) REFERENCES unidademedida(codmedida)
);

CREATE INDEX ix_item_local
ON item(codlocal);

CREATE INDEX ix_item_categoria
ON item(codcategoria);

CREATE INDEX ix_item_medida
ON item(codmedida);

SELECT * FROM usuario;
SELECT * FROM local;
SELECT * FROM categoria;
SELECT * FROM unidademedida;
SELECT * FROM item;

/*
DROP TABLE item, unidademedida, categoria, local, usuario;
*/