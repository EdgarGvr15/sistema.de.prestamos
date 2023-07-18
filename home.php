 <!-- Header-->
 <header class="bg-dark py-2" id="main-header">
    <div class="container px-4 px-lg-2 my-2">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder"><?php echo $_settings->info('name') ?></h1>
            
        </div>
    </div>
</header>

<div class="container px-1 px-lg-1 my-3">
        <div class="text-center text-white">
<button class="btn btn-lg btn-primary active" type="button" id="create_appointment">Solicitud de prestamos de equipos</button>
</div>
    </div>
<!-- Section-->
<?php 
$sched_arr = array();
$max = 0;
?>
<section class="py-0">
    <div class="container px-1 px-lg-5 mt-2">
        
    <?php include('about.html') ?>
        
    </div>
</section>
<script>
    $(function(){
        $('#create_appointment').click(function(){
			uni_modal("Formulario de prestamos de equipos","admin/appointments/manage_appointment.php",'mid-large')
		})
   })
</script>