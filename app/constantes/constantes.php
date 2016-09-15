<?php

//Constantes tipo de usuarios

define('TIPO_USER_ROOT', 'TU01');
define('TIPO_USER_ADMIN', 'TU02');
define('TIPO_USER_PROFESOR', 'TU03');
define('TIPO_USER_ESTUDIANTE', 'TU04');
define('TIPO_USER_ALMACENISTA', 'TU05');
define('TIPO_USER_SUPERVISOR', 'TU06');


//Comentado los permisos
//Constantes tipo de usuarios

define('PERMISO_CREAR_USUARIO', 'TPCU1');
define('PERMISO_MODIFICAR_USUARIO', 'TPMU2');
define('PERMISO_ELIMINAR_USUARIO', 'TPEU3');
define('PERMISO_CREAR_INVENTARIO', 'TPCI1');
define('PERMISO_MODIFICAR_INVENTARIO', 'TPMI2');
define('PERMISO_REGISTRAR_OBJETO', 'TPRO1');
define('PERMISO_MODIFICR_OBJETO', 'TPMO2');
define('PERMISO_ELIMINAR_OBJETO', 'TPEO3');
define('PERMISO_REGISTRAR_ELEMENTO', 'TPRE1');
define('PERMISO_MODIFICAR_ELEMENTO', 'TPME2');
define('PERMISO_ELIMINAR_ELEMENTO', 'TPME3');
define('PERMISO_REGISTRAR_CATALOGO', 'TPRC1');
define('PERMISO_MODIFICAR_CATALOGO', 'TPMC2');
define('PERMISO_ELIMINAR_CATALOGO', 'TPEC3');
define('PERMISO_REGISTRAR_ALMACEN', 'TPRA1');
define('PERMISO_MODIFICAR_ALMACEN', 'TPMA2');
define('PERMISO_ELIMINAR_ALMACEN', 'TPEA3');
define('PERMISO_REGISTRAR_LABORATORIO', 'TPRL1');
define('PERMISO_MODIFICAR_LABORATORIO', 'TPRL2');
define('PERMISO_ELIMINAR_LABORATORIO', 'TPRL3');

//Permisos Genericos

define('PERMISO_GENERICO_USUARIO', 'TPGU1');
define('PERMISO_GENERICO_CATALOGO', 'TPGC2');
define('PERMISO_GENERICO_INVENTARIO', 'TPGI3');
define('PERMISO_GENERICO_LABORATORIO', 'TPGL3');

//sexo

define('SEXO_MASCULINO', 10);
define('SEXO_FEMENINO', 20);

/// PATH
define('PATH_UPLOADS', '/uploads/');
define('PATH_IMAGENES', PATH_UPLOADS . 'imagenes/');
define('PATH_ARCHIVOS', PATH_UPLOADS . 'archivos/');
define('PATH_ARCHIVOS_CORREO', PATH_ARCHIVOS . 'correo/');
define('PATH_AVATAR_MASCULINO', '/img/masculino.jpg');
define('PATH_AVATAR_FEMENINO', '/img/femenino.jpg');
define('PATH_NO_AVATAR', '/img/no-avatar.png');
define('PATH_ARCHIVOS_SQL', app_path() . "/database/archivos_sql");


//NOMENCLATURAS

define('CODIGO_TIPO_USUARIO', 'TU');
define('CODIGO_PERMISO', 'PU');
define('CODIGO_ALMACEN', 'AL');
define('CODIGO_LABORATORIO', 'LA');
//define('CODIGO_AGRUPACION','');
define('CODIGO_PROVEEDORES', 'PRV');


//Tipos de moviemientos
const MOV01 = ['id' => 1, 'descripcion' => 'ENTRADA POR PROVEEDOR'];
const MOV02 = ['id' => 2, 'descripcion' => 'ENTRADA POR DONACON'];
const MOV03 = ['id' => 3, 'descripcion' => 'SALIDA POR PEDIDO'];
const MOV04 = ['id' => 4, 'descripcion' => 'SALIDA POR PERDIDA'];
const MOV05 = ['id' => 5, 'descripcion' => 'SALIDA DESCONOCIDA'];
const MOV06 = ['id' => 6, 'descripcion' => 'RETENIDO STOCK'];
const MOV07 = ['id' => 7, 'descripcion' => 'RETENIDO POR PEDIDO'];


//Condiciones para ordenes
define('ACTIVA', 'C01');
define('ACTIVO', 'C01');

define('PENDIENTE', 'C02');

define('CANCELADA', 'C03');
define('CANCELADO', 'C03');

define('COMPLETADA', 'C04');
define('COMPLETADO', 'C04');

define('DISPONIBLE', 'C05');
define('NO_DISPONIBLE', 'C06');

define('RETENIDA', 'C07');
define('RETENIDO', 'C07');

define('EN_ESPERA', 'C08');


//clase de objetos
define('REACTIVO', 1);
define('INSTRUMENTO', 2);
define('EQUIPO', 3);


