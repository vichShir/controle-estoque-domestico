/*** POPULATE DATABASE ***/

/* Usuario */
INSERT INTO usuario(nome, username, senha) VALUES('Victor Shirasuna', 'vichShir', '5t6y7u8i');

/* Local */
INSERT INTO local(nome, sublocal) VALUES('Cozinha', 'Armazem');

/* Item */
INSERT INTO item(barcode, nome, categoria) VALUES(NULL, 'AGUA DE COCO CAIXA 1L KERO COCO', 'BEBIDAS');

/* Compra */
INSERT INTO compra(unidademedida, quantidade, dtcompra, dtvencimento, coditem, codlocal) VALUES('UNITARIO', 6, NULL, NULL, 1, 1);


/*** VIEWS ***/

/* Produtos */
CREATE VIEW VW_PRODUTOS
AS
SELECT l.nome LOCAL, l.sublocal SUBLOCAL, i.categoria CATEGORIA, i.barcode BARCODE, i.nome NOME, c.unidademedida UNIDADE_MEDIDA, c.quantidade QUANTIDADE, c.dtcompra DATA_COMPRA, c.dtvencimento VENCIMENTO
	FROM compra c INNER JOIN item i
		ON c.coditem = i.coditem
		INNER JOIN local l
		ON c.codlocal = l.codlocal;

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