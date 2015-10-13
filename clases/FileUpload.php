<?php

class FileUpload {
    
    static function getFileName(){
        return $_FILES["archivo"]["name"];
    }
    
    static function getFileTipe(){
        return $_FILES["archivo"]["type"];
    }
    
    static function getFileSize(){
        return $_FILES["archivo"]["size"];
    }
    
    static function getTmpName(){
        return $_FILES["archivo"]["tmp_name"];
    }
    
    static function getNameError(){
        return $_FILES["archivo"]["error"];
    }
    
    static function maxFileSize($peso){
        if($_FILES["archivo"]["size"] > $peso){
             return "El archivo supera el peso permitido";
        }else{
            return "El peso del archivo es correcto";
        }
    }
  
   private static function isImage(){
        $tipo = $_FILES["archivo"]["type"];
        if($tipo == "image/gif" ||
           $tipo == "image/jpeg" ||
           $tipo == "image/png"){
            return true;
        }else{
            return false;
        }
    }

    static function upload($nombre){
        $directorio = "./img/";
        $nombreTemporal = $_FILES["archivo"]["tmp_name"];
        if(FileUpload::isImage()){
            if(FileUpload::directory()){
                if(file_exists($directorio.$nombre)){
                     return move_uploaded_file($nombreTemporal,$directorio.$nombre."(".rand(0, 500).")"); 
                }else{
                    return  move_uploaded_file($nombreTemporal,$directorio.$nombre);
                }
            }else{
                return mkdir($directorio) + move_uploaded_file($nombreTemporal,$directorio.$nombre);
            }
      }else{
          echo "<br/>No es un formato valido<br/>";
      }
   }
        
    private static function directory(){
        if(file_exists("./img/")){
            return true;
        }else{
            return false;
        }
    }
    
     static function getErrorMessage() {
        switch ($_FILES["archivo"]["error"]) {
            case UPLOAD_ERR_OK: 
                return "El archivo se ha subido correctamente";
                break;
            case UPLOAD_ERR_INI_SIZE: 
                return " El archivo excede el tamaño maximo permitido";
                break;
            case UPLOAD_ERR_FORM_SIZE: 
                return "El archivo excede el tamaño maximo permitido por el formulario HTML";
                break;
            case UPLOAD_ERR_PARTIAL: 
                return " El archivo se ha subido sólo parcialmente.";
                break;
            case UPLOAD_ERR_NO_FILE: 
                return "No se ha seleccionado ningún archivo.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR: 
                return "La carpeta temporal no existe.";
                break;
            case UPLOAD_ERR_CANT_WRITE: 
                return "No se pudo escribir en el disco.";
                break;
            case UPLOAD_ERR_EXTENSION: 
                return "Alguna extensión de php ha impedido subir el archivo";
                break;
            default: 
                return "Error de subida desconocido";
        }
    }
}
