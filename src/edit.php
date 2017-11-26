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
        <!--<script src="http://eruda.liriliri.io/eruda.min.js"></script>-->
        <script type="text/javascript">
            //eruda.init();
        </script>
    </head>
    <body>
        <div id="test"></div> 
        <div  id="showMsg" style="width:100%;position:fixed;z-index:999;display:none;" class="alert alert-warning alert-dismissible" role="alert">
                  <a href="javascript:close();" class="close"  aria-label="Close"><span aria-hidden="true">&times;</span></a>
                  <strong id="msg"></strong> 
                </div>
        <div id="layout" class="container">
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                      <h1>编辑文档<small>Edit file:<?php echo $_GET['name']; ?></small></h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <a class="btn btn-info" href="./index.php">返回首页</a>&nbsp;
                    <a href="javascript:post();" class="btn btn-primary"  >保存</a>&nbsp;                        
                    <a id="autoSync" href="javascript:sync();" class="btn btn-primary" >定时同步：关闭</a>
                     
                    <!-- Button trigger modal -->
                    <button type="button" onclick="javascript:showHistory()" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                      从本地存储恢复
                    </button>
                    
                    
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    
                    <form id="main" method="POST" action="./saveFile.php?name=<?php echo $_GET['name']; ?>">
                        
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
        <div id="file" style="display:none"><?php echo $_GET['name']; ?></div>
        
        
        
        <!-- Modal -->
                    <div style="" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">历史记录</h4>
                          </div>
                          <div class="modal-body">
                            <textarea style="height:300px;width:100%;resize:none" disabled="disabled" id="history"></textarea>
                            <script type="text/javascript">
                                
                            </script>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button onclick="javascript:restoreFormLocal()" data-dismiss="modal" class="btn btn-primary">确认恢复</button>
                          </div>
                        </div>
                      </div>
                    </div>
        <script src="./js/jquery.min.js"></script>
        <script src="./js/editormd.js"></script>
        
        <script src="to-markdown/to-markdown.js"></script>
        <script src="md_editor_core.js">
           
            
        </script>
        <script type="text/javascript">
            var syncFlag = false;
            function post()
            {
                localSync();
                var id=document.getElementById("file").innerHTML;
                $.ajax({  
                type: "POST",  
                url:"./saveFile.php?name="+id,  
                data:$('#main').serialize(),  
                async: false,  
                error: function(request) {  
                    //alert("Connection error");  
                    showMsg("同步失败");
                },  
                success: function(data) {  
                    //alert("Success");
                    showMsg("同步成功:"+data);
                }  
              });
              return true;
            }

            function postAuto()
            {
                if(syncFlag)
                {
                    localSync();
                    var id=document.getElementById("file").innerHTML;
                    $.ajax({  
                        type: "POST",  
                        url:"./saveFile.php?name="+id,  
                        data:$('#main').serialize(),  
                        async: false,  
                        error: function(request) {  
                            //alert("Connection error");  
                            showMsg("同步失败");
                        },  
                        success: function(data) {  
                            //alert("Success");
                            showMsg("同步成功:"+data);
                        }  
                    });
                }
                
            }

            function showMsg(msg)
            {
                document.getElementById("showMsg").style.display="block";
                document.getElementById("msg").innerHTML=msg;
                window.setTimeout("document.getElementById('showMsg').style.display='none';",2000);
            }

	    function close()
	    {
		document.getElementById('showMsg').style.display='none';
	    }
            function sync()
            {
                if(syncFlag){
                    syncFlag=false;
                    document.getElementById("autoSync").innerHTML="定时同步：关闭";
                }else
                { 
                    syncFlag=true;
                    document.getElementById("autoSync").innerHTML="定时同步：开启";
                }
            }
            window.setInterval(postAuto,30000);
        function localSync()
        {
            var content = document.getElementById("my-editormd-markdown-doc").innerHTML;
            var id=document.getElementById("file").innerHTML;
            localStorage.setItem(id,content);
        }
        function restoreFormLocal()
        {
            var id=document.getElementById("file").innerHTML;
            var content = localStorage.getItem(id);
            document.getElementById("my-editormd-markdown-doc").innerHTML = content;
            post();
            location.replace(location.href);
        }
        function showHistory()
        {
            var id=document.getElementById("file").innerHTML;
            var content = localStorage.getItem(id);
            document.getElementById("history").innerHTML = content;
            return true;
        }
        </script>
        <script src="./js/bootstrap.min.js"></script>
    </body>
</html>
