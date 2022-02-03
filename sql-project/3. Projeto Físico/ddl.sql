
CREATE TABLE item
(
	coditem INT UNSIGNED NOT NULL AUTO_INCREMENT,
	barcode CHAR(13) NULL,
	nome VARCHAR(100) NOT NULL,
	PRIMARY KEY(coditem)
);

CREATE TABLE itemlocal
(
	coditemlocal INT UNSIGNED NOT NULL AUTO_INCREMENT,
	unidademedida VARCHAR(10) NOT NULL,
	quantidade DECIMAL(6, 2) NOT NULL,
	dtcompra DATE NULL,
	dtvencimento DATE NULL,
	coditem INT UNSIGNED NOT NULL,
	PRIMARY KEY(coditemlocal),
	FOREIGN KEY(coditem) REFERENCES item(coditem)
);

CREATE INDEX ix_itemlocal_item
ON itemlocal(coditem);

CREATE TABLE local
(
	codlocal INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nome VARCHAR(20) NOT NULL,
	sublocal VARCHAR(30) NULL,
	coditemlocal INT UNSIGNED NOT NULL,
	PRIMARY KEY(codlocal),
	FOREIGN KEY(coditemlocal) REFERENCES itemlocal(coditemlocal)
);

CREATE INDEX ix_local_itemlocal
ON local(coditemlocal);

SELECT * FROM item;
SELECT * FROM itemlocal;
SELECT * FROM local;

/*
DROP TABLE local, itemlocal, item
*/