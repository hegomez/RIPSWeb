<?php
	set_time_limit(0);
	$TiempoInicial=new DateTime(date('Y-m-d G:i:s'));

	$XML=array('US_CCF015_1.xml','US_CCF015_2.xml','US_CCF015_3.xml','US_CCF015_4.xml','US_CCF015_5.xml','US_CCF015_6.xml','US_CCF015_7.xml','US_CCF015_8.xml');
	echo'<table border="1"><tr>';
	echo'<th>BAS_REF_VALUE</th>';
	echo'<th>stipodoc</th>';
	echo'<th>sdocumento</th>';
	echo'<th>sapellido1</th>';
	echo'<th>ssegundoape</th>';
	echo'<th>snombre</th>';
	echo'<th>snombre2</th>';
	echo'<th>S_FechaNacimiento</th>';
	echo'<th>GENERO</th>';
	echo'<th>Edad</th>';
	echo'<th>fecha_afiliacion</th>';
	echo'<th>S_Municipio</th>';
	echo'<th>ESTADO</th>';
	echo'<th>activo</th>';
	echo'<th>Estado_Auditoria</th>';
	echo'<th>Nivel_Sisben</th>';
	echo'<th>Tipo_Regimen</th>';
	echo'<th>Observacion</th>';
	echo'</tr>';
	foreach ($XML as $key => $value)
	{
		$carga_xml = simplexml_load_file($value);
		foreach ($carga_xml->run_query_action_return->run_query_action_success->dataset->row as $k => $v)
		{
			echo'<tr>';
			echo'<td>'.$v->BAS_REF_VALUE.'</td>';
			echo'<td>'.$v->stipodoc.'</td>';
			echo'<td>'.$v->sdocumento.'</td>';
			echo'<td>'.$v->sapellido1.'</td>';
			echo'<td>'.$v->ssegundoape.'</td>';
			echo'<td>'.$v->snombre.'</td>';
			echo'<td>'.$v->snombre2.'</td>';
			echo'<td>'.$v->S_FechaNacimiento.'</td>';
			echo'<td>'.$v->GENERO.'</td>';
			echo'<td>'.$v->Edad.'</td>';
			echo'<td>'.$v->fecha_afiliacion.'</td>';
			echo'<td>'.$v->S_Municipio.'</td>';
			echo'<td>'.$v->ESTADO.'</td>';
			echo'<td>'.$v->activo.'</td>';
			echo'<td>'.$v->Estado_Auditoria.'</td>';
			echo'<td>'.$v->Nivel_Sisben.'</td>';
			echo'<td>'.$v->Tipo_Regimen.'</td>';
			echo'<td>'.$v->Observacion.'</td>';
			echo'</tr>';
		}
	}

	$MUNIC='PIVIJAY';
	$NUM=5000;


	echo'</table>';
    echo "<br>Fue un Total de <strong>$TiempoTotal</strong><br>";

?>