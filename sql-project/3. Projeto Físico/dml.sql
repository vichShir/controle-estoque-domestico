/*** POPULATE DATABASE ***/

/* Usuario */
INSERT INTO usuario(nome, username, senha) VALUES('Victor Shirasuna', 'vichShir', '5t6y7u8i');

/* Local */
INSERT INTO local(nome, sublocal) VALUES('COZINHA', 'ARMAZEM');

/* Categoria */
INSERT INTO categoria(nome) VALUES('BEBIDAS');
INSERT INTO categoria(nome) VALUES('ENLATADOS');

/* Unidade Medida */
INSERT INTO unidademedida(nome) VALUES('UNITARIO');

/* Item */
INSERT INTO item(barcode, nome, quantidade, codlocal, codcategoria, codmedida) VALUES('7891103217975', 'AGUA DE COCO CAIXA 1L KERO COCO', 6, 1, 1, 1);
INSERT INTO item(barcode, nome, quantidade, codlocal, codcategoria, codmedida) VALUES('1112223334445', 'AGUA COM GAS CRYSTAL 1L', 3, 1, 1, 1);
INSERT INTO item(barcode, nome, quantidade, codlocal, codcategoria, codmedida) VALUES('1112223334446', 'ATUM ENTALADO', 2, 1, 2, 1);


/*** VIEWS ***/

/* Produtos */
CREATE VIEW VW_PRODUTOS
AS
SELECT l.nome LOCAL, l.sublocal SUBLOCAL, c.nome CATEGORIA, i.barcode BARCODE, i.nome NOME, u.nome UNIDADE_MEDIDA, i.quantidade QUANTIDADE
	FROM item i INNER JOIN local l
		ON i.codlocal = l.codlocal
		INNER JOIN categoria c
		ON i.codcategoria = c.codcategoria
		INNER JOIN unidademedida u
		ON i.codmedida = u.codmedida;

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