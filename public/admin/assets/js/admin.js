$(document).ready(function(){
	$(".sub-slide-item").removeClass("active");
	$(".side-menu__item").removeClass("active");

    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            type:'post',
            url:'/admin/check-current-password',
            data:{current_password:current_password},
            success:function(resp){
                //alert(resp);
                if(resp=="false"){
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
                }else if(resp=="true"){
                    $("#check_password").html("<font color='green'>Current Password is Correct!</font>");
                }
            },error:function(){
                alert('Error')
            }
        });
    })

    //.......................Admin............................................
	$(document).on("click",".updateadminStatus",function(){
		var status = $(this).children("i").attr("status");
		var admin_id = $(this).attr("admin_id");
		$.ajax({
			headers: {
     			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  			 },
  			 type:'post',
  			 url:'/admin/update-admin-status',
  			 data:{status:status,admin_id:admin_id},
  			 success:function(resp){
  			 	if (resp['status']==0) {
					$("#admin-"+admin_id).html("<i style='font-size:150%; color: #efa06b;' class='fa-solid fa-toggle-off fa-lg' status='Inactive'></i>");
				}else{
					if (resp['status']==1) {
						$("#admin-"+admin_id).html("<i style='font-size:150%; color: #efa06b;' class='fa-solid fa-toggle-on fa-lg 'status='Active'></i>");
					}
				}
  			 },error:function(){
  			 	alert("Error");
  			 }
		});
	});

	// delete code.............................................................
	$(".confirmDelete").click(function(){
		var module = $(this).attr('module');
		var moduleid = $(this).attr('moduleid');
		//alert(moduleid);die;
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		  }).then((result) => {
			if (result.isConfirmed) {
			  Swal.fire(
				'Deleted!',
				'Your file has been deleted.',
				'success'
			  )
			  window.location = "/admin/delete-"+module+"/"+moduleid;
			}
		  })
	});

	$(document).on('submit',"#addAdmin",function(){
		//alert("text");die;
		var formData = new FormData(this);
		var id = $('#admin_id').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  },
				data:formData,
				url:'/admin/add-edit-staff/' + (id ? id : ''),
				type:'post',
				contentType: false,
				processData: false,
				success:function(resp){
				//alert(data);die;
				if(resp.type=="error"){
					$.each(resp.errors,function(i,error){
						$("#admin-"+i).attr('style','color:red');
						$("#admin-"+i).html(error);
						setTimeout(function(){
							$("#admin-"+i).css({
								'display':'none'
							});
						},10000);
					});
				}else{
					// window.location.href = "/admin/get-admin";
					Swal.fire({
					position: "top-end",
					icon: "success",
					title: "Your work has been saved",
					showConfirmButton: false, 
					timer: 1500
				  }).then(function () {
                    // Reset the form
					$('#someElementId').html(resp.data.updatedData);
                    $('#addAdmin')[0].reset();
                });
				}
				},error:function(){
					alert("Error");
				}
			});
	});

	//update post status....
	$(document).on("click",".updatePostStatus",function(){
		var status = $(this).children("i").attr("status");
		//alert(status);die;
		var value_id = $(this).attr("value_id");
		//alert(value_id);die;
		$.ajax({
			headers: {
     			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  			 },
  			 type:'post',
  			 url:'/admin/update-post-status',
  			 data:{status:status,value_id:value_id},
  			 success:function(resp){
  			 	if (resp['status']==0) {
					$("#value-"+value_id).html("<i style='font-size:150%; color: #efa06b;' class='fa-solid fa-toggle-off fa-lg' status='Inactive'></i>");
				}else{
					if (resp['status']==1) {
						$("#value-"+value_id).html("<i style='font-size:150%; color: #efa06b;' class='fa-solid fa-toggle-on fa-lg 'status='Active'></i>");
					}
				}
  			 },error:function(){
  			 	alert("Error");
  			 }
		});
	});	
});