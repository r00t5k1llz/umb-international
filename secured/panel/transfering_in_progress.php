<?php
	header('refresh: 69; url=transfer_in_progress_imf.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="css2/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
<link href="css2/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js2/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js2/jquery-ui-1.8.16.custom.min.js"></script> 
<script type="text/javascript" src="js2/script.js"></script>

<title>Transfering Amount</title>
</head>
<body>
    <div class="example">
        <h3>Transfer in Progress...</a></h3>
		<p>Please do not refresh your page.  Your COT Code has already been verified</p>

        <div id="progress1">
            <div class="percent"></div>
            <div class="pbar"></div>
            <!--<div class="elapsed"></div>-->
        </div>
    </div>
</body>
</html>