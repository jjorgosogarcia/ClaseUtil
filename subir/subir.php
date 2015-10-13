<?php
//texto y archivo
require '../clases/Request.php';
require '../clases/FileUpload.php';

$texto = Request::post("texto");
$peso=999999;
echo "<h1>$texto</h1>";

//echo FileUpload::getErrorMessage().'<br/ >';
//echo FileUpload::getFileName().'<br/ >';
//echo FileUpload::getFileSize().'<br/ >';
echo FileUpload::getFileTipe().'<br/ >';
//echo FileUpload::getTmpName().'<br/ >';
     FileUpload::upload($texto);
     
echo FileUpload::maxFileSize($peso).'<br/ >';
//move_uploaded_file($_FILES["archivo"]["tmp_name"],"./X");
