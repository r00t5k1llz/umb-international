<?php
	header('refresh: 21; url=transfer_verify_cot.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script> 
<script type="text/javascript" src="js/script.js"></script>

<title>Transfering Amount</title>
</head>
<body>
    <div class="example">
        <h3>Transfer in Progress...</a></h3>
		<p>Please do not refresh your page.</p>

        <div id="progress1">
            <div class="percent"></div>
            <div class="pbar"></div>
            <!--<div class="elapsed"></div>-->
        </div>
    </div>
</body>
</html>