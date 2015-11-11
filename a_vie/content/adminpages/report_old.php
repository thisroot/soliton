<?php
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}

session_start();
require_once '../../../addons/php-auth/classes/Auth.class.php';

?>
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
    <link href="../../../css/main.css" rel="stylesheet" type="text/css"/>
    
    <!-- Custom styles for this template -->
    <!-- external libs from cdnjs -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.js"></script>

        <!-- PivotTable.js libs from ../dist -->
        <link href="../../../addons/pivottable-master/dist/pivot.css" rel="stylesheet" type="text/css"/>     
        <script src="../../../addons/pivottable-master/dist/pivot.js" type="text/javascript"></script>
        <script src="../../../addons/pivottable-master/dist/pivot.ru.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../../addons/pivottable-master/dist/export_renderers.js"></script>       
        <script type="text/javascript" src="../../../addons/pivottable-master/dist/d3_renderers.js"></script>       
        <script type="text/javascript" src="../../../addons/pivottable-master/dist/c3_renderers.js"></script>
   
        <style>
            body {font-family: Verdana;}
            .node {
              border: solid 1px white;
              font: 10px sans-serif;
              line-height: 12px;
              overflow: hidden;
              position: absolute;
              text-indent: 2px;
            }
            .c3-line, .c3-focused {stroke-width: 3px !important;}
            .c3-bar {stroke: white !important; stroke-width: 1;}
            .c3 text { font-size: 12px; color: grey;}
            .tick line {stroke: white;}
            .c3-axis path {stroke: grey;}
            .c3-circle { opacity: 1 !important; }
        </style>
        
  </head>

  <body>
      
      <script type="text/javascript">
            $(function(){
                
                
                var derivers = $.pivotUtilities.derivers;

                var renderers = $.extend(
                    $.pivotUtilities.renderers, 
                    $.pivotUtilities.c3_renderers, 
                    $.pivotUtilities.d3_renderers, 
                    $.pivotUtilities.export_renderers
                    );
                
                var city = 'Syktyvkar';
                var table = 'h';
                var set = table + city;
            
                $.getJSON("https://nebesa.me/parser/a_ctr/c_parser.php?type=getjson&set="+set, function(mps) {
                    console.log(mps);
                    
                    $("#output").pivotUI(mps, {
                        renderers: renderers,
                        derivedAttributes: {
                            "ВсегоКвартирДиап": derivers.bin("всегоКвартир", 50)
                           
                        },
                        cols: ["вЭксплС"], rows: ["ВсегоКвартирДиап"],
                        aggregatorName: "Счет",
                        vals: ["всегоКвартир"],
                        rendererName: "Stacked Bar Chart"
                       
                    },false,"ru");
                });
                
               
                
                $('.json').on('click', function(){
 
                    var table = $(this).attr('id');
                    
                  $("#output").empty().text("Загрузка...")
                  $("#output").removeData();
                  
                  var set = table + city;
                 
                  
                  $.getJSON("https://nebesa.me/parser/a_ctr/c_parser.php?type=getjson&set="+set, function(mps) {
                  console.log(mps);
                    
                    if (table == 'h') {
                        
                        $("#output").pivotUI(mps, {
                        renderers: renderers,
                        derivedAttributes: {
                            "ВсегоКвартирДиап": derivers.bin("всегоКвартир", 50)
                           
                        },
                        cols: ["вЭксплС"], rows: ["ВсегоКвартирДиап"],
                        aggregatorName: "Счет",
                        vals: ["всегоКвартир"],
                        rendererName: "Stacked Bar Chart"
                       
                    },false,"ru");
                    }
                    
                    else if (table == 'm') {
                        
                        $("#output").pivotUI(mps, {
                        renderers: renderers,
                        rows: ["компания" ,"имяУправляющего","телефон"],
                       
                    },false,"ru");
                        
                    }
                    
                 
                });
                
                    var explode = function(){
                $('select').addClass('btn btn-default'); 
                $('select').css('border-radius','6px'); 
                $('.pvtAttr').css('background-color', '#1E7490 none repeat scroll 0% 0%');
                $('.pvtAttr').css('padding', '4px 5px');
                 $('.pvtAttr').css('color', 'white');
                $('table.pvtTable tr th, table.pvtTable tr').css('background-color','#DAB3C6' );
                $('.pvtAxisLabel, .pvtTotalLabel').css('background-color','rgb(144, 30, 86)');
                $('.pvtAxisLabel, .pvtTotalLabel').css('color','white');
                $('.pvtAxisContainer, .pvtVals').css('border','1px solid #D7ACC1');
                };
                    setTimeout(explode, 3000);
                });
                
                
                
             });
        </script>

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
            <li class="active"><a href="#">Отчет ЖКХ</a></li>
            <li><a href="#about">Отчет заявок</a></li>
            <li><a href="#contact">Отчет продаж</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
         <?php if (Auth\User::isAdmin()): ?>  

    <div class="col-md-12">

      <div class="starter-template">
          <div class="btn btn-default pull-left json" id="m">Компании</div>
          <div class="btn btn-default pull-left json" id="h">Дома</div>
          <select style="border-radius: 6px;" class="btn btn-default pull-right">
              <option value="Syktyvkar">Сыктывкар</option>
              <option value="Uhta">Ухта</option>
              <option value="Kirov">Киров</option>
          </select>
          <h4 class="text-center">Таблица анализа служб жкх</h4>
      
         <div id="output" style="font-size: 12px;"></div>
      </div>

    </div><!-- /.container -->
<?php endif; ?> 

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
  <!--  <script src="../../../js/jquery-1.9.1.min.js" type="text/javascript"></script>
  -->  <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>
  
  <script type="text/javascript">
       $(document).ready(function () {
           
           
           var explode = function(){
                $('select').addClass('btn btn-default'); 
                $('select').css('border-radius','6px'); 
                $('.pvtAttr').css('background-color', '#1E7490 none repeat scroll 0% 0%');
                $('.pvtAttr').css('padding', '4px 5px');
                 $('.pvtAttr').css('color', 'white');
                $('table.pvtTable tr th, table.pvtTable tr th').css('background-color','#DAB3C6' );
                $('.pvtAxisLabel, .pvtTotalLabel').css('background-color','rgb(144, 30, 86)');
                $('.pvtAxisLabel, .pvtTotalLabel').css('color','white');
                $('.pvtAxisContainer, .pvtVals').css('border','1px solid #D7ACC1');
                };
                    setTimeout(explode, 3000);
           
           
           
         
           
     
  
    });
  </script>
  </body>
</html>

