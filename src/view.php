<!DOCTYPE html>
<?php header("Content-Type: text/html;charset=utf-8"); 
     ?>
<html lang="zh">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View</title>
        <link rel="stylesheet" href="./css/editormd.css" />
        <link rel="stylesheet" href="./css/indexStyle.css" />
        <link rel="stylesheet" href="./css/bootstrap.min.css" />
        <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />
        <script src="./js/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./lib/marked.min.js"></script>
        <script src="./lib/prettify.min.js"></script>
        <script src="./lib/raphael.min.js"></script>
        <script src="./lib/underscore.min.js"></script>
        <script src="./lib/sequence-diagram.min.js"></script>
        <script src="./lib/flowchart.min.js"></script>
        <script src="./lib/jquery.flowchart.min.js"></script>
        <script src="./js/editormd.js"></script>

    </head>
    <body>
        <img class="bg" src="bing.php" />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                      <h1><?php echo $_GET['name']; ?><small><a style="color:#ffffff" href="./index.php">返回首页</a></small></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="doc-content" style="background-color: rgba(255,255,255,0.9)!important;">
                    <textarea style="display:none;">
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
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var testEditor;
            $(function () {
                testEditor = editormd.markdownToHTML("doc-content", {//注意：这里是上面DIV的id
                    htmlDecode: "style,script,iframe",
                    emoji: true,
                    taskList: true,
                    tex: true, // 默认不解析
                    flowChart: true, // 默认不解析
                    sequenceDiagram: true, // 默认不解析
                    codeFold: true,
		    path    : "./lib/",
            });});
         </script>
    </body>
</html>
