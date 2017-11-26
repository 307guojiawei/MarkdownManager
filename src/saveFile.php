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
       // $htmlPath=$fileDir.$fileName.$htmlType;
       // $myfile2 = fopen($htmlPath, "w");
       // fwrite($myfile2, $_POST['test-editormd-html-code']);
       // fclose($myfile2);
       ?>
       Success
       <?php
    }else {
        ?>Fail.login first<?php
    }
	
?>

