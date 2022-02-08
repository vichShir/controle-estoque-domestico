
CREATE TABLE usuario
(
	codusuario TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(30) NOT NULL,
	username VARCHAR(20) NOT NULL,
	senha VARCHAR(20) NOT NULL,
	PRIMARY KEY(codusuario)
);

CREATE TABLE item
(
	coditem INT UNSIGNED NOT NULL AUTO_INCREMENT,
	barcode CHAR(13) NULL,
	nome VARCHAR(50) NOT NULL,
	categoria VARCHAR(30) NULL,
	PRIMARY KEY(coditem)
);

CREATE TABLE local
(
	codlocal TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(20) NOT NULL,
	sublocal VARCHAR(20) NULL,
	PRIMARY KEY(codlocal)
);

CREATE TABLE compra
(
	codcompra INT UNSIGNED NOT NULL AUTO_INCREMENT,
	unidademedida VARCHAR(10) NOT NULL,
	quantidade DECIMAL(6,2) NOT NULL,
	dtcompra DATE NULL,
	dtvencimento DATE NULL,
	coditem INT UNSIGNED NOT NULL,
	codlocal TINYINT UNSIGNED NOT NULL,
	PRIMARY KEY(codcompra),
	FOREIGN KEY(coditem) REFERENCES item(coditem),
	FOREIGN KEY(codlocal) REFERENCES local(codlocal)
);

CREATE INDEX ix_compra_item
ON compra(coditem);

CREATE INDEX ix_compra_local
ON compra(codlocal);

SELECT * FROM usuario;
SELECT * FROM item;
SELECT * FROM local;
SELECT * FROM compra;

/*
DROP TABLE compra, local, item, usuario;
*/