<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();
$app->view()->setTemplatesDirectory('./view');

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

$app->get('/server/getImage/:nama', function ($nama) {
    getImage($nama);
});

$app->post('/server/postImage', 'saveImage');

$app->get('/klien/viewImage/:nama', function ($nama) {
    viewImage($nama);
});

function getImage($nama){
    $app = \Slim\Slim::getInstance();
    $lokasi = 'uploads/'. $nama;
    $size = filesize($lokasi);
    $size = $size / 1024;
    $output["isi_berkas"] = base64_encode(file_get_contents($lokasi));
    $output["lokasi_berkas"] = realpath($lokasi);
    $output["ukuran_berkas"] = floor($size). " KB";
    $app->response()->headers->set('Content-Type', 'application/json');
    echo json_encode($output);
}

function viewImage($nama){
	$app = \Slim\Slim::getInstance();
  $url = "http://localhost/tugas4/server/getImage/".$nama;
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_SSL_VERIFYPEER => FALSE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_URL => $url,
  ));
  $response = curl_exec($ch);
  $imgTemp = json_decode($response);
  $lokasi = $imgTemp->lokasi_berkas;
  $lokasi = str_replace("\\", "/", $lokasi);
  $image = str_replace("/var/www", "http://localhost", $lokasi);
  $ukuran = $imgTemp->ukuran_berkas;
  $app->view()->setTemplatesDirectory('./view');
  $app->render('index.php', array('image'=>$image, 'nama'=> $nama, 'lokasi'=>$lokasi, 'ukuran'=>$ukuran));
}

function saveImage(){
    $app = \Slim\Slim::getInstance();
    $app->response()->header("Content-Type","application/json");
    $dataTemp = $app->request->getBody();
    $imgTemp = json_decode($dataTemp);

    $nama = $imgTemp->nama;
    $temp = explode(".", $nama);
    $ext = $temp[1];
    $base64 = $imgTemp->base64;
    $lokasi = 'uploads/'.$nama;
    $data = base64_decode($base64);
    file_put_contents($lokasi, $data);
    $object['status'] = '200';
    $object['message'] = 'Foto berhasil disimpan';
    echo json_encode($object);
}


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
