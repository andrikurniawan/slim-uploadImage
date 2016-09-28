<!DOCTYPE html>
<html>
<head>
	<title>Klien WS 4</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div style="margin-top:5%;"></div>
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Upload Image</h3>
		  </div>
		  <div class="panel-body">
		    <form method="POST" action="" enctype="multipart/form-data">
		    	<div class="form-group">
		    		<label for="text">Upload Gambar</label>
		    		<input type="file" name="gambar" class="form-control">
		    	</div>
		    	<button type="submit" class="form-control btn btn-primary">UPLOAD</button>
		    </form>
		  </div>
      <?php 
      	$result = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
  	      $img = $_FILES['gambar'];
  	      $nama = $img['name'];
  	      $base64 = base64_encode(file_get_contents($_FILES['gambar']['tmp_name']));
          $output['nama'] = $nama;
          $output['base64'] = $base64;
          $ch = curl_init("http://localhost/tugas4/server/postImage");
          curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type : application/json; charset=utf-8'),
            CURLOPT_POSTFIELDS => json_encode($output)
          ));
          $response = curl_exec($ch);
          if($response == FALSE){
           $result = "gagal mengupload file";
          } else {
            $result = "Gambar Berhasil disimpan";
          }
	      echo "<h3>" .$result. "</h3>";
	     }
      ?>
		</div>
	</div>
</body>
</html>