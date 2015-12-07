<?php


class ElementosQuimicosTableSeeder extends Seeder {

    public function run()
    {
       DB::table('elementos_quimicos')->delete();

        $campos = array(array( "periodo"=>'1', "grupo_cas"=>'IA', "simbolo"=>'H', "grupo_iupac"=>'0', 
		"numero_atomico"=>'1', "nombre"=>'Hidrógeno', "peso_atomico"=>'1.00797', "valencia"=>'1', "temp_ebullicion"=>'20.28', "temp_fusion"=>'14.01',
		"bloque"=> 'S', "cod_estado"=>'1', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'201',
		"config_electronica"=> '1s1', "electronegatividad"=>'2.1', "densidad"=>'0.0899
',"created_at"=>'2015-12-07 13:02:32.969494',"updated_at"=>'2015-12-07 13:02:32.969502'),array( "periodo"=>'1', "grupo_cas"=>'VIIIA', "simbolo"=>'He', "grupo_iupac"=>'0', 
		"numero_atomico"=>'2', "nombre"=>'Helio', "peso_atomico"=>'4.0026', "valencia"=>'2', "temp_ebullicion"=>'4.22', "temp_fusion"=>'0.0',
		"bloque"=> 'S', "cod_estado"=>'1', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'203',
		"config_electronica"=> '1s2', "electronegatividad"=>'0.0', "densidad"=>'0.1785
',"created_at"=>'2015-12-07 13:02:32.969523',"updated_at"=>'2015-12-07 13:02:32.969531'),array( "periodo"=>'2', "grupo_cas"=>'IA', "simbolo"=>'Li', "grupo_iupac"=>'0', 
		"numero_atomico"=>'3', "nombre"=>'Litio', "peso_atomico"=>'6.94', "valencia"=>'2,1', "temp_ebullicion"=>'1615', "temp_fusion"=>'453.69',
		"bloque"=> 'S', "cod_estado"=>'2', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'101',
		"config_electronica"=> '1s2 2s1', "electronegatividad"=>'0.98', "densidad"=>'535
',"created_at"=>'2015-12-07 13:02:32.969551',"updated_at"=>'2015-12-07 13:02:32.969558'),array( "periodo"=>'2', "grupo_cas"=>'IIA', "simbolo"=>'Be', "grupo_iupac"=>'0', 
		"numero_atomico"=>'4', "nombre"=>'Berilio', "peso_atomico"=>'9.0121831', "valencia"=>'2,2', "temp_ebullicion"=>'2743', "temp_fusion"=>'1560',
		"bloque"=> 'S', "cod_estado"=>'3', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'102',
		"config_electronica"=> '1s2 2s2', "electronegatividad"=>'1.5', "densidad"=>'1848
',"created_at"=>'2015-12-07 13:02:32.969577',"updated_at"=>'2015-12-07 13:02:32.969584'),array( "periodo"=>'2', "grupo_cas"=>'IIIA', "simbolo"=>'B', "grupo_iupac"=>'0', 
		"numero_atomico"=>'5', "nombre"=>'Boro', "peso_atomico"=>'10.81', "valencia"=>'2,3', "temp_ebullicion"=>'4273', "temp_fusion"=>'2348',
		"bloque"=> 'P', "cod_estado"=>'2', "cod_clasificacion"=>'30', "cod_subclasificacion"=>'400',
		"config_electronica"=> '1s2 2s2 2p1', "electronegatividad"=>'2', "densidad"=>'2460
',"created_at"=>'2015-12-07 13:02:32.969604',"updated_at"=>'2015-12-07 13:02:32.969611'),array( "periodo"=>'2', "grupo_cas"=>'IVA', "simbolo"=>'C', "grupo_iupac"=>'0', 
		"numero_atomico"=>'6', "nombre"=>'Carbono', "peso_atomico"=>'12011', "valencia"=>'2,4', "temp_ebullicion"=>'4300', "temp_fusion"=>'3823',
		"bloque"=> 'P', "cod_estado"=>'2', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'202',
		"config_electronica"=> '1s2 2s2 2p2', "electronegatividad"=>'2.5', "densidad"=>'2260
',"created_at"=>'2015-12-07 13:02:32.969630',"updated_at"=>'2015-12-07 13:02:32.969637'),array( "periodo"=>'2', "grupo_cas"=>'VA', "simbolo"=>'N', "grupo_iupac"=>'0', 
		"numero_atomico"=>'7', "nombre"=>'Nitrógeno', "peso_atomico"=>'14007', "valencia"=>'2,5', "temp_ebullicion"=>'77.36', "temp_fusion"=>'63.05',
		"bloque"=> 'P', "cod_estado"=>'1', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'202',
		"config_electronica"=> '1s2 2s2 2p3', "electronegatividad"=>'3', "densidad"=>'1251
',"created_at"=>'2015-12-07 13:02:32.969656',"updated_at"=>'2015-12-07 13:02:32.969662'),array( "periodo"=>'2', "grupo_cas"=>'VIA', "simbolo"=>'O', "grupo_iupac"=>'0', 
		"numero_atomico"=>'8', "nombre"=>'Oxígeno', "peso_atomico"=>'15999', "valencia"=>'2,6', "temp_ebullicion"=>'90.2', "temp_fusion"=>'54.8',
		"bloque"=> 'P', "cod_estado"=>'4', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'202',
		"config_electronica"=> '1s2 2s2 2p4', "electronegatividad"=>'3.5', "densidad"=>'1429
',"created_at"=>'2015-12-07 13:02:32.969681',"updated_at"=>'2015-12-07 13:02:32.969688'),array( "periodo"=>'2', "grupo_cas"=>'VIIA', "simbolo"=>'F', "grupo_iupac"=>'0', 
		"numero_atomico"=>'9', "nombre"=>'Flúor', "peso_atomico"=>'18.998403163', "valencia"=>'2,7', "temp_ebullicion"=>'85.03', "temp_fusion"=>'53.5',
		"bloque"=> 'P', "cod_estado"=>'5', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'201',
		"config_electronica"=> '1s2 2s2 2p5', "electronegatividad"=>'4', "densidad"=>'1696
',"created_at"=>'2015-12-07 13:02:32.969709',"updated_at"=>'2015-12-07 13:02:32.969716'),array( "periodo"=>'2', "grupo_cas"=>'VIIIA', "simbolo"=>'Ne', "grupo_iupac"=>'0', 
		"numero_atomico"=>'10', "nombre"=>'Neón', "peso_atomico"=>'20.1797', "valencia"=>'2,8', "temp_ebullicion"=>'27.07', "temp_fusion"=>'24.56',
		"bloque"=> 'P', "cod_estado"=>'1', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'203',
		"config_electronica"=> '1s2 2s2 2p6', "electronegatividad"=>'0.0', "densidad"=>'0.9
',"created_at"=>'2015-12-07 13:02:32.969737',"updated_at"=>'2015-12-07 13:02:32.969745'),array( "periodo"=>'3', "grupo_cas"=>'IA', "simbolo"=>'Na', "grupo_iupac"=>'0', 
		"numero_atomico"=>'11', "nombre"=>'Sodio', "peso_atomico"=>'22.98976928', "valencia"=>'2,8,1', "temp_ebullicion"=>'1156', "temp_fusion"=>'370.87',
		"bloque"=> 'S', "cod_estado"=>'2', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'101',
		"config_electronica"=> '1s2 2s2 2p6 3s1', "electronegatividad"=>'0.93', "densidad"=>'968
',"created_at"=>'2015-12-07 13:02:32.969766',"updated_at"=>'2015-12-07 13:02:32.969773'),array( "periodo"=>'3', "grupo_cas"=>'IIA', "simbolo"=>'Mg', "grupo_iupac"=>'0', 
		"numero_atomico"=>'12', "nombre"=>'Magnesio', "peso_atomico"=>'24305', "valencia"=>'2,8,2', "temp_ebullicion"=>'1363', "temp_fusion"=>'923',
		"bloque"=> 'S', "cod_estado"=>'6', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'102',
		"config_electronica"=> '1s2 2s2 2p6 3s2', "electronegatividad"=>'1.31', "densidad"=>'1738
',"created_at"=>'2015-12-07 13:02:32.969792',"updated_at"=>'2015-12-07 13:02:32.969799'),array( "periodo"=>'3', "grupo_cas"=>'IIIA', "simbolo"=>'Al', "grupo_iupac"=>'0', 
		"numero_atomico"=>'13', "nombre"=>'Aluminio', "peso_atomico"=>'26.9815385', "valencia"=>'2,8,3', "temp_ebullicion"=>'2792', "temp_fusion"=>'933.47',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p1', "electronegatividad"=>'1.61', "densidad"=>'2700
',"created_at"=>'2015-12-07 13:02:32.969818',"updated_at"=>'2015-12-07 13:02:32.969825'),array( "periodo"=>'3', "grupo_cas"=>'IVA', "simbolo"=>'Si', "grupo_iupac"=>'0', 
		"numero_atomico"=>'14', "nombre"=>'Silicio', "peso_atomico"=>'28085', "valencia"=>'2,8,4', "temp_ebullicion"=>'3173', "temp_fusion"=>'1687',
		"bloque"=> 'P', "cod_estado"=>'2', "cod_clasificacion"=>'30', "cod_subclasificacion"=>'400',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p2', "electronegatividad"=>'1.9', "densidad"=>'2330
',"created_at"=>'2015-12-07 13:02:32.969847',"updated_at"=>'2015-12-07 13:02:32.969854'),array( "periodo"=>'3', "grupo_cas"=>'VA', "simbolo"=>'P', "grupo_iupac"=>'0', 
		"numero_atomico"=>'15', "nombre"=>'Fósforo', "peso_atomico"=>'30.973761998', "valencia"=>'2,8,5', "temp_ebullicion"=>'1040', "temp_fusion"=>'594.22',
		"bloque"=> 'P', "cod_estado"=>'3', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'202',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p3', "electronegatividad"=>'2', "densidad"=>'13534
',"created_at"=>'2015-12-07 13:02:32.969874',"updated_at"=>'2015-12-07 13:02:32.969881'),array( "periodo"=>'3', "grupo_cas"=>'VIA', "simbolo"=>'S', "grupo_iupac"=>'0', 
		"numero_atomico"=>'16', "nombre"=>'Azufre', "peso_atomico"=>'32.06', "valencia"=>'2,8,6', "temp_ebullicion"=>'717.87', "temp_fusion"=>'388.36',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'202',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p4', "electronegatividad"=>'2.58', "densidad"=>'1960
',"created_at"=>'2015-12-07 13:02:32.969900',"updated_at"=>'2015-12-07 13:02:32.969907'),array( "periodo"=>'3', "grupo_cas"=>'VIIA', "simbolo"=>'Cl', "grupo_iupac"=>'0', 
		"numero_atomico"=>'17', "nombre"=>'Cloro', "peso_atomico"=>'35.45', "valencia"=>'2,8,7', "temp_ebullicion"=>'239.11', "temp_fusion"=>'171.6',
		"bloque"=> 'P', "cod_estado"=>'5', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'201',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p5', "electronegatividad"=>'3.16', "densidad"=>'3214
',"created_at"=>'2015-12-07 13:02:32.969927',"updated_at"=>'2015-12-07 13:02:32.969934'),array( "periodo"=>'3', "grupo_cas"=>'VIIIA', "simbolo"=>'Ar', "grupo_iupac"=>'0', 
		"numero_atomico"=>'18', "nombre"=>'Argón', "peso_atomico"=>'39948', "valencia"=>'2,8,8', "temp_ebullicion"=>'87.3', "temp_fusion"=>'83.8',
		"bloque"=> 'P', "cod_estado"=>'1', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'203',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6', "electronegatividad"=>'0.0', "densidad"=>'1784
',"created_at"=>'2015-12-07 13:02:32.969963',"updated_at"=>'2015-12-07 13:02:32.969971'),array( "periodo"=>'4', "grupo_cas"=>'IA', "simbolo"=>'K', "grupo_iupac"=>'0', 
		"numero_atomico"=>'19', "nombre"=>'Potasio', "peso_atomico"=>'39.0983', "valencia"=>'2,8,8,1', "temp_ebullicion"=>'1032', "temp_fusion"=>'336.53',
		"bloque"=> 'S', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'101',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s1', "electronegatividad"=>'0.82', "densidad"=>'856
',"created_at"=>'2015-12-07 13:02:32.969991',"updated_at"=>'2015-12-07 13:02:32.969998'),array( "periodo"=>'4', "grupo_cas"=>'IIA', "simbolo"=>'Ca', "grupo_iupac"=>'0', 
		"numero_atomico"=>'20', "nombre"=>'Calcio', "peso_atomico"=>'40078', "valencia"=>'2,8,8,2', "temp_ebullicion"=>'1757', "temp_fusion"=>'1115',
		"bloque"=> 'S', "cod_estado"=>'6', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'102',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2', "electronegatividad"=>'1', "densidad"=>'1550
',"created_at"=>'2015-12-07 13:02:32.970017',"updated_at"=>'2015-12-07 13:02:32.970024'),array( "periodo"=>'4', "grupo_cas"=>'IIIB', "simbolo"=>'Sc', "grupo_iupac"=>'0', 
		"numero_atomico"=>'21', "nombre"=>'Escandio', "peso_atomico"=>'44.955908', "valencia"=>'2,8,9,2', "temp_ebullicion"=>'3103', "temp_fusion"=>'1814',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d1', "electronegatividad"=>'1.36', "densidad"=>'2985
',"created_at"=>'2015-12-07 13:02:32.970042',"updated_at"=>'2015-12-07 13:02:32.970049'),array( "periodo"=>'4', "grupo_cas"=>'IVB', "simbolo"=>'Ti', "grupo_iupac"=>'0', 
		"numero_atomico"=>'22', "nombre"=>'Titanio', "peso_atomico"=>'47867', "valencia"=>'2,8,10,2', "temp_ebullicion"=>'3560', "temp_fusion"=>'1941',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d2', "electronegatividad"=>'1.54', "densidad"=>'4507
',"created_at"=>'2015-12-07 13:02:32.970068',"updated_at"=>'2015-12-07 13:02:32.970075'),array( "periodo"=>'4', "grupo_cas"=>'VB', "simbolo"=>'V', "grupo_iupac"=>'0', 
		"numero_atomico"=>'23', "nombre"=>'Vanadio', "peso_atomico"=>'50.9415', "valencia"=>'2,8,11,2', "temp_ebullicion"=>'3680', "temp_fusion"=>'2183',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d3', "electronegatividad"=>'1.63', "densidad"=>'6110
',"created_at"=>'2015-12-07 13:02:32.970094',"updated_at"=>'2015-12-07 13:02:32.970101'),array( "periodo"=>'4', "grupo_cas"=>'VIB', "simbolo"=>'Cr', "grupo_iupac"=>'0', 
		"numero_atomico"=>'24', "nombre"=>'Cromo', "peso_atomico"=>'51.9961', "valencia"=>'2,8,13,1', "temp_ebullicion"=>'2944', "temp_fusion"=>'2180',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s1 3d5', "electronegatividad"=>'1.66', "densidad"=>'7140
',"created_at"=>'2015-12-07 13:02:32.970119',"updated_at"=>'2015-12-07 13:02:32.970126'),array( "periodo"=>'4', "grupo_cas"=>'VIIB', "simbolo"=>'Mn', "grupo_iupac"=>'0', 
		"numero_atomico"=>'25', "nombre"=>'Maganeso', "peso_atomico"=>'54.938044', "valencia"=>'2,8,13,2', "temp_ebullicion"=>'2334', "temp_fusion"=>'1519',
		"bloque"=> 'D', "cod_estado"=>'2', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d5', "electronegatividad"=>'1.69', "densidad"=>'8650
',"created_at"=>'2015-12-07 13:02:32.970144',"updated_at"=>'2015-12-07 13:02:32.970152'),array( "periodo"=>'4', "grupo_cas"=>'VIIIB', "simbolo"=>'Fe', "grupo_iupac"=>'0', 
		"numero_atomico"=>'26', "nombre"=>'Hierro', "peso_atomico"=>'55845', "valencia"=>'2,8,14,2', "temp_ebullicion"=>'3134', "temp_fusion"=>'1811',
		"bloque"=> 'D', "cod_estado"=>'8', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s1 2s2 2p6 3s2 3p6 4s2 3d6', "electronegatividad"=>'1.83', "densidad"=>'7874
',"created_at"=>'2015-12-07 13:02:32.970174',"updated_at"=>'2015-12-07 13:02:32.970181'),array( "periodo"=>'4', "grupo_cas"=>'VIIIB', "simbolo"=>'Co', "grupo_iupac"=>'0', 
		"numero_atomico"=>'27', "nombre"=>'Cobalto', "peso_atomico"=>'58.933194', "valencia"=>'2,8,15,2', "temp_ebullicion"=>'3200', "temp_fusion"=>'1768',
		"bloque"=> 'D', "cod_estado"=>'8', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s1 2s2 2p6 3s2 3p6 4s2 3d7', "electronegatividad"=>'1.88', "densidad"=>'8900
',"created_at"=>'2015-12-07 13:02:32.970201',"updated_at"=>'2015-12-07 13:02:32.970208'),array( "periodo"=>'4', "grupo_cas"=>'VIIIB', "simbolo"=>'Ni', "grupo_iupac"=>'0', 
		"numero_atomico"=>'28', "nombre"=>'Níquel', "peso_atomico"=>'58.6934', "valencia"=>'2,8,16,2', "temp_ebullicion"=>'3186', "temp_fusion"=>'1728',
		"bloque"=> 'D', "cod_estado"=>'8', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d8', "electronegatividad"=>'1.91', "densidad"=>'8908
',"created_at"=>'2015-12-07 13:02:32.970226',"updated_at"=>'2015-12-07 13:02:32.970233'),array( "periodo"=>'4', "grupo_cas"=>'IB', "simbolo"=>'Cu', "grupo_iupac"=>'0', 
		"numero_atomico"=>'29', "nombre"=>'Cobre', "peso_atomico"=>'63546', "valencia"=>'2,8,18,1', "temp_ebullicion"=>'3200', "temp_fusion"=>'1357.77',
		"bloque"=> 'D', "cod_estado"=>'2', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s1 3d10', "electronegatividad"=>'1.9', "densidad"=>'8920
',"created_at"=>'2015-12-07 13:02:32.970252',"updated_at"=>'2015-12-07 13:02:32.970258'),array( "periodo"=>'4', "grupo_cas"=>'IIB', "simbolo"=>'Zn', "grupo_iupac"=>'0', 
		"numero_atomico"=>'30', "nombre"=>'Cinc', "peso_atomico"=>'65.38', "valencia"=>'2,8,18,2', "temp_ebullicion"=>'1180', "temp_fusion"=>'692.68',
		"bloque"=> 'D', "cod_estado"=>'2', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3p6 4s2 3d10', "electronegatividad"=>'1.65', "densidad"=>'7140
',"created_at"=>'2015-12-07 13:02:32.970277',"updated_at"=>'2015-12-07 13:02:32.970284'),array( "periodo"=>'4', "grupo_cas"=>'IIIA', "simbolo"=>'Ga', "grupo_iupac"=>'0', 
		"numero_atomico"=>'31', "nombre"=>'Galio', "peso_atomico"=>'69723', "valencia"=>'2,8,18,3', "temp_ebullicion"=>'2477', "temp_fusion"=>'302.91',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p1', "electronegatividad"=>'1.81', "densidad"=>'5904
',"created_at"=>'2015-12-07 13:02:32.970302',"updated_at"=>'2015-12-07 13:02:32.970309'),array( "periodo"=>'4', "grupo_cas"=>'IVA', "simbolo"=>'Ge', "grupo_iupac"=>'0', 
		"numero_atomico"=>'32', "nombre"=>'Germanio', "peso_atomico"=>'72.63', "valencia"=>'2,8,18,4', "temp_ebullicion"=>'3093', "temp_fusion"=>'1211.4',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'30', "cod_subclasificacion"=>'400',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p2', "electronegatividad"=>'2.01', "densidad"=>'5323
',"created_at"=>'2015-12-07 13:02:32.970328',"updated_at"=>'2015-12-07 13:02:32.970335'),array( "periodo"=>'4', "grupo_cas"=>'VA', "simbolo"=>'As', "grupo_iupac"=>'0', 
		"numero_atomico"=>'33', "nombre"=>'Arsénico', "peso_atomico"=>'74.921595', "valencia"=>'2,8,18,5', "temp_ebullicion"=>'887', "temp_fusion"=>'1090',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'30', "cod_subclasificacion"=>'400',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p3', "electronegatividad"=>'2.18', "densidad"=>'5727
',"created_at"=>'2015-12-07 13:02:32.970357',"updated_at"=>'2015-12-07 13:02:32.970364'),array( "periodo"=>'4', "grupo_cas"=>'VIA', "simbolo"=>'Se', "grupo_iupac"=>'0', 
		"numero_atomico"=>'34', "nombre"=>'Selenio', "peso_atomico"=>'78971', "valencia"=>'2,8,18,6', "temp_ebullicion"=>'958', "temp_fusion"=>'494',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'202',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p4', "electronegatividad"=>'2.55', "densidad"=>'4819
',"created_at"=>'2015-12-07 13:02:32.970383',"updated_at"=>'2015-12-07 13:02:32.970390'),array( "periodo"=>'4', "grupo_cas"=>'VIIA', "simbolo"=>'Br', "grupo_iupac"=>'0', 
		"numero_atomico"=>'35', "nombre"=>'Bromo', "peso_atomico"=>'79904', "valencia"=>'2,8,18,7', "temp_ebullicion"=>'332', "temp_fusion"=>'265.8',
		"bloque"=> 'P', "cod_estado"=>'9', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'201',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p5', "electronegatividad"=>'2.96', "densidad"=>'3120
',"created_at"=>'2015-12-07 13:02:32.970409',"updated_at"=>'2015-12-07 13:02:32.970416'),array( "periodo"=>'4', "grupo_cas"=>'VIIIA', "simbolo"=>'Kr', "grupo_iupac"=>'0', 
		"numero_atomico"=>'36', "nombre"=>'Kripton', "peso_atomico"=>'83798', "valencia"=>'2,8,18,8', "temp_ebullicion"=>'119.93', "temp_fusion"=>'115.79',
		"bloque"=> 'P', "cod_estado"=>'5', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'203',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6', "electronegatividad"=>'3', "densidad"=>'3.75
',"created_at"=>'2015-12-07 13:02:32.970435',"updated_at"=>'2015-12-07 13:02:32.970442'),array( "periodo"=>'5', "grupo_cas"=>'IA', "simbolo"=>'Rb', "grupo_iupac"=>'0', 
		"numero_atomico"=>'37', "nombre"=>'Rubidio', "peso_atomico"=>'85.4678', "valencia"=>'2,8,18,8,1', "temp_ebullicion"=>'961', "temp_fusion"=>'312.46',
		"bloque"=> 'S', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'101',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1', "electronegatividad"=>'0.82', "densidad"=>'1532
',"created_at"=>'2015-12-07 13:02:32.970462',"updated_at"=>'2015-12-07 13:02:32.970469'),array( "periodo"=>'5', "grupo_cas"=>'IIA', "simbolo"=>'Sr', "grupo_iupac"=>'0', 
		"numero_atomico"=>'38', "nombre"=>'Estroncio', "peso_atomico"=>'87.62', "valencia"=>'2,8,18,8,2', "temp_ebullicion"=>'1655', "temp_fusion"=>'1050',
		"bloque"=> 'S', "cod_estado"=>'6', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'102',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2', "electronegatividad"=>'0.95', "densidad"=>'2630
',"created_at"=>'2015-12-07 13:02:32.970488',"updated_at"=>'2015-12-07 13:02:32.970495'),array( "periodo"=>'5', "grupo_cas"=>'IIIB', "simbolo"=>'Y', "grupo_iupac"=>'0', 
		"numero_atomico"=>'39', "nombre"=>'Itrio', "peso_atomico"=>'88.90584', "valencia"=>'2,8,18,9,2', "temp_ebullicion"=>'3618', "temp_fusion"=>'1799',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d1', "electronegatividad"=>'1.22', "densidad"=>'4472
',"created_at"=>'2015-12-07 13:02:32.970514',"updated_at"=>'2015-12-07 13:02:32.970521'),array( "periodo"=>'5', "grupo_cas"=>'IVB', "simbolo"=>'Zr', "grupo_iupac"=>'0', 
		"numero_atomico"=>'40', "nombre"=>'Circonio', "peso_atomico"=>'91224', "valencia"=>'2,8,18,10,2', "temp_ebullicion"=>'4682', "temp_fusion"=>'2128',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d2', "electronegatividad"=>'1.33', "densidad"=>'6511
',"created_at"=>'2015-12-07 13:02:32.970540',"updated_at"=>'2015-12-07 13:02:32.970547'),array( "periodo"=>'5', "grupo_cas"=>'VB', "simbolo"=>'Nb', "grupo_iupac"=>'0', 
		"numero_atomico"=>'41', "nombre"=>'Niobio', "peso_atomico"=>'92.90637', "valencia"=>'2,8,18,12,1', "temp_ebullicion"=>'5017', "temp_fusion"=>'2750',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d4', "electronegatividad"=>'1.6', "densidad"=>'8570
',"created_at"=>'2015-12-07 13:02:32.970566',"updated_at"=>'2015-12-07 13:02:32.970573'),array( "periodo"=>'5', "grupo_cas"=>'VIB', "simbolo"=>'Mo', "grupo_iupac"=>'0', 
		"numero_atomico"=>'42', "nombre"=>'Molibdeno', "peso_atomico"=>'95.95', "valencia"=>'2,8,18,13,1', "temp_ebullicion"=>'4912', "temp_fusion"=>'2896',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d5', "electronegatividad"=>'2.16', "densidad"=>'10280
',"created_at"=>'2015-12-07 13:02:32.970592',"updated_at"=>'2015-12-07 13:02:32.970599'),array( "periodo"=>'5', "grupo_cas"=>'VIIB', "simbolo"=>'Tc', "grupo_iupac"=>'0', 
		"numero_atomico"=>'43', "nombre"=>'Tecnecio', "peso_atomico"=>'98', "valencia"=>'2,8,18,13,2', "temp_ebullicion"=>'4538', "temp_fusion"=>'2430',
		"bloque"=> 'D', "cod_estado"=>'6', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d5', "electronegatividad"=>'1.9', "densidad"=>'11500
',"created_at"=>'2015-12-07 13:02:32.970624',"updated_at"=>'2015-12-07 13:02:32.970631'),array( "periodo"=>'5', "grupo_cas"=>'VIIIB', "simbolo"=>'Ru', "grupo_iupac"=>'0', 
		"numero_atomico"=>'44', "nombre"=>'Rutenio', "peso_atomico"=>'101.07', "valencia"=>'2,8,18,15,1', "temp_ebullicion"=>'4423', "temp_fusion"=>'2607',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d7', "electronegatividad"=>'2.2', "densidad"=>'12370
',"created_at"=>'2015-12-07 13:02:32.970651',"updated_at"=>'2015-12-07 13:02:32.970657'),array( "periodo"=>'5', "grupo_cas"=>'VIIIB', "simbolo"=>'Rh', "grupo_iupac"=>'0', 
		"numero_atomico"=>'45', "nombre"=>'Rodio', "peso_atomico"=>'102.9055', "valencia"=>'2,8,18,16,1', "temp_ebullicion"=>'3968', "temp_fusion"=>'2237',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d8', "electronegatividad"=>'2.28', "densidad"=>'12450
',"created_at"=>'2015-12-07 13:02:32.970676',"updated_at"=>'2015-12-07 13:02:32.970683'),array( "periodo"=>'5', "grupo_cas"=>'VIIIB', "simbolo"=>'Pd', "grupo_iupac"=>'0', 
		"numero_atomico"=>'46', "nombre"=>'Paladio', "peso_atomico"=>'106.42', "valencia"=>'2,8,18,18', "temp_ebullicion"=>'3236', "temp_fusion"=>'1828.05',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 4d10', "electronegatividad"=>'2.2', "densidad"=>'12023
',"created_at"=>'2015-12-07 13:02:32.970702',"updated_at"=>'2015-12-07 13:02:32.970708'),array( "periodo"=>'5', "grupo_cas"=>'IB', "simbolo"=>'Ag', "grupo_iupac"=>'0', 
		"numero_atomico"=>'47', "nombre"=>'Plata', "peso_atomico"=>'107.8682', "valencia"=>'2,8,18,18,1', "temp_ebullicion"=>'2435', "temp_fusion"=>'1234.93',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s1 4d10', "electronegatividad"=>'1.93', "densidad"=>'10490
',"created_at"=>'2015-12-07 13:02:32.970727',"updated_at"=>'2015-12-07 13:02:32.970734'),array( "periodo"=>'5', "grupo_cas"=>'IIB', "simbolo"=>'Cd', "grupo_iupac"=>'0', 
		"numero_atomico"=>'48', "nombre"=>'Cadmio', "peso_atomico"=>'112414', "valencia"=>'2,8,18,18,2', "temp_ebullicion"=>'1040', "temp_fusion"=>'594.22',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10', "electronegatividad"=>'1.69', "densidad"=>'8650
',"created_at"=>'2015-12-07 13:02:32.970753',"updated_at"=>'2015-12-07 13:02:32.970760'),array( "periodo"=>'5', "grupo_cas"=>'IIIA', "simbolo"=>'In', "grupo_iupac"=>'0', 
		"numero_atomico"=>'49', "nombre"=>'Indio', "peso_atomico"=>'114818', "valencia"=>'2,8,18,18,3', "temp_ebullicion"=>'2345', "temp_fusion"=>'429.75',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p1', "electronegatividad"=>'1.78', "densidad"=>'7310
',"created_at"=>'2015-12-07 13:02:32.970779',"updated_at"=>'2015-12-07 13:02:32.970786'),array( "periodo"=>'5', "grupo_cas"=>'IVA', "simbolo"=>'Sn', "grupo_iupac"=>'0', 
		"numero_atomico"=>'50', "nombre"=>'Estaño', "peso_atomico"=>'118.71', "valencia"=>'2,8,18,18,4', "temp_ebullicion"=>'2875', "temp_fusion"=>'505.08',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p2', "electronegatividad"=>'1.96', "densidad"=>'7310
',"created_at"=>'2015-12-07 13:02:32.970805',"updated_at"=>'2015-12-07 13:02:32.970812'),array( "periodo"=>'5', "grupo_cas"=>'VA', "simbolo"=>'Sb', "grupo_iupac"=>'0', 
		"numero_atomico"=>'51', "nombre"=>'Antimonio', "peso_atomico"=>'121.76', "valencia"=>'2,8,18,18,5', "temp_ebullicion"=>'1860', "temp_fusion"=>'903.78',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'30', "cod_subclasificacion"=>'400',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p3', "electronegatividad"=>'2.05', "densidad"=>'6697
',"created_at"=>'2015-12-07 13:02:32.970831',"updated_at"=>'2015-12-07 13:02:32.970838'),array( "periodo"=>'5', "grupo_cas"=>'VIA', "simbolo"=>'Te', "grupo_iupac"=>'0', 
		"numero_atomico"=>'52', "nombre"=>'Telurio', "peso_atomico"=>'127.6', "valencia"=>'2,8,18,18,6', "temp_ebullicion"=>'1261', "temp_fusion"=>'722.66',
		"bloque"=> 'P', "cod_estado"=>'2', "cod_clasificacion"=>'30', "cod_subclasificacion"=>'400',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p4', "electronegatividad"=>'2.1', "densidad"=>'6240
',"created_at"=>'2015-12-07 13:02:32.970857',"updated_at"=>'2015-12-07 13:02:32.970864'),array( "periodo"=>'5', "grupo_cas"=>'VIIA', "simbolo"=>'I', "grupo_iupac"=>'0', 
		"numero_atomico"=>'53', "nombre"=>'Yodo', "peso_atomico"=>'126.90447', "valencia"=>'2,8,18,18,7', "temp_ebullicion"=>'457.4', "temp_fusion"=>'386.85',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'201',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p5', "electronegatividad"=>'2.66', "densidad"=>'4940
',"created_at"=>'2015-12-07 13:02:32.970883',"updated_at"=>'2015-12-07 13:02:32.970890'),array( "periodo"=>'5', "grupo_cas"=>'VIIIA', "simbolo"=>'Xe', "grupo_iupac"=>'0', 
		"numero_atomico"=>'54', "nombre"=>'Xenón', "peso_atomico"=>'131293', "valencia"=>'2,8,18,18,8', "temp_ebullicion"=>'165.1', "temp_fusion"=>'161.3',
		"bloque"=> 'P', "cod_estado"=>'5', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'203',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6', "electronegatividad"=>'2.6', "densidad"=>'5.9
',"created_at"=>'2015-12-07 13:02:32.970909',"updated_at"=>'2015-12-07 13:02:32.970916'),array( "periodo"=>'6', "grupo_cas"=>'IA', "simbolo"=>'Cs', "grupo_iupac"=>'0', 
		"numero_atomico"=>'55', "nombre"=>'Cesio', "peso_atomico"=>'132.90545196', "valencia"=>'2,8,18,18,8,1', "temp_ebullicion"=>'944', "temp_fusion"=>'301.59',
		"bloque"=> 'S', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'101',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1', "electronegatividad"=>'0.79', "densidad"=>'1879
',"created_at"=>'2015-12-07 13:02:32.970935',"updated_at"=>'2015-12-07 13:02:32.970942'),array( "periodo"=>'6', "grupo_cas"=>'IIA', "simbolo"=>'Ba', "grupo_iupac"=>'0', 
		"numero_atomico"=>'56', "nombre"=>'Bario', "peso_atomico"=>'137327', "valencia"=>'2,8,18,18,8,2', "temp_ebullicion"=>'2143', "temp_fusion"=>'1000',
		"bloque"=> 'S', "cod_estado"=>'6', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'102',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2', "electronegatividad"=>'0.89', "densidad"=>'3510
',"created_at"=>'2015-12-07 13:02:32.970962',"updated_at"=>'2015-12-07 13:02:32.970969'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'La', "grupo_iupac"=>'0', 
		"numero_atomico"=>'57', "nombre"=>'Lantano', "peso_atomico"=>'138.90547', "valencia"=>'2,8,18,18,9,2', "temp_ebullicion"=>'3737', "temp_fusion"=>'1193',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 5d1', "electronegatividad"=>'1.1', "densidad"=>'6146
',"created_at"=>'2015-12-07 13:02:32.971006',"updated_at"=>'2015-12-07 13:02:32.971014'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Ce', "grupo_iupac"=>'0', 
		"numero_atomico"=>'58', "nombre"=>'Cerio', "peso_atomico"=>'140116', "valencia"=>'2,8,18,19,9,2', "temp_ebullicion"=>'3633', "temp_fusion"=>'1071',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f1 5d1', "electronegatividad"=>'1.12', "densidad"=>'6689
',"created_at"=>'2015-12-07 13:02:32.971034',"updated_at"=>'2015-12-07 13:02:32.971041'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Pr', "grupo_iupac"=>'0', 
		"numero_atomico"=>'59', "nombre"=>'Praseodimio', "peso_atomico"=>'140.90766', "valencia"=>'2,8,18,21,8,2', "temp_ebullicion"=>'3563', "temp_fusion"=>'1204',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f3', "electronegatividad"=>'1.13', "densidad"=>'6640
',"created_at"=>'2015-12-07 13:02:32.971061',"updated_at"=>'2015-12-07 13:02:32.971068'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Nd', "grupo_iupac"=>'0', 
		"numero_atomico"=>'60', "nombre"=>'Neodimio', "peso_atomico"=>'144242', "valencia"=>'2,8,18,22,8,2', "temp_ebullicion"=>'3373', "temp_fusion"=>'1294',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f4', "electronegatividad"=>'1.14', "densidad"=>'7010
',"created_at"=>'2015-12-07 13:02:32.971088',"updated_at"=>'2015-12-07 13:02:32.971095'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Pm', "grupo_iupac"=>'0', 
		"numero_atomico"=>'61', "nombre"=>'Prometio', "peso_atomico"=>'145', "valencia"=>'2,8,18,23,8,2', "temp_ebullicion"=>'3273', "temp_fusion"=>'1373',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f5', "electronegatividad"=>'0.0', "densidad"=>'7264
',"created_at"=>'2015-12-07 13:02:32.971114',"updated_at"=>'2015-12-07 13:02:32.971121'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Sm', "grupo_iupac"=>'0', 
		"numero_atomico"=>'62', "nombre"=>'Samario', "peso_atomico"=>'150.36', "valencia"=>'2,8,18,24,8,2', "temp_ebullicion"=>'2076', "temp_fusion"=>'1345',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f6', "electronegatividad"=>'1.17', "densidad"=>'7353
',"created_at"=>'2015-12-07 13:02:32.971140',"updated_at"=>'2015-12-07 13:02:32.971147'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Eu', "grupo_iupac"=>'0', 
		"numero_atomico"=>'63', "nombre"=>'Europio', "peso_atomico"=>'151964', "valencia"=>'2,8,18,25,8,2', "temp_ebullicion"=>'1800', "temp_fusion"=>'1095',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f7', "electronegatividad"=>'0.0', "densidad"=>'5244
',"created_at"=>'2015-12-07 13:02:32.971166',"updated_at"=>'2015-12-07 13:02:32.971173'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Gd', "grupo_iupac"=>'0', 
		"numero_atomico"=>'64', "nombre"=>'Gadolinio', "peso_atomico"=>'157.25', "valencia"=>'2,8,18,25,9,2', "temp_ebullicion"=>'3523', "temp_fusion"=>'1586',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f7 5d1', "electronegatividad"=>'1.2', "densidad"=>'7901
',"created_at"=>'2015-12-07 13:02:32.971193',"updated_at"=>'2015-12-07 13:02:32.971200'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Tb', "grupo_iupac"=>'0', 
		"numero_atomico"=>'65', "nombre"=>'Terbio', "peso_atomico"=>'158.92535', "valencia"=>'2,8,18,27,8,2', "temp_ebullicion"=>'3503', "temp_fusion"=>'1629',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f9', "electronegatividad"=>'0.0', "densidad"=>'8219
',"created_at"=>'2015-12-07 13:02:32.971223',"updated_at"=>'2015-12-07 13:02:32.971231'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Dy', "grupo_iupac"=>'0', 
		"numero_atomico"=>'66', "nombre"=>'Disprosio', "peso_atomico"=>'162.5', "valencia"=>'2,8,18,28,8,2', "temp_ebullicion"=>'2840', "temp_fusion"=>'1685',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f10', "electronegatividad"=>'1.22', "densidad"=>'8551
',"created_at"=>'2015-12-07 13:02:32.971250',"updated_at"=>'2015-12-07 13:02:32.971258'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Ho', "grupo_iupac"=>'0', 
		"numero_atomico"=>'67', "nombre"=>'Holmio', "peso_atomico"=>'164.93033', "valencia"=>'2,8,18,29,8,2', "temp_ebullicion"=>'2973', "temp_fusion"=>'1747',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f11', "electronegatividad"=>'1.23', "densidad"=>'8795
',"created_at"=>'2015-12-07 13:02:32.971277',"updated_at"=>'2015-12-07 13:02:32.971284'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Er', "grupo_iupac"=>'0', 
		"numero_atomico"=>'68', "nombre"=>'Erbio', "peso_atomico"=>'167259', "valencia"=>'2,8,18,30,8,2', "temp_ebullicion"=>'3141', "temp_fusion"=>'1770',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f12', "electronegatividad"=>'1.24', "densidad"=>'9066
',"created_at"=>'2015-12-07 13:02:32.971303',"updated_at"=>'2015-12-07 13:02:32.971310'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Tm', "grupo_iupac"=>'0', 
		"numero_atomico"=>'69', "nombre"=>'Tulio', "peso_atomico"=>'168.93422', "valencia"=>'2,8,18,31,8,2', "temp_ebullicion"=>'2223', "temp_fusion"=>'1818',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f13', "electronegatividad"=>'1.25', "densidad"=>'9321
',"created_at"=>'2015-12-07 13:02:32.971329',"updated_at"=>'2015-12-07 13:02:32.971336'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Yb', "grupo_iupac"=>'0', 
		"numero_atomico"=>'70', "nombre"=>'Iterbio', "peso_atomico"=>'173054', "valencia"=>'2,8,18,32,8,2', "temp_ebullicion"=>'1469', "temp_fusion"=>'1092',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14', "electronegatividad"=>'0.0', "densidad"=>'6570
',"created_at"=>'2015-12-07 13:02:32.971355',"updated_at"=>'2015-12-07 13:02:32.971362'),array( "periodo"=>'6', "grupo_cas"=>'-', "simbolo"=>'Lu', "grupo_iupac"=>'0', 
		"numero_atomico"=>'71', "nombre"=>'Lutecio', "peso_atomico"=>'174.9668', "valencia"=>'2,8,18,32,9,2', "temp_ebullicion"=>'3675', "temp_fusion"=>'1936',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'103',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d1', "electronegatividad"=>'1.27', "densidad"=>'9841
',"created_at"=>'2015-12-07 13:02:32.971382',"updated_at"=>'2015-12-07 13:02:32.971389'),array( "periodo"=>'6', "grupo_cas"=>'IVB', "simbolo"=>'hf', "grupo_iupac"=>'0', 
		"numero_atomico"=>'72', "nombre"=>'Hafnio', "peso_atomico"=>'178.49', "valencia"=>'2,8,18,32,10,2', "temp_ebullicion"=>'4876', "temp_fusion"=>'2506',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d2', "electronegatividad"=>'1.3', "densidad"=>'13310
',"created_at"=>'2015-12-07 13:02:32.971413',"updated_at"=>'2015-12-07 13:02:32.971485'),array( "periodo"=>'6', "grupo_cas"=>'VB', "simbolo"=>'Ta', "grupo_iupac"=>'0', 
		"numero_atomico"=>'73', "nombre"=>'Tantalio', "peso_atomico"=>'180.94788', "valencia"=>'2,8,18,32,11,2', "temp_ebullicion"=>'5731', "temp_fusion"=>'3290',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d3', "electronegatividad"=>'1.5', "densidad"=>'16650
',"created_at"=>'2015-12-07 13:02:32.971509',"updated_at"=>'2015-12-07 13:02:32.971517'),array( "periodo"=>'6', "grupo_cas"=>'VIB', "simbolo"=>'W', "grupo_iupac"=>'0', 
		"numero_atomico"=>'74', "nombre"=>'Wolframio', "peso_atomico"=>'183.84', "valencia"=>'2,8,18,32,12,2', "temp_ebullicion"=>'5828', "temp_fusion"=>'3695',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d4', "electronegatividad"=>'2.36', "densidad"=>'19250
',"created_at"=>'2015-12-07 13:02:32.971537',"updated_at"=>'2015-12-07 13:02:32.971544'),array( "periodo"=>'6', "grupo_cas"=>'VIIB', "simbolo"=>'Re', "grupo_iupac"=>'0', 
		"numero_atomico"=>'75', "nombre"=>'Renio', "peso_atomico"=>'186207', "valencia"=>'2,8,18,32,13,2', "temp_ebullicion"=>'5869', "temp_fusion"=>'3459',
		"bloque"=> 'D', "cod_estado"=>'10', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d5', "electronegatividad"=>'1.9', "densidad"=>'21020
',"created_at"=>'2015-12-07 13:02:32.971564',"updated_at"=>'2015-12-07 13:02:32.971571'),array( "periodo"=>'6', "grupo_cas"=>'VIIIB', "simbolo"=>'Os', "grupo_iupac"=>'0', 
		"numero_atomico"=>'76', "nombre"=>'Osmio', "peso_atomico"=>'190.23', "valencia"=>'2,8,18,32,14,2', "temp_ebullicion"=>'5285', "temp_fusion"=>'3306',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d6', "electronegatividad"=>'2.2', "densidad"=>'22610
',"created_at"=>'2015-12-07 13:02:32.971596',"updated_at"=>'2015-12-07 13:02:32.971603'),array( "periodo"=>'6', "grupo_cas"=>'VIIIB', "simbolo"=>'Ir', "grupo_iupac"=>'0', 
		"numero_atomico"=>'77', "nombre"=>'Iridio', "peso_atomico"=>'192217', "valencia"=>'2,8,18,32,15,2', "temp_ebullicion"=>'4701', "temp_fusion"=>'2739',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d7', "electronegatividad"=>'2.2', "densidad"=>'22650
',"created_at"=>'2015-12-07 13:02:32.971624',"updated_at"=>'2015-12-07 13:02:32.971631'),array( "periodo"=>'6', "grupo_cas"=>'VIIIB', "simbolo"=>'Pt', "grupo_iupac"=>'0', 
		"numero_atomico"=>'78', "nombre"=>'Platino', "peso_atomico"=>'195084', "valencia"=>'2,8,18,32,17,1', "temp_ebullicion"=>'4098', "temp_fusion"=>'2041.4',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1 4f14 5d9', "electronegatividad"=>'2.28', "densidad"=>'21090
',"created_at"=>'2015-12-07 13:02:32.971650',"updated_at"=>'2015-12-07 13:02:32.971657'),array( "periodo"=>'6', "grupo_cas"=>'IB', "simbolo"=>'Au', "grupo_iupac"=>'0', 
		"numero_atomico"=>'79', "nombre"=>'Oro', "peso_atomico"=>'196.966569', "valencia"=>'2,8,18,32,18,1', "temp_ebullicion"=>'3129', "temp_fusion"=>'1337.33',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s1 4f14 5d10', "electronegatividad"=>'2.54', "densidad"=>'19300
',"created_at"=>'2015-12-07 13:02:32.971677',"updated_at"=>'2015-12-07 13:02:32.971684'),array( "periodo"=>'6', "grupo_cas"=>'IIB', "simbolo"=>'Hg', "grupo_iupac"=>'0', 
		"numero_atomico"=>'80', "nombre"=>'Mercurio', "peso_atomico"=>'200.59', "valencia"=>'2,8,18,32,18,2', "temp_ebullicion"=>'629.88', "temp_fusion"=>'234.32',
		"bloque"=> 'D', "cod_estado"=>'11', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10', "electronegatividad"=>'2', "densidad"=>'13534
',"created_at"=>'2015-12-07 13:02:32.971709',"updated_at"=>'2015-12-07 13:02:32.971859'),array( "periodo"=>'6', "grupo_cas"=>'IIIA', "simbolo"=>'Tl', "grupo_iupac"=>'0', 
		"numero_atomico"=>'81', "nombre"=>'Talio', "peso_atomico"=>'204.38', "valencia"=>'2,8,18,32,18,3', "temp_ebullicion"=>'1746', "temp_fusion"=>'577',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p1', "electronegatividad"=>'1.62', "densidad"=>'11850
',"created_at"=>'2015-12-07 13:02:32.972014',"updated_at"=>'2015-12-07 13:02:32.972027'),array( "periodo"=>'6', "grupo_cas"=>'IVA', "simbolo"=>'Pb', "grupo_iupac"=>'0', 
		"numero_atomico"=>'82', "nombre"=>'Plomo', "peso_atomico"=>'207.2', "valencia"=>'2,8,18,32,18,4', "temp_ebullicion"=>'2022', "temp_fusion"=>'600.61',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p2', "electronegatividad"=>'2.33', "densidad"=>'11340
',"created_at"=>'2015-12-07 13:02:32.972049',"updated_at"=>'2015-12-07 13:02:32.972057'),array( "periodo"=>'6', "grupo_cas"=>'VA', "simbolo"=>'Bi', "grupo_iupac"=>'0', 
		"numero_atomico"=>'83', "nombre"=>'Bismuto', "peso_atomico"=>'208.9804', "valencia"=>'2,8,18,32,18,5', "temp_ebullicion"=>'1837', "temp_fusion"=>'544.4',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p3', "electronegatividad"=>'2.02', "densidad"=>'9780
',"created_at"=>'2015-12-07 13:02:32.972077',"updated_at"=>'2015-12-07 13:02:32.972084'),array( "periodo"=>'6', "grupo_cas"=>'VIA', "simbolo"=>'Po', "grupo_iupac"=>'0', 
		"numero_atomico"=>'84', "nombre"=>'Polonio', "peso_atomico"=>'209', "valencia"=>'2,8,18,32,18,6', "temp_ebullicion"=>'1235', "temp_fusion"=>'527',
		"bloque"=> 'P', "cod_estado"=>'2', "cod_clasificacion"=>'30', "cod_subclasificacion"=>'400',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p4', "electronegatividad"=>'2', "densidad"=>'9196
',"created_at"=>'2015-12-07 13:02:32.972104',"updated_at"=>'2015-12-07 13:02:32.972111'),array( "periodo"=>'6', "grupo_cas"=>'VIIA', "simbolo"=>'At', "grupo_iupac"=>'0', 
		"numero_atomico"=>'85', "nombre"=>'Astato', "peso_atomico"=>'210', "valencia"=>'2,8,18,32,18,7', "temp_ebullicion"=>'610', "temp_fusion"=>'575',
		"bloque"=> 'P', "cod_estado"=>'7', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'201',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p5', "electronegatividad"=>'2.2', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972132',"updated_at"=>'2015-12-07 13:02:32.972139'),array( "periodo"=>'6', "grupo_cas"=>'VIIIA', "simbolo"=>'Rn', "grupo_iupac"=>'0', 
		"numero_atomico"=>'86', "nombre"=>'Radón', "peso_atomico"=>'222', "valencia"=>'2,8,18,32,18,8', "temp_ebullicion"=>'211.3', "temp_fusion"=>'202',
		"bloque"=> 'P', "cod_estado"=>'5', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'203',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6', "electronegatividad"=>'0.0', "densidad"=>'9.73
',"created_at"=>'2015-12-07 13:02:32.972159',"updated_at"=>'2015-12-07 13:02:32.972166'),array( "periodo"=>'7', "grupo_cas"=>'IA', "simbolo"=>'Fr', "grupo_iupac"=>'0', 
		"numero_atomico"=>'87', "nombre"=>'Francio', "peso_atomico"=>'223', "valencia"=>'2,8,18,32,18,8,1', "temp_ebullicion"=>'950', "temp_fusion"=>'300',
		"bloque"=> 'S', "cod_estado"=>'11', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'101',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s1', "electronegatividad"=>'0.7', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972196',"updated_at"=>'2015-12-07 13:02:32.972204'),array( "periodo"=>'7', "grupo_cas"=>'IIA', "simbolo"=>'Ra', "grupo_iupac"=>'0', 
		"numero_atomico"=>'88', "nombre"=>'Radio', "peso_atomico"=>'226', "valencia"=>'2,8,18,32,18,2', "temp_ebullicion"=>'2010', "temp_fusion"=>'973',
		"bloque"=> 'S', "cod_estado"=>'2', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'102',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2', "electronegatividad"=>'0.9', "densidad"=>'5000
',"created_at"=>'2015-12-07 13:02:32.972224',"updated_at"=>'2015-12-07 13:02:32.972232'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Ac', "grupo_iupac"=>'0', 
		"numero_atomico"=>'89', "nombre"=>'Actinio', "peso_atomico"=>'227', "valencia"=>'2,8,18,32,18,9,2', "temp_ebullicion"=>'3473', "temp_fusion"=>'1323',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 6d1', "electronegatividad"=>'1.1', "densidad"=>'10070
',"created_at"=>'2015-12-07 13:02:32.972251',"updated_at"=>'2015-12-07 13:02:32.972258'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Th', "grupo_iupac"=>'0', 
		"numero_atomico"=>'90', "nombre"=>'Torio', "peso_atomico"=>'232.0377', "valencia"=>'2,8,18,32,18,10,2', "temp_ebullicion"=>'5093', "temp_fusion"=>'2023',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 6d2', "electronegatividad"=>'1.3', "densidad"=>'11724
',"created_at"=>'2015-12-07 13:02:32.972278',"updated_at"=>'2015-12-07 13:02:32.972285'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Pa', "grupo_iupac"=>'0', 
		"numero_atomico"=>'91', "nombre"=>'Protactinio', "peso_atomico"=>'231.03588', "valencia"=>'2,8,18,32,20,9,2', "temp_ebullicion"=>'4273', "temp_fusion"=>'1845',
		"bloque"=> 'F', "cod_estado"=>'11', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f2 6d1', "electronegatividad"=>'1.5', "densidad"=>'15370
',"created_at"=>'2015-12-07 13:02:32.972305',"updated_at"=>'2015-12-07 13:02:32.972313'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'U', "grupo_iupac"=>'0', 
		"numero_atomico"=>'92', "nombre"=>'Uranio', "peso_atomico"=>'238.02891', "valencia"=>'2,8,18,32,21,9,2', "temp_ebullicion"=>'4200', "temp_fusion"=>'1408',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f3 6d1', "electronegatividad"=>'1.38', "densidad"=>'19050
',"created_at"=>'2015-12-07 13:02:32.972332',"updated_at"=>'2015-12-07 13:02:32.972339'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Np', "grupo_iupac"=>'0', 
		"numero_atomico"=>'93', "nombre"=>'Neptunio', "peso_atomico"=>'237', "valencia"=>'2,8,18,32,22,9,2', "temp_ebullicion"=>'4273', "temp_fusion"=>'917',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f4 6d1', "electronegatividad"=>'1.36', "densidad"=>'20450
',"created_at"=>'2015-12-07 13:02:32.972359',"updated_at"=>'2015-12-07 13:02:32.972366'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Pu', "grupo_iupac"=>'0', 
		"numero_atomico"=>'94', "nombre"=>'Plutonio', "peso_atomico"=>'244', "valencia"=>'2,8,18,32,24,8,2', "temp_ebullicion"=>'3503', "temp_fusion"=>'913',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f6', "electronegatividad"=>'1.28', "densidad"=>'19816
',"created_at"=>'2015-12-07 13:02:32.972390',"updated_at"=>'2015-12-07 13:02:32.972397'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Am', "grupo_iupac"=>'0', 
		"numero_atomico"=>'95', "nombre"=>'Americio', "peso_atomico"=>'243', "valencia"=>'2,8,18,32,25,8,2', "temp_ebullicion"=>'2284', "temp_fusion"=>'1449',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f7', "electronegatividad"=>'1.3', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972416',"updated_at"=>'2015-12-07 13:02:32.972423'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Cm', "grupo_iupac"=>'0', 
		"numero_atomico"=>'96', "nombre"=>'Curio', "peso_atomico"=>'247', "valencia"=>'2,8,18,32,25,9,2', "temp_ebullicion"=>'3383', "temp_fusion"=>'1618',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f7 6d1', "electronegatividad"=>'1.3', "densidad"=>'13510
',"created_at"=>'2015-12-07 13:02:32.972443',"updated_at"=>'2015-12-07 13:02:32.972450'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Bk', "grupo_iupac"=>'0', 
		"numero_atomico"=>'97', "nombre"=>'Berkelio', "peso_atomico"=>'247', "valencia"=>'2,8,18,32,27,8,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'1323',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f9', "electronegatividad"=>'1.3', "densidad"=>'14780
',"created_at"=>'2015-12-07 13:02:32.972470',"updated_at"=>'2015-12-07 13:02:32.972477'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Cf', "grupo_iupac"=>'0', 
		"numero_atomico"=>'98', "nombre"=>'Californio', "peso_atomico"=>'251', "valencia"=>'2,8,18,32,28,8,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'1173',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f10', "electronegatividad"=>'1.3', "densidad"=>'15100
',"created_at"=>'2015-12-07 13:02:32.972496',"updated_at"=>'2015-12-07 13:02:32.972503'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Es', "grupo_iupac"=>'0', 
		"numero_atomico"=>'99', "nombre"=>'Einstenio', "peso_atomico"=>'252', "valencia"=>'2,8,18,32,29,8,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'1133',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f11', "electronegatividad"=>'1.3', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972522',"updated_at"=>'2015-12-07 13:02:32.972529'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Fm', "grupo_iupac"=>'0', 
		"numero_atomico"=>'100', "nombre"=>'Fermio', "peso_atomico"=>'257', "valencia"=>'2,8,18,32,30,8,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'1800',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f12', "electronegatividad"=>'1.3', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972549',"updated_at"=>'2015-12-07 13:02:32.972556'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Md', "grupo_iupac"=>'0', 
		"numero_atomico"=>'101', "nombre"=>'Mendelevio', "peso_atomico"=>'258', "valencia"=>'2,8,18,32,31,8,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'1100',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f13', "electronegatividad"=>'1.3', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972575',"updated_at"=>'2015-12-07 13:02:32.972582'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'No', "grupo_iupac"=>'0', 
		"numero_atomico"=>'102', "nombre"=>'Nobelio', "peso_atomico"=>'259', "valencia"=>'2,8,18,32,32,8,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'1100',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14', "electronegatividad"=>'1.3', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972602',"updated_at"=>'2015-12-07 13:02:32.972609'),array( "periodo"=>'7', "grupo_cas"=>'-', "simbolo"=>'Lr', "grupo_iupac"=>'0', 
		"numero_atomico"=>'103', "nombre"=>'Lawrencio', "peso_atomico"=>'262', "valencia"=>'2,8,18,32,32,8,3', "temp_ebullicion"=>'0.0', "temp_fusion"=>'1900',
		"bloque"=> 'F', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'104',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 7p1', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972628',"updated_at"=>'2015-12-07 13:02:32.972636'),array( "periodo"=>'7', "grupo_cas"=>'IVB', "simbolo"=>'Rf', "grupo_iupac"=>'0', 
		"numero_atomico"=>'104', "nombre"=>'Rutherfordio', "peso_atomico"=>'267', "valencia"=>'2,8,18,32,32,10,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d2', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972655',"updated_at"=>'2015-12-07 13:02:32.972663'),array( "periodo"=>'7', "grupo_cas"=>'VB', "simbolo"=>'Db', "grupo_iupac"=>'0', 
		"numero_atomico"=>'105', "nombre"=>'Dubnio', "peso_atomico"=>'268', "valencia"=>'2,8,18,32,32,11,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d3', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972689',"updated_at"=>'2015-12-07 13:02:32.972697'),array( "periodo"=>'7', "grupo_cas"=>'VIB', "simbolo"=>'Sg', "grupo_iupac"=>'0', 
		"numero_atomico"=>'106', "nombre"=>'Seaborgio', "peso_atomico"=>'271', "valencia"=>'2,8,18,32,32,12,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d4', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972718',"updated_at"=>'2015-12-07 13:02:32.972725'),array( "periodo"=>'7', "grupo_cas"=>'VIIB', "simbolo"=>'Bh', "grupo_iupac"=>'0', 
		"numero_atomico"=>'107', "nombre"=>'Bohrio', "peso_atomico"=>'272', "valencia"=>'2,8,18,32,32,13,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d5', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972744',"updated_at"=>'2015-12-07 13:02:32.972752'),array( "periodo"=>'7', "grupo_cas"=>'VIIIB', "simbolo"=>'Hs', "grupo_iupac"=>'0', 
		"numero_atomico"=>'108', "nombre"=>'Hassio', "peso_atomico"=>'270', "valencia"=>'2,8,18,32,32,14,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d6', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972771',"updated_at"=>'2015-12-07 13:02:32.972778'),array( "periodo"=>'7', "grupo_cas"=>'VIIIB', "simbolo"=>'Mt', "grupo_iupac"=>'0', 
		"numero_atomico"=>'109', "nombre"=>'Meitnerio', "peso_atomico"=>'276', "valencia"=>'2,8,18,32,32,15,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d7', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972802',"updated_at"=>'2015-12-07 13:02:32.972809'),array( "periodo"=>'7', "grupo_cas"=>'VIIIB', "simbolo"=>'Ds', "grupo_iupac"=>'0', 
		"numero_atomico"=>'110', "nombre"=>'Darmstadio', "peso_atomico"=>'281', "valencia"=>'2,8,18,32,32,17,1', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'7', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s1 5f14 6d9', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972829',"updated_at"=>'2015-12-07 13:02:32.972836'),array( "periodo"=>'7', "grupo_cas"=>'IB', "simbolo"=>'Rg', "grupo_iupac"=>'0', 
		"numero_atomico"=>'111', "nombre"=>'Roentgenio', "peso_atomico"=>'280', "valencia"=>'2,8,18,32,32,18,1', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'12', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s1 5f14 6d10', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972856',"updated_at"=>'2015-12-07 13:02:32.972863'),array( "periodo"=>'7', "grupo_cas"=>'IIB', "simbolo"=>'Cn', "grupo_iupac"=>'0', 
		"numero_atomico"=>'112', "nombre"=>'Copernicio', "peso_atomico"=>'285', "valencia"=>'2,8,18,32,32,18,2', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> 'D', "cod_estado"=>'11', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'105',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972883',"updated_at"=>'2015-12-07 13:02:32.972890'),array( "periodo"=>'7', "grupo_cas"=>'IIIA', "simbolo"=>'Uut', "grupo_iupac"=>'0', 
		"numero_atomico"=>'113', "nombre"=>'Ununtrio', "peso_atomico"=>'284', "valencia"=>'2,8,18,32,32,18,3', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> '-', "cod_estado"=>'13', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p1', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972910',"updated_at"=>'2015-12-07 13:02:32.972917'),array( "periodo"=>'7', "grupo_cas"=>'IVA', "simbolo"=>'Fl', "grupo_iupac"=>'0', 
		"numero_atomico"=>'114', "nombre"=>'Flerovio', "peso_atomico"=>'289', "valencia"=>'2,8,18,32,32,18,4', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> '-', "cod_estado"=>'13', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p2', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972936',"updated_at"=>'2015-12-07 13:02:32.972943'),array( "periodo"=>'7', "grupo_cas"=>'VA', "simbolo"=>'Uup', "grupo_iupac"=>'0', 
		"numero_atomico"=>'115', "nombre"=>'Ununpentio', "peso_atomico"=>'288', "valencia"=>'2,8,18,32,32,18,5', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> '-', "cod_estado"=>'11', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p3', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972963',"updated_at"=>'2015-12-07 13:02:32.972970'),array( "periodo"=>'7', "grupo_cas"=>'VIA', "simbolo"=>'Lv', "grupo_iupac"=>'0', 
		"numero_atomico"=>'116', "nombre"=>'Livermorio', "peso_atomico"=>'293', "valencia"=>'2,8,18,32,32,18,6', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> '-', "cod_estado"=>'11', "cod_clasificacion"=>'10', "cod_subclasificacion"=>'106',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p4', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.972995',"updated_at"=>'2015-12-07 13:02:32.973003'),array( "periodo"=>'7', "grupo_cas"=>'VIIA', "simbolo"=>'Uus', "grupo_iupac"=>'0', 
		"numero_atomico"=>'117', "nombre"=>'Ununseptio', "peso_atomico"=>'294', "valencia"=>'2,8,18,32,32,18,7', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> '-', "cod_estado"=>'13', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'201',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p5', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.973023',"updated_at"=>'2015-12-07 13:02:32.973030'),array( "periodo"=>'7', "grupo_cas"=>'VIIIA', "simbolo"=>'Uuo', "grupo_iupac"=>'0', 
		"numero_atomico"=>'118', "nombre"=>'Ununoctio', "peso_atomico"=>'294', "valencia"=>'2,8,18,32,32,18,8', "temp_ebullicion"=>'0.0', "temp_fusion"=>'0.0',
		"bloque"=> '-', "cod_estado"=>'12', "cod_clasificacion"=>'20', "cod_subclasificacion"=>'203',
		"config_electronica"=> '1s2 2s2 2p6 3s2 3p6 4s2 3d10 4p6 5s2 4d10 5p6 6s2 4f14 5d10 6p6 7s2 5f14 6d10 7p6', "electronegatividad"=>'0.0', "densidad"=>'0.0
',"created_at"=>'2015-12-07 13:02:32.973050',"updated_at"=>'2015-12-07 13:02:32.973057'));

        DB::table('elementos_quimicos')->insert($campos);
    }
}
