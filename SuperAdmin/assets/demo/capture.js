  // The buttons to start & stop stream and to capture the image
  var btnStart = document.getElementById( "btn-start" );
  var btnStop = document.getElementById( "btn-stop" );
  var btnCapture = document.getElementById( "btn-capture" );

  // The stream & capture
  var stream = document.getElementById( "stream" );
  var capture = document.getElementById( "capture" );
  var snapshot = document.getElementById( "snapshot" );

  // The video stream
  var cameraStream = null;

  // Attach listeners
  btnStart.addEventListener( "click", startStreaming );
  btnStop.addEventListener( "click", stopStreaming );
  btnCapture.addEventListener( "click", captureSnapshot );

  // Start Streaming
  function startStreaming() {

    var mediaSupport = 'mediaDevices' in navigator;

    if( mediaSupport && null == cameraStream ) {

      navigator.mediaDevices.getUserMedia( { video: true } )
      .then( function( mediaStream ) {

        cameraStream = mediaStream;

        stream.srcObject = mediaStream;

        stream.play();
      })
      .catch( function( err ) {

        console.log( "Unable to access camera: " + err );
      });
    }
    else {

      alert( 'Your browser does not support media devices.' );

      return;
    }
  }

  // Stop Streaming
  function stopStreaming() {

    if( null != cameraStream ) {

      var track = cameraStream.getTracks()[ 0 ];

      track.stop();
      stream.load();

      cameraStream = null;
    }
  }

  function captureSnapshot() {

    if( null != cameraStream ) {

      var ctx = capture.getContext( '2d' );
      var img = new Image();

      //ctx.drawImage( stream, 0, 0, capture.width, capture.height );
      ctx.drawImage( stream, 0, 0, 300, 300 );
    
      img.src   = capture.toDataURL( "image/png" );
      img.width = 300;
      img.height = 300;

      snapshot.innerHTML = '';

      snapshot.appendChild( img );

        var imagebase64data = capture.toDataURL( "image/png" );
        imagebase64data = imagebase64data.replace('data:image/png;base64,', '');  
        $.ajax({  
            type: 'POST',
            url: 'up.php',  
            //data: '{ "imageData" : "'+imagebase64data+'" }',
            data: { 'imageData' : imagebase64data},
            dataType: 'text',  
            success: function (out) {
              capturedImage( "top",  "center",  "success",  "camera", "Wow! Image Successfully Captured!" );

              $("#captured_status").val("true");

              console.log(out);
              
              //$('#finish').show();
              //alert('imagebase64data');
              //console.log(imagebase64data);
            }  
        });
    }
  }

  /******* Push Notifiaction *******/
  function capturedImage(position, align, color, icons, message) {
    $.notify({
      icon: icons,
      message: message
    }, {
      type: color,
      timer: 2500,
      placement: {
        from: position,
        align: align
      }
    });
  }





