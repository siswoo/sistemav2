<?php
session_start();
if(@$_SESSION["camaleonapp_id"]=='' or @$_SESSION["camaleonapp_id"]==null){
	include("../expirada1.php");
	exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link href="../resources/fontawesome/css/all.css" rel="stylesheet">
    <link href="../resources/lightbox/src/css/lightbox.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/header.css">
    <title>Camaleon Sistem</title>
  </head>
<body>

<?php
include("../script/conexion.php");
include("../permisologia.php");
include("../header.php");
$sqlub1 = "SELECT * FROM modulos WHERE nombre = '".$ubicacion_actual_modulo."'";
$procesoub1 = mysqli_query($conexion,$sqlub1);
while($rowub1 = mysqli_fetch_array($procesoub1)) {
	$id_moduloub1 = $rowub1["id"];
}
$sqlp2 = "SELECT * FROM funciones_usuarios WHERE id_usuarios = ".$_SESSION["camaleonapp_id"]." and id_modulos = ".$id_moduloub1;
$procesoub2 = mysqli_query($conexion,$sqlp2);
while($rowub2 = mysqli_fetch_array($procesoub2)) {
	$modulo_crear = $rowub2["crear"];
	$modulo_modificar = $rowub2["modificar"];
	$modulo_eliminar = $rowub2["eliminar"];
}
?>

<div class="container mt-3">
	<div class="row">
		<input type="hidden" name="datatables" id="datatables" data-pagina="1" data-consultasporpagina="10" data-filtrado="" data-sede="" data-estatus="">
		<div class="col-3 form-group form-check">
			<label for="consultasporpagina" style="color:black; font-weight: bold;">Consultas por Página</label>
			<select class="form-control" id="consultasporpagina" name="consultasporpagina">
				<option value="10">10</option>
				<option value="20">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
		</div>
		<div class="col-3 form-group form-check">
			<label for="buscarfiltro" style="color:black; font-weight: bold;">Buscar</label>
			<input type="text" class="form-control" id="buscarfiltro" name="buscarfiltro">
		</div>
		<div class="col-2 form-group form-check">
			<label for="m_estatus" style="color:black; font-weight: bold;">Estatus</label>
			<select class="form-control" id="m_estatus" name="m_estatus">
				<option value="">Todos</option>
				<option value="2">Activos</option>
				<option value="3">Inactivos</option>
			</select>
		</div>
		<div class="col-3 form-group form-check">
			<label for="consultaporempresa" style="color:black; font-weight: bold;">Consultas por Empresa</label>
			<select class="form-control" id="consultaporempresa" name="consultaporempresa">
				<option value="">Todos</option>
				<?php
					$sql1 = "SELECT * FROM empresas";
					$proceso1 = mysqli_query($conexion,$sql1);
						while($row1 = mysqli_fetch_array($proceso1)) {
							echo '
								<option value="'.$row1["id"].'">'.$row1["nombre"].'</option>
							';
						}
				?>
			</select>
		</div>
		<div class="col-1">
			<br>
			<button type="button" class="btn btn-info mt-2" onclick="filtrar1();">Filtrar</button>
		</div>
	</div>
</div>

<div id="resultado_table1">Aqui!</div>

<!------------------------>
<input type="hidden" name="usuario_id" id="usuario_id">
<!------------------------>

<!-- Modal personales1 -->
	<div class="modal fade" id="personales1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="#" method="POST" id="personales1_form" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">MODIFICAR DATOS</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					  <div class="row">
					  	<div class="col-12 form-group form-check">
							  <label for="personales1_documento_tipo" style="font-weight: bold;">Documento Tipo</label>
							  <select class="form-control" name="personales1_documento_tipo" id="personales1_documento_tipo" required>
								  <?php
								    $sql3 = "SELECT * FROM documento_tipo";
								    $proceso3 = mysqli_query($conexion,$sql3);
										while($row3 = mysqli_fetch_array($proceso3)) {
											$documento_tipo_id = $row3["id"];
											$documento_tipo_nombre = $row3["nombre"];
											echo '
												<option value="'.$documento_tipo_id.'">'.$documento_tipo_nombre.'</option>
											';
										}
									?>
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_documento_numero" style="font-weight: bold;">Documento Numero</label>
							  <input type="text" id="personales1_documento_numero" name="personales1_documento_numero" class="form-control" required>
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_nombre1" style="font-weight: bold;">Primer Nombre</label>
							  <input type="text" id="personales1_nombre1" name="personales1_nombre1" class="form-control" required>
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_nombre2" style="font-weight: bold;">Segundo Nombre</label>
							  <input type="text" id="personales1_nombre2" name="personales1_nombre2" class="form-control">
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_apellido1" style="font-weight: bold;">Primer Apellido</label>
							  <input type="text" id="personales1_apellido1" name="personales1_apellido1" class="form-control" required>
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_apellido2" style="font-weight: bold;">Segundo Apellido</label>
							  <input type="text" id="personales1_apellido2" name="personales1_apellido2" class="form-control" required>
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_correo" style="font-weight: bold;">Correo Personal</label>
							  <input type="text" id="personales1_correo" name="personales1_correo" class="form-control" required>
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_telefono" style="font-weight: bold;">Telefono</label>
							  <input type="number" id="personales1_telefono" name="personales1_telefono" class="form-control" required>
								</select>
						  </div>
						  <div class="col-12 form-group form-check">
							  <label for="personales1_direccion" style="font-weight: bold;">Correo Dirección</label>
							  <textarea class="form-control" id="personales1_direccion" name="personales1_direccion" required></textarea>
								</select>
						  </div>
						</div>
					</div>
					<div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				    <button type="submit" class="btn btn-success" id="submit_personales1">Guardar</button>
			    </div>
			  </div>
		  </form>
	  </div>
	</div>
<!---------------------------------------->

<!-- Modal permisos1 -->
	<div class="modal fade" id="permisos1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="#" method="POST" id="permisos1_form" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">MODIFICAR PERMISOS</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					  <div class="row" id="permisos1_html1"></div>
					</div>
					<div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				    <button type="submit" class="btn btn-success" id="submit_permisos1">Guardar</button>
			    </div>
			  </div>
		  </form>
	  </div>
	</div>
<!---------------------------------------->

<!-- Modal permisos2 -->
	<div class="modal fade" id="permisos2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form action="#" method="POST" id="permisos2_form" style="">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">AGREGAR PERMISOS</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					  <div class="col-12 form-group form-check">
							<label for="permisos2_modulo" style="font-weight: bold;">Modulo</label>
							<select class="form-control" name="permisos2_modulo" id="permisos2_modulo" onchange="permisos2_select(value,1);" required>
								<option value="">Seleccione</option>
								<?php
									$sql3 = "SELECT * FROM modulos WHERE estatus = 1 ORDER BY orden ASC";
									$proceso3 = mysqli_query($conexion,$sql3);
									while($row3 = mysqli_fetch_array($proceso3)) {
										$documento_tipo_id = $row3["id"];
										$documento_tipo_nombre = $row3["nombre"];
										echo '
											<option value="'.$documento_tipo_id.'">'.$documento_tipo_nombre.'</option>
										';
									}
								?>
							</select>
						</div>
						<div class="col-12 form-group form-check" id="permisos2_html1"></div>
						<div class="col-12 form-group form-check" id="permisos2_html2"></div>
					</div>
					<div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				    <button type="submit" class="btn btn-success" id="submit_permisos2">Guardar</button>
			    </div>
			  </div>
		  </form>
	  </div>
	</div>
<!---------------------------------------->

</body>
</html>

<script src="../js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap4.min.js"></script>
<script src="../resources/lightbox/src/js/lightbox.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>

	$(document).ready(function() {
		filtrar1();
		setInterval('filtrar1()',3000);
	} );

	function filtrar1(){
		var input_consultasporpagina = $('#consultasporpagina').val();
		var input_buscarfiltro = $('#buscarfiltro').val();
		var input_consultaporempresa = $('#consultaporempresa').val();
		var input_m_estatus = $('#m_estatus').val();
		
		$('#datatables').attr({'data-consultasporpagina':input_consultasporpagina})
		$('#datatables').attr({'data-filtrado':input_buscarfiltro})
		$('#datatables').attr({'data-sede':input_consultaporempresa})
		$('#datatables').attr({'data-estatus':input_m_estatus})

		var pagina = $('#datatables').attr('data-pagina');
		var consultasporpagina = $('#datatables').attr('data-consultasporpagina');
		var empresa = $('#datatables').attr('data-sede');
		var filtrado = $('#datatables').attr('data-filtrado');
		var m_estatus = $('#datatables').attr('data-estatus');
		var ubicacion_url = '<?php echo $ubicacion_url; ?>';

		$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			dataType: "JSON",
			data: {
				"pagina": pagina,
				"consultasporpagina": consultasporpagina,
				"empresa": empresa,
				"filtrado": filtrado,
				"m_estatus": m_estatus,
				"link1": ubicacion_url,
				"condicion": "table1",
			},

			success: function(respuesta) {
				//console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					$('#resultado_table1').html(respuesta["html"]);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	function paginacion1(value){
		$('#datatables').attr({'data-pagina':value})
		filtrar1();
	}

	$('#myModal').on('shown.bs.modal', function () {
	  	$('#myInput').trigger('focus')
	});

	function editar1(usuario_id){
		$('#usuario_id').val(usuario_id);
		$('#permisos2_modulo').val("");
		$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			dataType: "JSON",
			data: {
				"usuario_id": usuario_id,
				"condicion": "consulta1",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					$('#personales1_nombre1').val(respuesta["nombre1"]);
					$('#personales1_nombre2').val(respuesta["nombre2"]);
					$('#personales1_apellido1').val(respuesta["apellido1"]);
					$('#personales1_apellido2').val(respuesta["apellido2"]);
					$('#personales1_documento_tipo').val(respuesta["documento_tipo"]);
					$('#personales1_documento_numero').val(respuesta["documento_numero"]);
					$('#personales1_correo').val(respuesta["correo"]);
					$('#personales1_telefono').val(respuesta["telefono"]);
					$('#personales1_genero').val(respuesta["genero"]);
					$('#personales1_direccion').val(respuesta["direccion"]);

					$('#permisos1_html1').html(respuesta["html1"]);

					$('#permisos2_modulo').val("");
					$('#permisos2_html1').html("");
					$('#permisos2_html2').html("");
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#personales1_form").on("submit", function(e){
		e.preventDefault();
		var usuario_id = $('#usuario_id').val();
		var documento_tipo = $('#personales1_documento_tipo').val();
		var documento_numero = $('#personales1_documento_numero').val();
		var nombre1 = $('#personales1_nombre1').val();
		var nombre2 = $('#personales1_nombre2').val();
		var apellido1 = $('#personales1_apellido1').val();
		var apellido2 = $('#personales1_apellido2').val();
		var correo = $('#personales1_correo').val();
		var telefono = $('#personales1_telefono').val();
		var direccion = $('#personales1_direccion').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			dataType: "JSON",
			data: {
				"usuario_id": usuario_id,
				"documento_tipo": documento_tipo,
				"documento_numero": documento_numero,
				"nombre1": nombre1,
				"nombre2": nombre2,
				"apellido1": apellido1,
				"apellido2": apellido2,
				"correo": correo,
				"telefono": telefono,
				"direccion": direccion,
				"condicion": "editar1",
			},

			success: function(respuesta) {
				//console.log(respuesta);

				if(respuesta["estatus"]=="ok"){
					Swal.fire({
						title: 'Correcto!',
						text: respuesta["msg"],
						icon: 'success',
					});

				}else if(respuesta["estatus"]=="error"){
					Swal.fire({
						title: 'Error',
						text: respuesta["msg"],
						icon: 'error',
					})
				}

			},

			error: function(respuesta) {
				console.log(respuesta["responseText"]);
			}
		});
	});

	function permisos2_select(value,select){
		$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			dataType: "JSON",
			data: {
				"value": value,
				"select": select,
				"condicion": "permisos2_select",
			},

			success: function(respuesta) {
				console.log(respuesta);
				if(respuesta["estatus"]=="ok"){
					if(select=='1'){
						$('#permisos2_html1').html(respuesta["html1"]);
						$('#permisos2_html2').html("");
					}else if(select=='2')
					$('#permisos2_html2').html(respuesta["html2"]);
				}
			},

			error: function(respuesta) {
				console.log(respuesta['responseText']);
			}
		});
	}

	$("#permisos2_form").on("submit", function(e){
		e.preventDefault();
		var usuario_id = $('#usuario_id').val();
		var permisos2_modulo = $('#permisos2_modulo').val();
		var permisos2_submodulo = $('#permisos2_submodulo').val();
		var permisos2_multiple = $('#permisos2_multiple').val();

		$.ajax({
			type: 'POST',
			url: '../script/crud_usuarios.php',
			dataType: "JSON",
			data: {
				"usuario_id": usuario_id,
				"permisos2_modulo": permisos2_modulo,
				"permisos2_submodulo": permisos2_submodulo,
				"permisos2_multiple": permisos2_multiple,
				"condicion": "agregar_permiso1",
			},

			success: function(respuesta) {
				console.log(respuesta);

				if(respuesta["estatus"]=="ok"){
					Swal.fire({
						title: 'Correcto!',
						text: respuesta["msg"],
						icon: 'success',
					});

				}else if(respuesta["estatus"]=="error"){
					Swal.fire({
						title: 'Error',
						text: respuesta["msg"],
						icon: 'error',
					})
				}

			},

			error: function(respuesta) {
				console.log(respuesta["responseText"]);
			}
		});
	});


</script>