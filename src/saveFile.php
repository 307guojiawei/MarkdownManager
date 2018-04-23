<?php
	//echo $_POST['my-editormd-markdown-doc'];
    session_start();
    if(isset($_SESSION['usr'])&&$_SESSION['usr']=='admin')
    {
        $fileDir="./files/";
        $fileName="file";
        if(isset($_GET['name']))
        {
            $fileName=$_GET['name'];
        }
        $fileType = "-md.txt";
        $htmlType = "-html.txt";

        $path=$fileDir.$fileName.$fileType;
        $myfile = fopen($path, "w");
        fwrite($myfile, $_POST['my-editormd-markdown-doc']);
	//echo $_POST['my-editormd-markdown-doc'];
        fclose($myfile);
	$logFile=fopen("./log.txt","a");
	fwrite($logFile,date("Y/m/d h:i:s")." wirte:".$path."\n");
	fclose($logFile);
       
       ?>
       Success-服务器端已保存
       <?php
    }else {
        ?>Fail.login first-未登录或连接中断<?php
    }
	
?>

