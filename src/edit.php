<!DOCTYPE html>
<?php 
session_start();
header("Content-Type: text/html;charset=utf-8"); 
if($_SESSION['usr']!="admin")
{?>
    <meta http-equiv="refresh" content="0.1;url=./index.php">

<?php
}


 ?>
<html lang="zh">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit</title>
        <link rel="stylesheet" href="./css/style.css" />
        <link rel="stylesheet" href="./css/editormd.css" />
        <link rel="stylesheet" href="./css/bootstrap.min.css" />
        <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />
        <script src="http://eruda.liriliri.io/eruda.min.js"></script>
        <script type="text/javascript">
            //eruda.init();
        </script>
    </head>
    <body>
        <div id="test"></div> 
        <div id="layout" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                      <h1>编辑文档<small>Edit file:<?php echo $_GET['name']; ?></small></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    
                    <form method="POST" action="./saveFile.php?name=<?php echo $_GET['name']; ?>">
                        <button class="btn btn-primary" type="submit" >保存</button>
                        <a class="btn btn-info" href="./index.php">返回首页</a>
                        <hr>
                        <div id="test-editormd">
                            <textarea id="my-editormd-markdown-doc" name="my-editormd-markdown-doc" style="display:none;">
                                <?php 
                                    $fileDir="./files/";
                                    $fileName=$_GET['name'];
                                    $fileType = "-md.txt";
                                    $path=$fileDir.$fileName.$fileType;
                                    $myfile = fopen($path, "r");
                                    echo fread($myfile,filesize($path));
                                    fclose($myfile);
                                ?>
                            </textarea>
                            <textarea id="my-editormd-html-code" name="my-editormd-html-code" style="display:none;"></textarea>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <script src="./js/jquery.min.js"></script>
        <script src="./js/editormd.js"></script>
        
        <script src="to-markdown/to-markdown.js"></script>
        <script src="md_editor_core.js">
           
            
        </script>
        <script type="text/javascript">
            console.log("Hello");
        </script>
        <script src="./js/bootstrap.min.js"></script>
    </body>
</html>