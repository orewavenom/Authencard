  $(document).ready(function() {

      show_users_data();
      show_teacher_data();

      //$('#datatables').DataTable( {});

      setFormValidation('#addUsers');
      setFormValidationUpdate('#updateUsersData');

      $('#btns1').prop('disabled', true);

      $('input[name="startpoint"]').on('keyup', function() {
        var ep = $(this).val();
        var rowCount = parseInt($('#datatables tr').length);
        //alert(rowCount);
        //var rowCount = parseInt($('#getStudentsRows').val());
        if (parseInt(ep)>0 && parseInt(ep)<rowCount) {
          $('#btns1').prop('disabled', false);
          var val = $("."+ep+"").attr("data-id");
          if(val.length != 0) {
            //alert(val);
            $('#idGetFrom').val(val);
          }
        }else{
          $('#startpoint').val("");
          $('#btns1').prop('disabled', true);
        }

      });

      $('input[name="endpoint"]').on('keyup', function() {
        var ep = $(this).val();
        var rowCount = parseInt($('#datatables tr').length);
        //var rowCount = parseInt($('#getStudentsRows').val());
        if (parseInt(ep)>0 && parseInt(ep)<rowCount) {
          $('#btns1').prop('disabled', false);
          var val = $("."+ep+"").attr("data-id");
          if(val.length != 0) {
            //alert(val);
            $('#idGetTo').val(val);
          }
        }else{
          $('#endpoint').val("");
          $('#btns1').prop('disabled', true);
        }
        

      });


      setFormValidationSystem('#updateSystem');

        $("#settings_form").validate({
            rules: {
                upemail:{
                  required: true,
                  maxlength: 40
                },
                old_password:{
                  required: true,
                  minlength: 6
                },
                new_password: {
                  required: true,
                  minlength: 6
                },
                confirm_password: {
                    equalTo: "#new_password"
                }
            },
            messages: {
                upemail:{
                  required: "Old Email -OR- New Email is required"
                },
                old_password: {
                  required: "Enter Old Password"
                },
                new_password: {
                  required: "Enter New Password"
                },
                confirm_password: {
                  required: "Enter Confirm Password same as New Password"
                }
            },
            errorClass: "help-inline text-danger",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error');
                $(element).parents('.form-group').addClass('has-success');
            },
            submitHandler: function(form,e) {
                e.preventDefault();
                //console.log('Form submitted');
                var em = $("#upemail").val();
                var op = $("#old_password").val();
                var np = $("#new_password").val();
                var cp = $("#confirm_password").val();

                $.ajax({
                    url:'includes/update_settings.php',
                    method:'POST',
                    data:{em:em, op:op, np:np, cp:cp},
                    success: function(result) {
                      //alert("ok"+);
                        if (result=='success') {
                          $("#old_password").val('');
                          $("#new_password").val('');
                          $("#confirm_password").val('');
                          swal({
                              title: "Successfully Updated!",
                              text: "Use new password for login",
                              buttonsStyling: false,
                              confirmButtonClass: "btn btn-success",
                              type: "success"
                          }).catch(swal.noop)
                        }else if (result=='failed'){
                          swal({
                              title: "Oops, failed to update!",
                              text: "Try again later!",
                              buttonsStyling: false,
                              confirmButtonClass: "btn btn-warning",
                              type: "warning"
                          }).catch(swal.noop)
                        }else if (result=='not_match') {
                          swal({
                              title: "Confirm password does not match!",
                              text: "Enter New Password same as Confirm Password",
                              buttonsStyling: false,
                              confirmButtonClass: "btn btn-warning",
                              type: "warning"
                          }).catch(swal.noop)
                        }else if (result=='incorrect') {
                          swal({
                              title: "Incorrect Old Password!",
                              text: "Try again with correct old password!",
                              buttonsStyling: false,
                              confirmButtonClass: "btn btn-warning",
                              type: "warning"
                          }).catch(swal.noop)
                        }
                    },
                    error : function(error) {
                        swal({
                            title: "Something went wrong!",
                            text: "Try again later!",
                            buttonsStyling: false,
                            confirmButtonClass: "btn btn-warning",
                            type: "warning"
                        }).catch(swal.noop)
                    }
                });
                return false;
            }
        });



    });


    $(document).on("click", ".open-edit", function () {

        var myid = $(this).data("id");
        var mytitle = $(this).data("title");
        var myname = $(this).data("name");
        var myguardian = $(this).data("guardian");
        var myaddress = $(this).data("address");
        var myphone = $(this).data("phone");
        var myemail = $(this).data("email");
        var mydesig = $(this).data("designation");
        var mydob = $(this).data("dob");
        var myblgrp = $(this).data("blgrp");
        var mysid = $(this).data("sid");


        $("#title_name").html(myname); //userid
        $(".modal-title #title_name").val(myname);
        $(".modal-body #name").val(myname);
        $(".modal-body #guardian").val(myguardian);
        $(".modal-body #address").val(myaddress);
        $(".modal-body #phone").val(myphone);
        $(".modal-body #email").val(myemail);
        $(".modal-body #designation").val(mydesig);
        $(".modal-body #dob").val(mydob);
        $(".modal-body #blood_grp").val(myblgrp);
        $(".modal-body #sid").val(mysid);
        $(".modal-body #staffid").val(myid);
        $(".modal-body #userid").val(myid);

    });

    /******* Show Users Data *******/
    function show_users_data(){  
           $.ajax({  
                url:"includes/show_users_data.php",
                method:"POST",  
                success:function(data){  
                  $('#appen_users_data').html(data);
                  //$('#datatables').DataTable().destroy();
                  $('#datatables').DataTable({ 
                      "pagingType": "full_numbers",
                      "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                      ],
                      responsive: true,
                      language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search visitors",
                      }
                   });

                }  
           });  
    }

    function show_teacher_data(){  
           $.ajax({  
                url:"includes/show_teacher_data.php",
                method:"POST",  
                success:function(data){  
                  $('#appen_teacher_data').html(data);
                  //$('#datatables').DataTable().destroy();

                  $('#datatables1').DataTable({ 
                      "pagingType": "full_numbers",
                      "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                      ],
                      responsive: true,
                      language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search teacher",
                      }
                   });

                }  
           });  
    }


    function setFormValidationSystem(id) {
      $(id).validate({

            rules: {
                name: {
                  required: true,
                  minlength: 5
                },
                email: {
                  required: true
                },
                phone: {
                  required: true,
                  minlength: 10,
                  maxlength: 10
                },
                website: {
                  required: true
                },
                year: {
                  required: true
                }
            },
            messages: {
                name:{
                  required: "Organization Name is required"
                },
                email: {
                  required: "Email address is required"
                },
                phone:{
                  required: "Phone number is required"
                },
                website:{
                  required: "Website is required (Eg: www.abc.com)"
                },
                year:{
                  required: "Year is required"
                }
            },

        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').append(error);
        },
        submitHandler: function(form, e) {
          e.preventDefault();
          var formData = new FormData(form);
          //alert('send ok');
          $.ajax({
            url:"includes/update_system.php",
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            success: function(data){
              var data = JSON.parse(data);
              if(data.statusCode==200){
                swal({
                      title: "Success Updated!",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-success"
                    }).catch(swal.noop)

                $('#pablo').hide();
                $('#system_logo').attr('src', 'media/org_logo.png?' + new Date().getTime());

              }else if(data.statusCode==201){
                swal({
                      title: "Failed to update!",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==202){
                swal({
                      title: "Please fill all the fileds (*)",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==203){
                swal({
                      title: "Select Valid Photo<br>(Image Only Less Than 2MB)",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==204){
                swal({
                      title: "Something went wrong...",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }
            }
          });
        }
      });
    }


    function delete_student(id){

        swal({
            title: 'Are you sure want to delete?',
            text: "You won't be able to revert this student's data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Yes, Delete!',
            buttonsStyling: false
          }).then((result) => {
              if (result.value) {
                //window.location.href = "logout.php";
                var did = id;
                $.ajax({
                  url:'includes/upload.php',
                  method:'POST',
                  data:{did:did},
                  success:function(result){
                    if (result=='success') {
                      swal({
                          title: "Successfully Deleted!",
                          text: "This student is no more longer available!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-success",
                          type: "success"
                      }).catch(swal.noop)

                      $('tr#'+did+'').css('background-color', '#ccc');
                      $('tr#'+did+'').fadeOut('slow');
                      $('#datatables').DataTable().destroy();
                      show_users_data();

                    }else if (result=='failed'){
                      swal({
                          title: "Oops, failed to delete!",
                          text: "Try again later!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-warning",
                          type: "warning"
                      }).catch(swal.noop)
                    }else if (result=='error') {
                      swal({
                          title: "No student found -OR- something went wrong!",
                          text: "Try again later!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-warning",
                          type: "warning"
                      }).catch(swal.noop)
                    }
                  },
                  error:function(result){
                      swal({
                          title: "Something went wrong!",
                          text: "Try again later!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-warning",
                          type: "warning"
                      }).catch(swal.noop)
                  }
                });

              }
          })

    }

    function delete_teacher(id){

        swal({
            title: 'Are you sure want to delete?',
            text: "You won't be able to revert this teacher's data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Yes, Delete!',
            buttonsStyling: false
          }).then((result) => {
              if (result.value) {
                //window.location.href = "logout.php";
                var tid = id;
                $.ajax({
                  url:'includes/upload.php',
                  method:'POST',
                  data:{tid:tid},
                  success:function(result){
                    if (result=='success') {
                      swal({
                          title: "Successfully Deleted!",
                          text: "This Teacher is no more longer available!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-success",
                          type: "success"
                      }).catch(swal.noop)

                      $('tr#'+tid+'').css('background-color', '#ccc');
                      $('tr#'+tid+'').fadeOut('slow');
                      $('#datatables').DataTable().destroy();
                      show_users_data();

                    }else if (result=='failed'){
                      swal({
                          title: "Oops, failed to delete!",
                          text: "Try again later!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-warning",
                          type: "warning"
                      }).catch(swal.noop)
                    }else if (result=='error') {
                      swal({
                          title: "No teacher found -OR- something went wrong!",
                          text: "Try again later!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-warning",
                          type: "warning"
                      }).catch(swal.noop)
                    }
                  },
                  error:function(result){
                      swal({
                          title: "Something went wrong!",
                          text: "Try again later!",
                          buttonsStyling: false,
                          confirmButtonClass: "btn btn-warning",
                          type: "warning"
                      }).catch(swal.noop)
                  }
                });

              }
          })

    }


    function setFormValidation(id) {
      $(id).validate({

            rules: {
                type: {
                  required: true
                },
                name: {
                  required: true,
                  minlength: 5
                },
                guardian: {
                  required: true
                },
                phone: {
                  required: true,
                  minlength: 10,
                  maxlength: 10
                },
                dob: {
                  required: true
                },
                address: {
                  required: true
                },
                blood_grp: {
                  required: true
                },
                email: {
                  required: true
                }
            },
            messages: {
                type: {
                  required: "Choose any one user type"
                },
                name:{
                  required: "Name is required"
                },
                guardian: {
                  required: "Guardian Name is required"
                },
                phone:{
                  required: "Phone number is required"
                },
                dob:{
                  required: "Date of birth is required"
                },
                address:{
                  required: "Current address is required"
                },
                blood_grp:{
                  required: "Blood Group is required"
                },
                email:{
                  required: "Email address is required"
                }
            },

        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').append(error);
        },
        submitHandler: function(form, e) {
          e.preventDefault();
          var formData = new FormData(form);
          $.ajax({
            url:"includes/upload.php",
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            success: function(data){
              var data = JSON.parse(data);
              if(data.statusCode==200){
                swal({
                      title: "Success Added!",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-success"
                    }).catch(swal.noop)
                
                  $('#addUsers').each(function(){
                      $('.form-group').removeClass('has-success');
                      $('.form-group').removeClass('is-filled');
                      $('.form-check').removeClass('has-success');
                      this.reset();
                  });

                  $('#datatables').DataTable().destroy();
                  show_users_data();

              }else if(data.statusCode==201){
                swal({
                      title: "Failed Adding!",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==202){
                swal({
                      title: "User/Member already exist with same name or email",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==203){
                swal({
                      title: "Please fill all the fileds (*)",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==204){
                swal({
                      title: "Something went wrong...",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
                $( '#addUsers' ).each(function(){
                    $('.form-group').removeClass('has-success');
                    $('.form-group').removeClass('is-filled');
                    $('.form-check').removeClass('has-success');
                    this.reset();
                });
              }
            }
          });
        }
      });
    }


    function setFormValidationUpdate(id) {
      $(id).validate({

            rules: {
                type: {
                  required: true
                },
                name: {
                  required: true,
                  minlength: 5
                },
                guardian: {
                  required: true
                },
                phone: {
                  required: true,
                  minlength: 10,
                  maxlength: 10
                },
                dob: {
                  required: true
                },
                address: {
                  required: true
                },
                blood_grp: {
                  required: true
                },
                email: {
                  required: true
                },
                designation:{
                  required: true
                }
            },
            messages: {
                type: {
                  required: "Choose any one user type"
                },
                name:{
                  required: "Name is required"
                },
                guardian: {
                  required: "Guardian Name is required"
                },
                phone:{
                  required: "Phone number is required"
                },
                dob:{
                  required: "Date of birth is required"
                },
                address:{
                  required: "Current address is required"
                },
                blood_grp:{
                  required: "Blood Group is required"
                },
                email:{
                  required: "Email address is required"
                },
                designation:{
                  required: "Designation is required"
                }
            },

        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').append(error);
        },
        submitHandler: function(form, e) {
          e.preventDefault();
          var formData = new FormData(form);
          $.ajax({
            url:"includes/upload.php",
            type: "POST",
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            success: function(data){
              var data = JSON.parse(data);
              if(data.statusCode==200){
                swal({
                      title: "Success Updated!",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-success"
                    }).catch(swal.noop)
                
                $('#UpdateUser').modal('hide');
                $('#datatables').DataTable().destroy();
                show_users_data();

              }else if(data.statusCode==201){
                swal({
                      title: "Failed to update!",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==202){
                swal({
                      title: "No user Found -OR- User/Member already exist with same name or email",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else if(data.statusCode==203){
                swal({
                      title: "Please fill all the fileds (*)",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
              }else{
                swal({
                      title: "Something went wrong...",
                      buttonsStyling: false,
                      confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
                $('#datatables').DataTable().destroy();
                show_users_data();
                $('#UpdateUser').modal('hide');
              }
            }
          });
        }
      });
    }