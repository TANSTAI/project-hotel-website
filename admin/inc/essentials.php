<?php
    //frontend purpose data 
    define('SITE_URL','https://127.0.0.1/hotelb/');
    define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
    define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
    define('FACILITIES_IMG_PATH',SITE_URL.'images/facilities/');
    define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');
    define('USERS_IMG_PATH',SITE_URL.'images/users/');

    //backend update process needs data
    
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/hotelb/images/');
    define('UPLOAD_IMAGE_PATH2',$_SERVER['DOCUMENT_ROOT'].'/images/');
    define('ABOUT_FOLDER','about/');
    define('CAROUSEL_FOLDER','carousel/');
    define('FACILITIES_FOLDER','facilities/');
    define('ROOMS_FOLDER','rooms/');
    define('USERS_FOLDER','users/');

    // sendgrid api key

    define('SENDGRID_API_KEY',"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");
    define('SENDGRID_MAIL','subin1402v@gmail.com');
    define('SENDGRID_NAME','HOTEL_B');

    //Possible "booking status" value in db = pending, booked, payment failed, cancelled

    //to configure paytm gateway check file 'project folder / inc / paytm / config_paytm.php
    



    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true))
        {
            echo "<script>
            window.location.href='index.php';
            </script>
            ";
            exit;
        }
        session_regenerate_id(true);
    }

    function redirect($url){
        echo "<script>
            window.location.href='$url';
            </script>
        ";
        exit;
    }
    function alert($type,$msg){
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger" ;
        echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        alert;
    }
    function uploadImage($image,$folder)
    {
        $valid_mine = ['image/jpeg','image/png','image/webp','image/jpg'];
        $img_mine = $image['type'];
        if(!in_array($img_mine,$valid_mine))
        {
            return 'inv_img'; //invalid image mine or format
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size'; //invalid image greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH2.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
    function uploadImage2($image,$folder)
    {
        $valid_mine = ['image/jpeg','image/png','image/webp','image/jpg'];
        $img_mine = $image['type'];
        if(!in_array($img_mine,$valid_mine))
        {
            return 'inv_img'; //invalid image mine or format
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size'; //invalid image greater than 2mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
    function deleteImage($image,$folder)
    {
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }
    function deleteImage2($image,$folder)
    {
        if(unlink(UPLOAD_IMAGE_PATH2.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }
    function uploadSVGImage($image,$folder)
    {
        $valid_mine = ['image/svg+xml'];
        $img_mine = $image['type'];
        if(!in_array($img_mine,$valid_mine))
        {
            return 'inv_img'; //invalid image mine or format
        }
        else if(($image['size']/(1024*1024))>1){
            return 'inv_size'; //invalid image greater than 1mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
    function uploadSVGImage2($image,$folder)
    {
        $valid_mine = ['image/svg+xml'];
        $img_mine = $image['type'];
        if(!in_array($img_mine,$valid_mine))
        {
            return 'inv_img'; //invalid image mine or format
        }
        else if(($image['size']/(1024*1024))>1){
            return 'inv_size'; //invalid image greater than 1mb
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH2.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
    function uploadUserImage($image)
    {
        $valid_mine = ['image/jpeg','image/png','image/webp','image/jpg'];
        $img_mine = $image['type'];
        if(!in_array($img_mine,$valid_mine))
        {
            return 'inv_img'; //invalid image mine or format
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg";

            $img_path = UPLOAD_IMAGE_PATH2.USERS_FOLDER.$rname;

            if($ext == 'png' || $ext == 'PNG')
            {
                $img = imagecreatefrompng($image['tmp_name']);
            }
            else if($ext == 'webp' || $ext == 'WEBP')
            {
                $img =  imagecreatefromwebp($image['tmp_name']);
            }
            else{
                $img =  imagecreatefromjpeg($image['tmp_name']);
            }


            if(imagejpeg($img,$img_path,75)){ 
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
    function uploadUserImage2($image)
    {
        $valid_mine = ['image/jpeg','image/png','image/webp','image/jpg'];
        $img_mine = $image['type'];
        if(!in_array($img_mine,$valid_mine))
        {
            return 'inv_img'; //invalid image mine or format
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111,99999).".jpeg";

            $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

            if($ext == 'png' || $ext == 'PNG')
            {
                $img = imagecreatefrompng($image['tmp_name']);
            }
            else if($ext == 'webp' || $ext == 'WEBP')
            {
                $img =  imagecreatefromwebp($image['tmp_name']);
            }
            else{
                $img =  imagecreatefromjpeg($image['tmp_name']);
            }


            if(imagejpeg($img,$img_path,75)){ 
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
?>