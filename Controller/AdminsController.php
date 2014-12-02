<?php
	require_once(__DIR__."/../controller/BaseController.php");
	require_once(__DIR__."/../model/AdminMapper.php");
	
	class AdminsController extends BaseController
	{
		public $ganadorIngenio;
		public $ganadorSabor;
		public $ganadorPresentacion;
		
		public function validarPincho(){
			parent::ConectarDB();
			session_start();
			
			$adminMapper = new AdminMapper();
			$pinchosPendientes = $adminMapper->validarPincho();
			
			require_once ($_SERVER['DOCUMENT_ROOT'].'/appPinchos/View/Admins/validarPincho.php');
		}
		
		public function consultarPuntuacion(){
			
			//-- JURADO PROFESIONAL -- INGENIO
			//idPincho ganador de categoria ingenio
			$idIngenio = mysql_query("SELECT SUM(puntuacion),Pincho_idPincho FROM voto WHERE categoria = 'ingenio' GROUP BY Pincho_idPincho ORDER BY 1 DESC");
			if ($idIngenio == NULL) {
				$idIngenio = " ";
			} else {
				$idIngenio = mysql_fetch_array($idIngenio);
				
				//puntuacion del ganador
				$puntuacionIngenio = $idIngenio[0];
				
				//nombre de idPincho ganador
				$nombreIngenio = mysql_query("SELECT nombre FROM pincho WHERE idPincho = '$idIngenio'");
				$nombreIngenio = mysql_fetch_array($nombreIngenio);
				$nombreIngenio = $nombreIngenio[0];
			}
			//-- JURADO PROFESIONAL -- INGENIO
			
			//---------------------------------
			
			//-- JURADO PROFESIONAL -- SABOR
			//idPincho ganador de categoria ingenio
			$idSabor = mysql_query("SELECT SUM(puntuacion),Pincho_idPincho FROM voto WHERE categoria = 'sabor' GROUP BY Pincho_idPincho ORDER BY 1 DESC");
			if ($idSabor == NULL) {
				$idSabor = " ";
			} else {
				$idSabor = mysql_fetch_array($idSabor);
			
				//puntuacion del ganador
				$puntuacionSabor = $idSabor[0];
				
				//nombre de idPincho ganador
				$nombreSabor = mysql_query("SELECT nombre FROM pincho WHERE idPincho = '$idSabor'");
				$nombreSabor = mysql_fetch_array($nombreSabor);
				$nombreSabor = $nombreSabor[0];
			}
			//-- JURADO PROFESIONAL -- SABOR
			
			//---------------------------------
			
			//-- JURADO PROFESIONAL -- PRESENTACION
			//idPincho ganador de categoria ingenio
			$idPresentacion = mysql_query("SELECT SUM(puntuacion),Pincho_idPincho FROM voto WHERE categoria = 'presentacion' GROUP BY Pincho_idPincho ORDER BY 1 DESC");
			if ($idPresentacion == NULL) {
				$idPresentacion = " ";
			} else {
				$idPresentacion = mysql_fetch_array($idPresentacion);
				
				//puntuacion del ganador
				$puntuacionPresentacion = $idPresentacion[0];
				
				//nombre de idPincho ganador
				$nombrePresentacion = mysql_query("SELECT nombre FROM pincho WHERE idPincho = '$idPresentacion'");
				$nombrePresentacion = mysql_fetch_array($nombrePresentacion);
				$nombrePresentacion = $nombrePresentacion[0];
			}
			//-- JURADO PROFESIONAL -- PRESENTACION
			
			
			/*//conseguir votos
			$votos = mysql_query("SELECT COUNT(puntuacion) FROM voto WHERE categoria=popular");
			$votos = mysql_fetch_array($votos);*/
			
			require_once(__DIR__."/../View/Admins/consultarPuntuacion.php");
		}
	}
?>