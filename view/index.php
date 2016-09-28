<!DOCTYPE html>
<html>
<head>
	<title>View Image</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div style="margin-top:5%;"></div>
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">View Image</h3>
		  </div>
		  <div class="panel-body">
		    <div class="row">
          <img src="<?php echo $image; ?>" alt="<?php echo $nama; ?>">  
        </div>
        <div class="row">
          <h3> Lokasi pada server : <?php echo $lokasi; ?></h3>
          <h3> Ukuran : <?php echo $ukuran; ?></h3>
        </div>
		  </div>
		</div>
	</div>
</body>
</html>