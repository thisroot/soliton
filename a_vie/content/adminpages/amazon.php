<?php
session_start();
require_once '../../../addons/php-auth/classes/Auth.class.php';
ini_set("memory_limit", "512M");
?>
<?php if (Auth\User::isAdmin()): ?>  
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

            <title>Блок анализа</title>

            <!-- Bootstrap core CSS -->

           
            <link href="../../../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

            <!-- Custom styles for this template -->
            <!-- external libs from cdnjs -->       
            <link href="../../../addons/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
            <link href="../../../addons/jquery-ui/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
            <link href="../../../addons/nifty/template/css/nifty.min.css" rel="stylesheet" type="text/css"/>
            
           <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"/> 
            
            <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>                     
            <script src="../../../addons/jquery-ui/jquery-ui.js" type="text/javascript"></script>
            <script src="../../../addons/nifty/template/js/nifty.js" type="text/javascript"></script>


            <!-- PivotTable.js libs from ../dist -->
          
            <link href="../../../css/report.css" rel="stylesheet" type="text/css"/>
            <link href="../../../css/main.css" rel="stylesheet" type="text/css"/>



        </head>

        <body>

            
            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="https://nebesa.me">СОЛИТОН</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Инфо по товару</a></li>
                            <li><a href="#about">Отчет заявок</a></li>
                            <li><a href="#contact">Отчет продаж</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
            <div class="col-md-12 starter-template">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <form class="form-horizontal">
                    <div style="margin-top: 90px;" class="panel-body">
                            <div class="input-group mar-btm">
                                <span class="input-group-btn">
                                    <button style="height: 45px; font-size: 18px;" class="btn btn-warning btn-labeled fa fa-search" type="button">Поиск</button>
                                </span>
                                <input style="height: 45px; font-size: 18px;" placeholder="введите фразу" class="form-control" type="text">
                            </div>

                        </div>
                </form>
                    </div>
                 <div class="col-md-3"></div>
            </div><!-- /.container -->


            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->

                <!--  <script src="../../../js/jquery-1.9.1.min.js" type="text/javascript"></script>
            -->  <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>

          
        <?php endif; ?>       
    </body>
</html>

