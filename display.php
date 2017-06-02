<html>
<head>
<title>Quick Send</title>
<link rel="stylesheet" href="//cdn.rawgit.com/TeaMeow/TocasUI/master/dist/tocas.min.css">
<script>
var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

if (isMobile){
	<?php if (isset($_GET['id']) !== False){
		echo "var tid = parseInt('" . $_GET['id'] . "');" ;
	}else{
		echo "var tid = parseInt('0');" ;
	}
	?>
	window.location.replace("http://imuslab.com/qs/mdisplay.php?id=" + tid);
	//Jump to mobile page
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
<a class="item" href="rx.php">Rx</a>
<a class="active item" href="display.php">Display</a>
</div>

<div class="ts secondary message">
    <div class="header">Display Interface</div>
    <p>This interface display your text sent from other devices.</p>
</div>
<div class="ts segment">
<div class="ts grid">
    <div class="four wide column" align="center">
	<div id="output"></div>
	<div class="ts mini statistic">
    <div class="label">Session ID</div>
    <div class="value" id="sid"><?php
		if (isset($_GET['id']) !== False){
			echo '<script>var sid = parseInt("' . $_GET['id'] . '");</script>';
			echo $_GET['id'];
			$id = $_GET['id'];
		}else{
			//No input ids
			echo '<script>var sid = parseInt("0");</script>';
			echo 0;
			$id = 0;
		}
	?></div>
	</div>
	</div>
    <div class="twelve wide column">
	<div class="ts fluid input" style="height:250px">
    <textarea id="textholder" placeholder="Text to be sent via QRcode."><?php
		$memodir = "Memo/";
		if (file_exists($memodir . $id.".txt")){
			$myfile = fopen($memodir . $id.".txt", "r") or die("Unable to open file!");
			echo hex2bin(fread($myfile,filesize($memodir . $id.".txt")));
			fclose($myfile);
			$filetrue = true;
		}else{
			$filetrue = false;
			echo 'The specified Memo ID cannot be find in the database. Are you sure you entered the correct session id?';
			
		}
	?></textarea>
	<?php
		if ($filetrue == true){
			echo '<script>var file_exists = true;</script>';
		}else{
			echo '<script>var file_exists = false;</script>';
		}
	?>
	</div><br><br>
	<div class="ts container" align="right">
	<button class="ts tiny basic button" onclick="action()">Open / Search</button>
	<button class="ts tiny basic button" onclick="copy()">Copy to Clipboard</button>
	</div>
	</div>
</div>
</div>
<div class="ts container">
<img class="ts tiny right floated image" src="img/cube.png"></img>
</div>
<div align="left" class="ts container">
CopyRight IMUS Laboratory 2017, All right reserved.
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.qrcode.min.js"></script>
<script>
jQuery(function(){
	if (file_exists == true){
		jQuery('#output').qrcode("http://imuslab.com/qs/display.php?id=" + sid);
	}
})

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

function copy(){
	copyToClipboard(document.getElementById("textholder"));
}

function action(){
	var content = $('#textholder').val();
	//alert(content);
	if (content.substr(0, 4).includes("http")){
		//It is a url to be open
		window.open(content,"_blank");
	}else{
		//It is a normal text to be searched
		content = content.replace(" ","+");
		window.open("https://www.google.com.hk/?#safe=off&q=" + content,"_blank");
	}
}
</script>
</body>
</html>