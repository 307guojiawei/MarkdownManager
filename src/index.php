<!DOCTYPE html>
<?php 
    session_start();
    header("Content-Type: text/html;charset=utf-8"); 
    include("getBing.php");
    if(!isset($_SESSION['usr']))
    {
        ?>
        <meta http-equiv="refresh" content="0.1;url=./userControl/signin.html">
        <?php
    }
    if(isset($_GET['op']))
    {
        $op = $_GET['op'];
        if($op == "login")
        {
            if(!isset($_POST['pwd']))
            {
                ?>
                <meta http-equiv="refresh" content="0.1;url=./index.php">
                <?php 

            }else
                $pwd = $_POST['pwd'];
            if($pwd == "gjw961128")
            {
                $_SESSION["usr"]="admin";
            }else
            {
                $_SESSION["usr"]=NULL;
                
            }
        }
        if(isset($_SESSION['usr'])&& $_SESSION['usr']=="admin")
        {
            if($op == "new")
            {
                $file=fopen("./files/list.txt", "r");
                $content = fread($file, filesize("./files/list.txt"));
                $content = $content."\n".$_POST['name'];
                fclose($file);
                $file = fopen("./files/list.txt", "w");
                fwrite($file, $content);
                //echo $content;
                fclose($file);
            }
            if($op == "delete")
            {
                $file=fopen("./files/list.txt", "r");
                $content="";

                while(!feof($file))
                {
                    $line = fgets($file);
                    //echo $line;
                    if($line =="\n" || $line == "")continue;
                    if($line != $_GET['name']."\n" &&$line!= $_GET['name'])
                    {
                        $content = $content.$line;
                    }
                }
                //echo $content;
                fclose($file);
                $file = fopen("./files/list.txt", "w");
                fwrite($file, $content);
                fclose($file);
            }
        }
        
    }
     ?>
<html lang="zh">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MarkDown文件管理</title>
        
        
        <link rel="stylesheet" href="./css/bootstrap.min.css" />
        <link rel="stylesheet" href="./css/indexStyle.css" />
        <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />
        <script src="./js/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        

    </head>
    <body >
        <img class="bg" style=" object-fit: cover!important;" src="<?php echo getBing(); ?>" />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                      <h1>MarkDown文件管理 <small style="color:#ffffff">List of files</small></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="list-group">
                        <?php
                            $fileList= fopen("./files/list.txt", "r");
                            while(!feof($fileList))
                            {
                                $file = fgets($fileList);
                                if($file =="\n" || $file == "")continue;
                            ?>
                                <li class="list-group-item"> 
                                    <a style="color: #ffffff!important;" href="./view.php?name=<?php echo $file; ?>" ><h2><?php echo $file; ?></h2></a><br>
                                    <?php if(isset($_SESSION['usr'])&&$_SESSION['usr']=="admin"){ ?><a class="btn btn-sm btn-danger" href="./index.php?op=delete&name=<?php echo $file; ?>">删除</a>
                                    <a class="btn btn-sm btn-info" href="./edit.php?name=<?php echo $file; ?>">编辑</a><?php } ?>
                                </li>
                            <?php
                            }
                            fclose($fileList);                        
                        ?>
                      
                      
                    </div>
                </div>
            </div>
            <hr>
            <?php 
                if(isset($_SESSION['usr'])&&$_SESSION['usr']=="admin"){
            ?>
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="./index.php?op=new">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">新建</button>
                          </span>
                          <input id="name" name="name" type="text" class="form-control" placeholder="文件名">
                        </div><!-- /input-group -->
                    </form>
                </div>
                
               
            </div><hr>
            <div class="row">
                 <div class="col-md-12">
                    <a class="btn btn-danger" href="./userControl/control.php">登出</a>
                </div>
            </div>
            <hr>
            <?php }else{ ?>
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="./index.php?op=login">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">登录</button>
                          </span>
                          <input id="pwd" name="pwd" type="password" class="form-control" placeholder="密码">
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>
            <hr>
            <?php } ?>
        </div>
        
    </body>
</html>
