/*** POPULATE DATABASE ***/

/* Usuario */
INSERT INTO usuario(nome, username, senha) VALUES('Victor Shirasuna', 'vichShir', '5t6y7u8i');

/* Local */
INSERT INTO local(nome, sublocal) VALUES('Cozinha', 'Armazem');

/* Item */
INSERT INTO item(barcode, nome, categoria, unidademedida, quantidade, codlocal) VALUES('7891103217975', 'AGUA DE COCO CAIXA 1L KERO COCO', 'BEBIDAS', 'UNITARIO', 6, 1);
INSERT INTO item(barcode, nome, categoria, unidademedida, quantidade, codlocal) VALUES('1112223334445', 'AGUA COM GAS CRYSTAL 1L', 'BEBIDAS', 'UNITARIO', 3, 1);


/*** VIEWS ***/

/* Produtos */
CREATE VIEW VW_PRODUTOS
AS
SELECT l.nome LOCAL, l.sublocal SUBLOCAL, i.categoria CATEGORIA, i.barcode BARCODE, i.nome NOME, i.unidademedida UNIDADE_MEDIDA, i.quantidade QUANTIDADE
	FROM local l INNER JOIN item i
		ON l.codlocal = i.codlocal;

/* Usuarios */
CREATE VIEW VW_USERS
AS
SELECT username, nome FROM usuario;

/*
DROP VIEW VW_USERS, VW_PRODUTOS;
*/


/*** SELECT ***/
SELECT * FROM VW_PRODUTOS;
SELECT * FROM VW_USERS;