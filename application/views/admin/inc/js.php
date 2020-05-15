	    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/ionicons/ionicons.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/moment/moment.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/perfect-scrollbar/p-scroll.js"></script>
		<script src="<?= base_url(); ?>assets/js/sticky.js"></script>
		<script src="<?= base_url(); ?>assets/js/eva-icons.min.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/rating/jquery.rating-stars.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/rating/jquery.barrating.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/side-menu/sidemenu.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/sidebar/sidebar.js"></script>
		<script src="<?= base_url(); ?>assets/plugins/sidebar/sidebar-custom.js"></script>
		<script src="<?= base_url(); ?>assets/js/custom.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".flashd").fadeOut(5000);

				$('.danger').click(function () {
					
					var el = this;
					var id = this.id;
					var splitid = id.split("_");
					// Delete id
   					var deleteid = splitid[1];
   					var url = "<?= base_url('admin_panel/AllCourse/deleteCourse'); ?>";
		swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this Course Again! And it will delete All Subjects & Chapters with this course.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel plx!",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	$.ajax({
		     url: url,
		     type: 'POST',
		     data: { id:deleteid },
		     success: function(response){
		     	if(response == 1){
	 // Remove row from HTML Table
	 
	}
		     }
		 });
		  
	
			swal("Deleted!", "Your imaginary file has been deleted.", "success");
			location.href="<?= base_url('admin_panel/AllCourse'); ?>";
		  } else {
			swal("Cancelled", "Your imaginary file is safe :)", "error");
		  }
		});
	});


				$('.delSub').click(function () {
					
					var el = this;
					var id = this.id;
					var splitid = id.split("_");
					// Delete id
   					var deleteid = splitid[1];
   					var url = "<?= base_url('admin_panel/Subjects/deleteSubject'); ?>";
		swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this Subjects Again! And it will delete All  Chapters with this course.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-danger",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel plx!",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	$.ajax({
		     url: url,
		     type: 'POST',
		     data: { id:deleteid },
		     success: function(response){
		     	if(response == 1){
	 // Remove row from HTML Table
	 //alert(response);
	 
	}
		     }
		 });
		  
	
			swal("Deleted!", "Your Subjects file has been deleted.", "success");
			location.href="<?= base_url('admin_panel/Subjects/AddNew'); ?>";
		  } else {
			swal("Cancelled", "Your imaginary file is safe :)", "error");
		  }
		});
	});
			});
		</script>