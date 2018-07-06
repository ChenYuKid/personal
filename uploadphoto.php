<?php  
    session_start();
    @$username=$_SESSION['username']; 
    $session_id='1'; 
    $path = "./upload_img/";
    $valid_formats = array("jpg", "png", "gif", "bmp");  
    if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_FILES['upload_input']['name'];  
        $size = $_FILES['upload_input']['size'];  
        if(strlen($name))  {  
            list($txt, $ext) = explode(".", $name);  
            if(in_array($ext,$valid_formats)){  
                if($size<(1024*1024))  {  
                    $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;  
                    $tmp = $_FILES['upload_input']['tmp_name'];
                    if(move_uploaded_file($tmp, $path.$actual_image_name)){  
                        echo "<img src='./upload_img/".$actual_image_name."' class='userphoto' style=\"height:inherit;width:inherit;\">";
                    }else return false; /*失败*/
                }else return false; /*相片大小超过1M*/
            }else return false; /*无效的文件格式*/
        }else return false; /*请选择相片*/
        exit;  
    }
?>