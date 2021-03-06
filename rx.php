<html>
<head>
<title>RX</title>
<link rel="stylesheet" href="//cdn.rawgit.com/TeaMeow/TocasUI/master/dist/tocas.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="js/grid.js"></script>
<script type="text/javascript" src="js/version.js"></script>
<script type="text/javascript" src="js/detector.js"></script>
<script type="text/javascript" src="js/formatinf.js"></script>
<script type="text/javascript" src="js/errorlevel.js"></script>
<script type="text/javascript" src="js/bitmat.js"></script>
<script type="text/javascript" src="js/datablock.js"></script>
<script type="text/javascript" src="js/bmparser.js"></script>
<script type="text/javascript" src="js/datamask.js"></script>
<script type="text/javascript" src="js/rsdecoder.js"></script>
<script type="text/javascript" src="js/gf256poly.js"></script>
<script type="text/javascript" src="js/gf256.js"></script>
<script type="text/javascript" src="js/decoder.js"></script>
<script type="text/javascript" src="js/qrcode.js"></script>
<script type="text/javascript" src="js/findpat.js"></script>
<script type="text/javascript" src="js/alignpat.js"></script>
<script type="text/javascript" src="js/databr.js"></script>

<script type="text/javascript">
function qdecode(){
	var result = qrcode.decode();
	if (result.includes("imuslab.com")){
		window.location.replace(result);
	}else{
		alert(result);
	}
}
</script>

</head>

<body>
<div class="ts container">
<br><h1>IMUS Laboratory</h1><br>
<h2>Quick Send System</h2><br>
<div class="ts menu">
<a class="item">Functions</a>
<a class="item" href="index.php">Tx</a>
<a class="active item" href="rx.php">Rx</a>
<a class="item" href="display.php">Display</a>
</div>
<div class="ts secondary message">
    <div class="header">Recieve Interface</div>
    <p>This interface can decode QR-code based ID identification by taking a picture generated by this system.<br>
	Or by manually entering the ID of the given session of Memo, this interface can redirect the page to the display interface.</p>
</div>
<div class="ts segment">
<h3>Session ID</h3>
<div class="ts input" style="width:75%;">
    <input type="text" id="mid" placeholder="Memo ID" style="width:100%;">
</div>
<button class="ts basic button" onclick="manual_redirect()">View</button>
</div>
<div class="ts segment">
<h3>QR-Code ID</h3>
<form>
<div class="ts circular input">
<input type="file" accept="image/*" id="file-input" capture="camera">
</div>
</form>
<canvas id="qr-canvas" width="256px" height="256px" style="display:none;"></canvas>
<canvas id="preview-canvas" width="256px" height="256px"></canvas>
<div class="ts container" align="right">
<button class="ts basic button" onclick="qdecode()">Decode</button>
</div><br>
</div>
<div class="ts container">
<img class="ts tiny right floated image" src="img/cube.png"></img>
</div>
<div align="left" class="ts container">
CopyRight IMUS Laboratory 2017, All right reserved.
</div>
</div>
<script>
function resizeCanvasImage(img, canvas, maxWidth, maxHeight) {
    var imgWidth = img.width, 
        imgHeight = img.height;

    var ratio = 1, ratio1 = 1, ratio2 = 1;
    ratio1 = maxWidth / imgWidth;
    ratio2 = maxHeight / imgHeight;

    // Use the smallest ratio that the image best fit into the maxWidth x maxHeight box.
    if (ratio1 < ratio2) {
        ratio = ratio1;
    }
    else {
        ratio = ratio2;
    }

    var canvasContext = canvas.getContext("2d");
    var canvasCopy = document.createElement("canvas");
    var copyContext = canvasCopy.getContext("2d");
    var canvasCopy2 = document.createElement("canvas");
    var copyContext2 = canvasCopy2.getContext("2d");
    canvasCopy.width = imgWidth;
    canvasCopy.height = imgHeight;  
    copyContext.drawImage(img, 0, 0);

    // init
    canvasCopy2.width = imgWidth;
    canvasCopy2.height = imgHeight;        
    copyContext2.drawImage(canvasCopy, 0, 0, canvasCopy.width, canvasCopy.height, 0, 0, canvasCopy2.width, canvasCopy2.height);


    var rounds = 2;
    var roundRatio = ratio * rounds;
    for (var i = 1; i <= rounds; i++) {
        console.log("Step: "+i);

        // tmp
        canvasCopy.width = imgWidth * roundRatio / i;
        canvasCopy.height = imgHeight * roundRatio / i;

        copyContext.drawImage(canvasCopy2, 0, 0, canvasCopy2.width, canvasCopy2.height, 0, 0, canvasCopy.width, canvasCopy.height);

        // copy back
        canvasCopy2.width = imgWidth * roundRatio / i;
        canvasCopy2.height = imgHeight * roundRatio / i;
        copyContext2.drawImage(canvasCopy, 0, 0, canvasCopy.width, canvasCopy.height, 0, 0, canvasCopy2.width, canvasCopy2.height);

    } // end for


    // copy back to canvas
    canvas.width = imgWidth * roundRatio / rounds;
    canvas.height = imgHeight * roundRatio / rounds;
    canvasContext.drawImage(canvasCopy2, 0, 0, canvasCopy2.width, canvasCopy2.height, 0, 0, canvas.width, canvas.height);


}


$(function() {
    $('#file-input').change(function(e) {
        var file = e.target.files[0],
            imageType = /image.*/;

        if (!file.type.match(imageType))
            return;

        var reader = new FileReader();
        reader.onload = fileOnload;
        reader.readAsDataURL(file);
    });

    function fileOnload(e) {
        var $img = $('<img>', { src: e.target.result });
        $img.load(function() {
            var canvas = $('#qr-canvas')[0];
            var context = canvas.getContext('2d');

            canvas.width = this.naturalWidth;
            canvas.height = this.naturalHeight;
            context.drawImage(this, 0, 0);
			//grab the context from your destination canvas
			var pcanvas = $('#preview-canvas')[0];
			var destCtx = pcanvas.getContext('2d');
			//call its drawImage() function passing it the source canvas directly
			destCtx.drawImage(canvas, 0, 0, 256, 256 * this.height / this.width);
        });
    }
});

function manual_redirect(){
	var id = $("#mid").val();
	window.location.replace("http://imuslab.com/qs/display.php?id=" + id);
}
</script>
</body>
</html>