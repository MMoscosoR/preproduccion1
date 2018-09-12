<?php 
	echo $this->session->userdata('user_nombre');
 ?>

 <a href="<?php echo base_url() ?>Login/logout">cerrar session</a>