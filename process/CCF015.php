<?php include("../inc/conn.php") ?>
<?php include("../inc/func.php") ?>
<?php if(!isset($_COOKIE['GO'])){Locate('index.php?3R');} ?>
<?php
	if(isset($_GET['jsoncallback']) && !empty($_GET['jsoncallback']))
	{
		$array=array();
		if(isset($_GET['Carga2BD']))
		{
			$Errores='';
			$ripsBD->query("TRUNCATE `us`");
			$ripsBD->query("TRUNCATE `ct`");
			$ripsBD->query("TRUNCATE `au`");
			$ripsBD->query("TRUNCATE `at`");
			$ripsBD->query("TRUNCATE `ap`");
			$ripsBD->query("TRUNCATE `am`");
			$ripsBD->query("TRUNCATE `an`");
			$ripsBD->query("TRUNCATE `ah`");
			$ripsBD->query("TRUNCATE `af`");
			$ripsBD->query("TRUNCATE `ac`");
			$ripsBD->query("TRUNCATE `us_af`");
			$ripsBD->query("TRUNCATE `zfechas`");
			$Dir=scandir('../tmp');
			foreach ($Dir as $key => $txt)
			{
				if($txt!='..' && $txt!='.')
				{
					$Tabla= strtolower(substr($txt, 0,2));
					$query="LOAD DATA INFILE '";
					$query.=substr($_SERVER['SCRIPT_FILENAME'],0,20)."tmp/{$txt}";
					$query.="' INTO TABLE $Tabla FIELDS TERMINATED BY  ',' LINES TERMINATED BY '";
					$query.=addcslashes(" n",' ');
					$query=str_replace(" n", "n", $query);
					$query.="'";
					if(!$ripsBD->query($query))
					{
						$Errores="Tabla $Tabla Error:". $ripsBD->error;
					}
				}
			}
			if(!empty($Errores))
			{
				$array['msg']=$Errores;
				$array['typeMsg']='error';
			}
			else
			{
				$array['msg']="Archivos Cargados a la BD";
				$array['typeMsg']='success';
				DeleteAll("../tmp");
			}
		}
		if(isset($_GET['PROC']))
		{
			$array['ErrLog']='';
			switch ($_GET['PROC'])
			{
				case 'GRALES':
					if($_GET['SRV']=='UR'){	$ripsBD->query("CALL DelAut"); }
			        $ripsBD->query("CALL personal");
			        $ripsBD->query("CALL CargaUs_af");
					$ripsBD->query("CALL HomologadorOld");
					$ripsBD->query("CALL DelEnter");
					$ripsBD->query("CALL Del00");
					$ripsBD->query("CALL RepTotal");
					$ripsBD->query("CALL CIE10");
					$URL=explode("/", $_SERVER['PHP_SELF']);
                    $EPS=str_replace(".php", '', $URL[3]);
                    $RS=$ripsBD->query("SELECT ".$_GET["REG"]." AS EPS, PLAN_".$_GET["REG"]." AS PLAN,COMISION,DESCUENTOS,NUM_POLIZA FROM x_eps where cod='$EPS'");
                    $RW=$RS->fetch_assoc();
					$ripsBD->query("CALL RepCodEPS('".$RW['EPS']."')");
					$TIPO = ($_GET["REG"]=='S') ? 2 : 1 ;
					$ripsBD->query("UPDATE us SET TIPO_USUARIO=$TIPO");
					$ripsBD->query("CALL RepAF('".$RW['PLAN']."','".$RW['NUM_POLIZA']."','".$RW['COMISION']."','".$RW['DESCUENTOS']."')");
				break;
				case 'US':
					//Correccion de Edades
					$RS_US=$ripsBD->query("SELECT TIPO_DOC AS TD, IDENTIFICACION AS NUM FROM us");
					while($RW_US=$RS_US->fetch_assoc())
					{
						$TD=$RW_US["TD"];
						$NUM=$RW_US["NUM"];
						$Q1=$ripsBD->query("SELECT TD, NUM FROM x_ccf015_us WHERE NUM='$NUM' AND TD='$TD'");
						if($Q1->num_rows<1)
						{
							$Q2=$ripsBD->query("SELECT TD, NUM FROM x_ccf015_us WHERE NUM='$NUM'");
							if($Q2->num_rows>=1)
							{
								$RW_Q2=$Q2->fetch_assoc();
								$ripsBD->query("CALL ChangeDoc('".$RW_Q2['TD']."'{$TD}','{$NUM}','{$NUM}'");
							}
							else
							{
								$array['ErrLog'].='Identificacion '.$TD.'_'.$NUM.' NO es Correcta\n';
							}
						}
					}
					$ripsBD->query("CALL CorrEdades");
					$ripsBD->query("UPDATE `us` SET `ZONA_RESIDENCIAL`='U' WHERE `ZONA_RESIDENCIAL`<>'U' AND `ZONA_RESIDENCIAL`<>'R';");
					$ripsBD->query("UPDATE us INNER JOIN x_dane ON NOT EXISTS (SELECT 1 FROM x_dane WHERE x_dane.depto = us.COD_DEPARTAMENTO AND x_dane.munic = us.COD_MUNICIPIO) SET us.COD_DEPARTAMENTO='47', us.COD_MUNICIPIO='288'");
					$array['msg']=$array['ErrLog'];
					$array['typeMsg']='error';
				break;
			}
		}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		//if(isset($_GET[''])){}
		echo $_GET['jsoncallback'].'('.json_encode($array).')';
	}
?>