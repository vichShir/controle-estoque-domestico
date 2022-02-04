
CREATE TABLE usuario
(
	codusuario INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(30) NOT NULL,
	username VARCHAR(20) NOT NULL,
	senha VARCHAR(20) NOT NULL,
	PRIMARY KEY(codusuario)
);

CREATE TABLE item
(
	coditem INT UNSIGNED NOT NULL AUTO_INCREMENT,
	barcode CHAR(13) NULL,
	nome VARCHAR(80) NOT NULL,
	PRIMARY KEY(coditem)
);

CREATE TABLE local
(
	codlocal INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(20) NOT NULL,
	sublocal VARCHAR(20) NULL,
	PRIMARY KEY(codlocal)
);

CREATE TABLE itemlocal
(
	coditemlocal INT UNSIGNED NOT NULL AUTO_INCREMENT,
	unidademedida VARCHAR(10) NOT NULL,
	quantidade DECIMAL(6,2) NOT NULL,
	dtcompra DATE NULL,
	dtvencimento DATE NULL,
	coditem INT UNSIGNED NOT NULL,
	codlocal INT UNSIGNED NOT NULL,
	PRIMARY KEY(coditemlocal),
	FOREIGN KEY(coditem) REFERENCES item(coditem),
	FOREIGN KEY(codlocal) REFERENCES local(codlocal)
);

CREATE INDEX ix_itemlocal_item
ON itemlocal(coditem);

CREATE INDEX ix_itemlocal_local
ON itemlocal(codlocal);

SELECT * FROM usuario;
SELECT * FROM item;
SELECT * FROM local;
SELECT * FROM itemlocal;

/*
DROP TABLE itemlocal, local, item, usuario;
*/