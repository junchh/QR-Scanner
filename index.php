<!DOCTYPE html>
<html>
<head>
	<title>ARC Scanner</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<style>
#preview
{
    transform: rotateY(180deg);
    -webkit-transform:rotateY(180deg); /* Safari and Chrome */
    -moz-transform:rotateY(180deg); /* Firefox */
}
</style>
<body>
  
    <h1>ARC Scanner</h1>
    
    <video id="preview"></video>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
      scanner.addListener('scan', function (content) {
        var rs = content.split(";");
        var d = new Object();

        d.name = rs[0];
        d.nim = rs[1];
        d.email = rs[2];
        d.phone = rs[3];
        d.line = rs[4];

        $.post('https://line-bot-eduka-system.herokuapp.com/regis/' + d.name +'/' + d.nim + '/' + d.email + '/' + d.phone + '/' + d.line, d, function(response, status){
        });
          alert("OKE");
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
   
</body>
</html>