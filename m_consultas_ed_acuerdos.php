<?php
//inclumos la base de datos
include("./Connections/cx.php");
//inlcuimos lso calendarios
include("scrips/calendario/calendario.php");

//incluimos libreria paginacion;

include ( 'scrips/pag_lib/PHPPaging.lib.php');

//esctraemos todas las variables
extract($_REQUEST);
//icniaializacmos las secciones
session_start();
mysql_query("SET NAMES UTF8");//cotejamiento uft8 para mysql repara problas del navegador envio y recepsion de datos
if(!isset($_SESSION["login"]))
{
$insert=mysql_query("INSERT INTO bitacora (text) VALUES('Acceso de Intruso fallido al  Área de Mantenimiento')");
header("location: index.php");
}
if($_SESSION['tipo']=='u1' )
{
header("location: m_consultas.php");
}

//desturi session
if(isset($des))
{	
	//echo "<h1>funca</h1>";
		//unset($_SESSION['login']);
		$insert=mysql_query("INSERT INTO bitacora (text) VALUES('$_SESSION[name] Cerro Sessión')");
		session_destroy();
		
		header("location: index.php");
		
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/plantilla_1.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Registro Actas</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<script language="javascript" src="scrips/calendario/javascripts.js"></script>


<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">
<div id="header">
<div id="logo">
<h1 id="sitename"><img src="img/logo1.png"  /><span class="green"></span></h1>
<h2 class="description">&nbsp;</h2>
</div>
<div id="headercontent"><!-- InstanceBeginEditable name="EditRegion_session" -->
<form method="post" name="session" enctype="application/x-www-form-urlencoded"> 
<table width="295" border="0" align="center" background="">
  <tr>
    <td colspan="4" align="center"><h2>Bienvenid@: </h2></td>
  </tr>
  <tr>
    <td width="95" align="center"><img src="img/personas/<?php echo $_SESSION['img']; ?>"  width="50 px" height="70 px" title=" <?php echo $_SESSION['name']; ?>" alt=" <?php echo $_SESSION['name']; ?>"/></td>
    <td width="165" colspan="3" align="center"><h2><?php echo $_SESSION['name']; ?> </h2> </td>
    </tr>
    <tr>
    	<td colspan="4" align="center"><input type="submit"
        name="des" value="Cerrar Sesión"   />      </td>
    </tr>
  </table>
</form>
<!-- InstanceEndEditable --></div>
<div id="sitecption"><!-- InstanceBeginEditable name="EditRegion_tex2" -->
<p>Alcaldía  <span class="bigger">Municipal</span></p>
  <p> de Usulután</p>
<!-- InstanceEndEditable --></div>
</div>
<div id="main">
<div id="menus">
	<!-- InstanceBeginEditable name="EditRegion_menu" -->
    <div id="mainmenu">
    
    <ul>
    <li class="first"><a href="inicio.php">Inicio</a></li>
    <li ><a href="m_registro.php" >Registro</a></li>
    <li id="active"><a href="m_consultas.php">busquedas</a></li>
    <li><a href="contruccion_reportes.php">reportes</a></li>
    <li><a href="m_mantenimiento.php">Mantenimiento</a></li>
   <li><a href="#">salir</a></li>
    <li><a href="#">&nbsp;</a></li>
    
    </ul>
  
    </div>
   
    <div id="submenu">
  
    
    <li><a href="m_consultas_im_actas.php">Impresion Actas</a></li>
    <li><a href="m_consultas_im_acuerdos.php">Impresion de Acuerdos</a></li>
    <li><a href="m_consultas_ed_actas.php">Editar Actas</a> </li>
    <li><a href="#">Editar Acuerdos</a></li>

    </div>
    <!-- InstanceEndEditable -->
</div>

<div id="content">
    <div id="center" align="center"  ><!-- InstanceBeginEditable name="center" -->
     

<div align="center">

<table width="85%" border="0" cellspacing="5" align="center">
  <tr>
  
    <td align="center"><h2 >Edición  de Acuerdos</h2></td>
  </tr>
  <tr>
    <td align="center">
    		
            	
                    <form method="get" enctype="multipart/form-data" name="impre_acu_acta">
                    <table border="0" cellpadding="5" cellspacing="5">
                    	<tr>
                        	<td><input type="text" name="c1" id="c1" size="10" /></td>
                            <td><input type="text" name="nacuerdo" size="10"  /></td>
                            <td><input type="text" name="desc" maxlength="250"/></td>
                            <td><input type="text"  name="c2" readonly="readonly" onclick="muestraCalendario('','impre_acu_acta','c2')" /></td>
                            
                            <td><input type="text"  name="c3" readonly="readonly" onclick="muestraCalendario('','impre_acu_acta','c3')" /></td>
                            <td> <input type="submit" name="buscar" value="Buscar"  />  </td>
                            
                        </tr>
                        <tr>
                        	<td align="center"><input type="checkbox" name="ck1" checked="checked" />
Por N&deg; Acta </td>
                            <td align="center"><input type="checkbox" name="ck2"  />
por N&deg; Acuerdo</td>
                            <td ><input type="checkbox" name="ck3"  />
                              por Palabra Clave</td>
                            <td ><input type="checkbox" name="ck4"  />
                            &nbsp;Por Rango de Fecha </td>
                            <td align="left">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                        </tr>
                    </table>
                    
                    
                    </form>
                
    
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<br />
        
    	<?php
		extract($_REQUEST);

if(isset($buscar))
{
		
			//funciones
			
		
			
		
				
					
			$query="SELECT actas.act_num, actas.act_id, actas.act_fecha, acuerdos.acu_num, acuerdos.acu_id, acuerdos.acu_desc  FROM per_consejo, actas, acuerdos WHERE actas.act_id=acuerdos.acu_actid AND actas.act_num LIKE '%$c1%'AND per_consejo.per_consejo_id=actas.act_conid AND per_consejo.per_activo=1"; //query por defaul
			if(isset($ck2))
			{
				$query.=" AND acuerdos.acu_num LIKE '%$nacuerdo%'";
			}
			if(isset($ck3))
			{
				//$desc=utf8_decode($desc);
				$query.=" AND acuerdos.acu_tex0 LIKE '%$desc%'";
			}
			
			if(isset($ck4))
				{
					//trado de la fecha
			@$part=explode('-',$c2);
			@$date=$part[2]."-".$part[1]."-".$part[0];
			@$part2=explode('-',$c3);
			@$date2=$part2[2]."-".$part2[1]."-".$part2[0];
			//fin fecha
					$query.=" AND date(act_fecha) BETWEEN '$date' AND '$date2' ";
				} 
				
				//consulta ejecutada
				$query.=" ORDER BY actas.act_id, acuerdos.acu_num";
				$consul=mysql_query($query);
				if(mysql_num_rows($consul) > 0)
				{
					// tabla si se afecto columnas
					echo " <table border='0' cellspacing=\"0\" width=\"500 px\" >
						<tr>
							<th>N&deg; de acta&nbsp;</th>
							<th>&nbsp;N&deg; de acuerdo&nbsp;</th>
							<th>&nbsp;&nbsp;Fecha de realizacion&nbsp;&nbsp;</th>
							<th>Descripcion&nbsp;&nbsp;</th>
							<th>Acuerdos</th>
							
						
						</tr>
					";
					
	//incia paginacion
	
	
	
					
					
					$paging = new PHPPaging;
						$paging->modo('publicacion');
						$mantenerURLVar = array('paginasok', 'hi','c1','c2','c3'); 	
					
					//hacemos la consulta SQL que mostrará los resultados
					$paging->agregarConsulta("$query");
					
					//  Ejecutamos la paginación
					   $paging->ejecutar(); 
					
					//color de columna
					$numero=0;
					
					//un bucle de repeticion para mostrar la información
					while($f= $paging->fetchResultado()) 
					{
						$activa=mysql_query("select * from actas where  act_id=$f[act_id]");
						$valida=mysql_fetch_array($activa);
						
							$date_p=explode('-',$f['act_fecha']);
							$date_leer=$date_p['2'].'-'.$date_p['1'].'-'.$date_p['0'];
												
							$query_acta=mysql_query("SELECT * FROM actas WHERE act_id=$f[act_id] AND estado='cerrado'");
													
							$validacion=mysql_num_rows($query_acta);
							if($validacion==0)
							{
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>&nbsp;".$f['act_num']."&nbsp;</td>
										<td><font color='white'>&nbsp;".$f['acu_num']."&nbsp;</font></td>
										<td><font color='white'> &nbsp;".$date_leer."&nbsp;</td>
										<td><font color='white'> &nbsp;".$f['acu_desc']."</font></td>
										<td><font color='white'>&nbsp;<a href=\"m_consultas_ed_ac_edit.php?acu=".$f['acu_id']."&acta=".$f['act_id']."\" target=\"_self\" ><img src=\"img/acuerdos_edit.png\" width=\"60 px\" title=\"Editar Acuerdo\" ></a> </td>
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>".$f['act_num']."&nbsp;</td>
											<td>&nbsp;".$f['acu_num']."&nbsp;</td>
											<td>".$date_leer."</td>
											<td>".$f['acu_desc']."</td>
											<td><font color='white'>&nbsp;<a href=\"m_consultas_ed_ac_edit.php?acu=".$f['acu_id']."&acta=".$f['act_id']."\" target=\"_self\" ><img src=\"img/acuerdos_edit.png\" width=\"60 px\" title=\"Editar Acuerdo\" ></a> </td>
											
										</tr>";
								
								}
							}
							else
							{
								if($numero%2==0)
								{
								echo "<tr align=center bgcolor='#BDBDBD'>
										<td><font color='white'>&nbsp;".$f['act_num']."&nbsp;</td>
										<td><font color='white'>&nbsp;".$f['acu_num']."&nbsp;</font></td>
										<td><font color='white'> &nbsp;".$date_leer."&nbsp;</td>
										<td><font color='white'> &nbsp;".$f['acu_desc']."</font></td>
										<td><font color='white'>&nbsp;<img src=\"img/acuerdos_lock.png\" width=\"60 px\" title=\"Acuerdo Cerrado\"></td>
									</tr>";
								}
								else
								{
									echo "<tr align=center>
											<td>".$f['act_num']."&nbsp;</td>
											<td>&nbsp;".$f['acu_num']."&nbsp;</td>
											<td>".$date_leer."</td>
											<td>".$f['acu_desc']."</td>
											<td><font color='white'>&nbsp;<img src=\"img/acuerdos_lock.png\" width=\"60 px\" title=\"Acuerdo Cerrado\" ></td>
											
										</tr>";
								
								}
							
							
							
							
							
							
							}
								
								
								
								
	
							
							
							
								
								
								
								
								
	
							
							
							
							
						
							
								
							
						$numero+=1;
					}
					
					//Mostrarmos la cantidad de paginas enlas que se mostraran toda la informacion
					echo "
							<tr>
								<td colspan='5' align='center'>
									&nbsp;
								</td>
							</tr>
							<tr >
							<th colspan='5' align='center'>
							Página ".$paging->numEstaPagina()." de ".$paging->numTotalPaginas()."<br />
								Mostrando ".$paging->numRegistrosMostrados()." resultados, del ".$paging->numPrimerRegistro()." al ".$paging->numUltimoRegistro()." de un total de ".$paging->numTotalRegistros()."
							<td>
							</tr>
						<tr >
							<th colspan='5' align='center'>Paginas ".$paging->fetchNavegacion()."
							</tr>";
						//eliminamos datos enviado en javascrip
						
			
	
	//fin paginacion
					
					echo "</table><br />";
					
				}
				
				  
			
		}






?>
    </td>
  </tr>

</table>

  </a>


    </div
>
    <!-- InstanceEndEditable -->
    </div>
<div class="clear"></div>



</div>
</div>
<div id="footer">
Aplicaion_actas&amp;acuerdos &copy; Todos los Derechos reservados 2012<br />

Tec. Oscar René Sánchez<br />
version 0.2.0</div>



</div>
</body>
<!-- InstanceEnd --></html>
