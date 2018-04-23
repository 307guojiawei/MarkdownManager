<?php
    $str=file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=5');
    //echo $str."<br>";
     if(preg_match_all("/<urlBase>(.+?)<\/urlBase>/ies",$str,$matches)){
         if(isset($_GET['num']))
         {
            $imgurl='http://cn.bing.com'.(($matches[1])[$_GET['num']])."_1920x1080.jpg";
         }else{
            $imgurl='http://cn.bing.com'.(($matches[1])[rand(0,4)])."_1920x1080.jpg";
         }
      
     }
     //var_dump($imgurl);
     if($imgurl){
      header('Content-Type: image/JPEG');
      @ob_end_clean();
      @readfile($imgurl);
      @flush(); @ob_flush();
      exit();
     }else{
      exit('error');
     }

?>