	$(document).ready(function() {
        $(".form-group").removeClass("bmd-form-group");

        $sidebar = $(".sidebar"), image_src = $sidebar.data("image"), void 0 !== image_src && (sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>', $sidebar.append(sidebar_container));

    });

    isWindows = -1 < navigator.platform.indexOf("Win"), isWindows ? ($(".sidebar .sidebar-wrapper, .main-panel, .main").perfectScrollbar(), $("html").addClass("perfect-scrollbar-on")) : $("html").addClass("perfect-scrollbar-off");
    var breakCards = !0,
        searchVisible = 0,
        transparent = !0,
        transparentDemo = !0,
        fixedTop = !1,
        mobile_menu_visible = 0,
        mobile_menu_initialized = !1,
        toggle_initialized = !1,
        bootstrap_nav_initialized = !1,
        seq = 0,
        delays = 80,
        durations = 500,
        seq2 = 0,
        delays2 = 80,
        durations2 = 500;

    $(document).on("click", ".navbar-toggler", function() {
            if ($toggle = $(this), 1 == mobile_menu_visible) $("html").removeClass("nav-open"), $(".close-layer").remove(), setTimeout(function() {
                $toggle.removeClass("toggled")
            }, 400), mobile_menu_visible = 0;
            else {
                setTimeout(function() {
                    $toggle.addClass("toggled")
                }, 430);
                var e = $('<div class="close-layer"></div>');
                0 != $("body").find(".main-panel").length ? e.appendTo(".main-panel") : $("body").hasClass("off-canvas-sidebar") && e.appendTo(".wrapper-full-page"), setTimeout(function() {
                    e.addClass("visible")
                }, 100), e.click(function() {
                    $("html").removeClass("nav-open"), mobile_menu_visible = 0, e.removeClass("visible"), setTimeout(function() {
                        e.remove(), $toggle.removeClass("toggled")
                    }, 400)
                }), 
                $("html").addClass("nav-open"), mobile_menu_visible = 1
            }
    });


    /************ Setting.php *************/
    // just for the demos, avoids form submit
      jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
      });
      $("#form").validate({

        rules: {
          new_password: "required",
          confirm_password: {
            equalTo: "#new_password"
          }
        },

        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement : function(error, element) {
          $(element).append(error);
        }

      });


    /******** Sweet Alert ************/
    showSwal: function(type) {
        if (type == 'basic') {
            swal({
                title: "Here's a message!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success"
            }).catch(swal.noop)

        } else if (type == 'title-and-text') {
            swal({
                title: "Here's a message!",
                text: "It's pretty, isn't it?",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-info"
            }).catch(swal.noop)

        } else if (type == 'success-message') {
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)

        } else if (type == 'logout') {
            swal({
              title: 'Are you sure?',
              text: "You want to logout now!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger',
              confirmButtonText: 'Yes, logout!',
              buttonsStyling: false
            }).then((result) => {
              if (result.value) {
                window.location.href = "logout.php";
              }
            })
        } else if (type == 'warning-message-and-confirmation') {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes, delete it!',
                buttonsStyling: false
            }).then(function() {
                swal({
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                })
            }).catch(swal.noop)
        } else if (type == 'warning-message-and-cancel') {
            swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover this imaginary file!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it',
                confirmButtonClass: "btn btn-success",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false
            }).then(function() {
                swal({
                    title: 'Deleted!',
                    text: 'Your imaginary file has been deleted.',
                    type: 'success',
                    confirmButtonClass: "btn btn-success",
                    buttonsStyling: false
                }).catch(swal.noop)
            }, function(dismiss) {
                // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                if (dismiss === 'cancel') {
                    swal({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        type: 'error',
                        confirmButtonClass: "btn btn-info",
                        buttonsStyling: false
                    }).catch(swal.noop)
                }
            })

        } else if (type == 'custom-html') {
            swal({
                title: 'HTML example',
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                html: 'You can use <b>bold text</b>, ' +
                    '<a href="http://github.com">links</a> ' +
                    'and other HTML tags'
            }).catch(swal.noop)

        } else if (type == 'auto-close') {
            swal({
                title: "Auto close alert!",
                text: "I will close in 2 seconds.",
                timer: 2000,
                showConfirmButton: false
            }).catch(swal.noop)
        } else if (type == 'input-field') {
            swal({
                title: 'Input something',
                html: '<div class="form-group">' +
                    '<input id="input-field" type="text" class="form-control" />' +
                    '</div>',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function(result) {
                swal({
                    type: 'success',
                    html: 'You entered: <strong>' +
                        $('#input-field').val() +
                        '</strong>',
                    confirmButtonClass: 'btn btn-success',
                    buttonsStyling: false

                })
            }).catch(swal.noop)
        }
    },