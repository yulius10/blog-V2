create database blog;

create table blog(
  cod_blo int(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  cod_cat int(11) NOT NULL COMMENT 'codigo de categoria',
  tit_blo varchar(150) NOT NULL COMMENT 'titulo del blog',
  sub_blo varchar(150) NOT NULL COMMENT 'subtitulo del blog',
  ent_blo text NOT NULL COMMENT 'descripcion pequeña del blog',
  des_blo text NOT NULL COMMENT 'descripcion completa del blog',
  ima_blo varchar(150) NOT NULL COMMENT 'imagen del blog',
  tip_blo int(11) NOT NULL COMMENT 'tiene video o no',
  vid_blo varchar(150) NOT NULL COMMENT 'video del blog',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

create table categorias(
  cod_cat int(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  nom_cat varchar(150) NOT NULL COMMENT 'nombre de la categorias',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

create table label(
  cod_lab int(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  ref_tex_lab varchar(150) NOT NULL COMMENT 'referencia texto',
  tex_lab varchar(150) NOT NULL COMMENT 'texto',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

create table contactenos(
  cod_con int(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  nom_con varchar(150) NOT NULL COMMENT 'nombre',
  ape_con varchar(150) NOT NULL COMMENT 'apellido',
  cor_con varchar(150) NOT NULL COMMENT 'correo',
  asu_con varchar(150) NOT NULL COMMENT 'asunto',
  men_con text NOT NULL COMMENT 'mensaje',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

create table auditoria(
  idAuditoria INT(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  tra_aud INT(11) NOT NULL COMMENT 'Transaccion hecha',
  sql_aud TEXT NOT NULL COMMENT 'sql ejecutado',
  tab_aud VARCHAR(150) NOT NULL COMMENT 'tabla afectada',
  reg_afe_aud INT(11) NOT NULL COMMENT 'registro afectado',
  cli_aud text NOT NULL COMMENT 'auditoria del cliente',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

create table usuario(
  cod_usu int(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  nom_usu varchar(150) NOT NULL COMMENT 'nombre',
  ape_usu varchar(150) NOT NULL COMMENT 'apellido',
  cor_usu varchar(150) NOT NULL COMMENT 'correo',
  pas_usu varchar(150) NOT NULL COMMENT 'contraseña',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

CREATE TABLE modulo (
  idModulo INT(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  nom_mod VARCHAR(150) NOT NULL COMMENT 'nombre del modulo',
  rut_mod VARCHAR(150) NOT NULL COMMENT 'ruta del modulo',
  ico_mod VARCHAR(45) NOT NULL COMMENT 'icono del modulo',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

CREATE TABLE interfaz(
  idInterfaz INT(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  idModulo INT(11) NOT NULL COMMENT 'codigo del modulo al que pertenece',
  nom_int VARCHAR(150) NOT NULL COMMENT 'nombre de la interfaz',
  rut_con_int VARCHAR(150) NOT NULL COMMENT 'ruta del arvhivo de consulta de la interfaz',
  rut_edi_int VARCHAR(150) NOT NULL COMMENT 'ruta del archivo de edicion de la interfaz',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

CREATE TABLE galeria(
  idGaleria INT(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  idModulo INT(11) NOT NULL COMMENT 'codigo del modulo al que pertenece',
  idBlog INT(11) NOT NULL COMMENT 'codigo del blog al que pertenece',
  nom_gal VARCHAR(150) NOT NULL COMMENT 'nombre de la imagen',
  rut_con_gal VARCHAR(150) NOT NULL COMMENT 'ruta del arvhivo de consulta de la imagen',
  rut_edi_gal VARCHAR(150) NOT NULL COMMENT 'ruta del archivo de edicion de la imagen',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

CREATE TABLE archivos(
  idArchivos INT(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  idModulo INT(11) NOT NULL COMMENT 'codigo del modulo al que pertenece',
  idBlog INT(11) NOT NULL COMMENT 'codigo del blog al que pertenece',
  nom_arc VARCHAR(150) NOT NULL COMMENT 'nombre del archivo',
  rut_con_arc VARCHAR(150) NOT NULL COMMENT 'ruta del arvhivo',
  rut_edi_arc VARCHAR(150) NOT NULL COMMENT 'ruta para editar el archivo',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);

CREATE TABLE SEO(
  idCeo INT(11) NOT NULL primary key auto_increment COMMENT 'codigo unico',
  goo_ana_ceo text NOT NULL COMMENT 'Google analytics de la pagina',
  pal_cla_ceo VARCHAR(250) NOT NULL COMMENT 'Palabras clave de la pagina',
  des_ceo VARCHAR(150) NOT NULL COMMENT 'Descripcion de la pagina',
  fec_cre datetime NOT NULL COMMENT 'fecha de creacion',
  fec_mod datetime NOT NULL COMMENT 'fecha de modificacion',
  reg_eli int(11) NOT NULL COMMENT '1 eliminado 0 activo'
);


insert into SEO (goo_ana_ceo,pal_cla_ceo,des_ceo,fec_cre,reg_eli) values ('aaaa','aaaa','aaaa',curdate(),0);
insert into usuario (nom_usu,ape_usu,cor_usu,pas_usu,fec_cre,reg_eli) values ('Andres','Gomez','feligomez160@gmail.com','XG3C6fwmHnwASXwy0vwBXG3C6fwm',curdate(),0);