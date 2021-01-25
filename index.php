<!DOCTYYPE html>
<html>
  <head>
    <title>Uploader</title>
    <script src="plupload/js/plupload.full.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
      window.addEventListener("load", function () {
        var path = "plupload/js/`";
        var uploader = new plupload.Uploader({
          browse_button: 'pickfiles',
          container: document.getElementById('container'),
          url: 'upload.php',
          chunk_size: '1000kb',
          max_retries: 5,
          filters: {
            max_file_size: '5000mb',
            mime_types: [{title: "Video", extensions: "mp4,3gp,mov,jpeg,png,jpg,bmp,tar,zip,rar"}]
          },
          init: {
            PostInit: function () {
              document.getElementById('filelist').innerHTML = '';
            },
            FilesAdded: function (up, files) {
              plupload.each(files, function (file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
              });
              uploader.start();
            },
            UploadProgress: function (up, file) {
              document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            },
            Error: function (up, err) {
              // DO YOUR ERROR HANDLING!
              console.log(err);
            }
          }
        });
        uploader.init();
      });
    </script>
  </head>
  <body>
    <div id="container" style="display:flex; justify-content: center; align-items: center; height:100%; background-color:#1a74bd; flex-direction: column;   ">
      <input type="file" id="pickfiles" style="margin-bottom:30px;" ></input>
    <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>

  </body>
</html>
