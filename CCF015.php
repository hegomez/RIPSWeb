<?php include("inc/conn.php") ?>
<?php include("inc/func.php") ?>
<?php if(!isset($_COOKIE['GO'])){Locate('index.php?3R');} DeleteAll('tmp');?>
<?php include("inc/head.php") ?>
<section class="content">
    <div class="row">
        <div class="col-lg-3">
			<div class="input-group">
				<div class="input-group-addon"><i class="far fa-clipboard"></i></div>
				<select class="form-control" id="SRV" name="SRV">
					<option value="CE">Consulta Externa</option>
					<option value="UR">Urgencias</option>
					<option value="HS">Hospitalizacion</option>
				</select>
			</div>
			<div class="sepatador"></div>
			<div class="input-group">
				<div class="input-group-addon"><i class="fas fa-user"></i></div>
				<select class="form-control" id="REG" name="REG">
					<option value="S">Subsidiado</option>
					<option value="C">Contributivo</option>
				</select>
			</div>
			<div class="sepatador"></div>
			<div class="input-group">
				<div class="input-group-addon"><i class="fas fa-barcode"></i></div>
				<input class="form-control" autocomplete="off" type="text" value="" name="REM" id="REM" placeholder="Remisión" >
			</div>
			<div class="sepatador"></div>
            <div id="fileuploader">Cargar</div>
			<div id="fileproess" style="display: none">
				<a class="btn btn-default" id="btnFileProc" href="javascript:void(0)"><i class="fas fa-database"></i> Procesar</a>
			</div>
        </div>
        <div class="col-lg-5">
        	<span class="ProgressPRC"></span>
        	<div id="ProgressPRC"></div>
        </div>
	</div>
</section>

<!-- Ini Modales -->

<!-- Fin Modales -->

<?php include("inc/pref.php") ?>
<script type="text/javascript">
    var archivoValidacion = "PROC.php?jsoncallback=?";
	var archivoProceos = "process/<?php echo $URL[2] ?>?jsoncallback=?";
	var SRV, REG, REM;
    $(document).ready(function(){
        $("#fileuploader").uploadFile({
			url:"upload.php",
			fileName:"myfile",
			uploadStr:"Cargar",
			dragDropStr: '<span class="form-control reset-control">Arrastrar RIPS aqui</span>'
		});
		
        $('#ProgressPRC').LineProgressbar({
			percentage: 0,
			fillBackgroundColor: '#1abc9c',
			height: '20px'
		});

		//Carga de Procesos
		$("#btnFileProc").click(function(){
			if($("#REM").val()=='' || $("#REM").val()==0 || $("#REM").val()=='0')
			{
				$("#REM").notify("Debe escribir la Remision",{ position:"right middle" });
			}
			else
			{
				SRV=$("#SRV").val();
				REG=$("#REG").val();
				REM=$("#REM").val();
				var Carga2BD='SET';
				$.getJSON( archivoProceos, { Carga2BD:Carga2BD })
				.done(function(D) {
					$.notify(D.msg, D.typeMsg);
					$(".ProgressPRC").text("Carga de los planos en BD");
					$('#ProgressPRC').progressTo(5);
					$.getJSON( archivoProceos, { PROC:'GRALES',SRV:SRV,REG:REG,REM:REM })
					.done(function(D) {
						$(".ProgressPRC").text("Procedimientos Generales");
						$('#ProgressPRC').progressTo(10);
						$.getJSON( archivoProceos, { PROC:'US',SRV:SRV,REG:REG,REM:REM })
						.done(function(D) {
							$(".ProgressPRC").text("Procedimientos US");
							$('#ProgressPRC').progressTo(15);
							$.notify(D.msg, D.typeMsg);
						});
					});
				});
			}
		});
		
    });
	$(document).on("submit","form",function(){
		setTimeout(function(){
			$(".ajax-file-upload-statusbar").fadeOut();
			
			$("#fileuploader").fadeOut();
			$("#fileproess").fadeIn();
		}, 2000);
	});
</script>
<?php include("inc/foot.php") ?>
