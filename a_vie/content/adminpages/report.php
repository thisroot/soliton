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
            <link href="../../../css/main.css" rel="stylesheet" type="text/css"/>

            <!-- Custom styles for this template -->
            <!-- external libs from cdnjs -->
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css">
            <link href="../../../addons/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
            <link href="../../../addons/jquery-ui/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
            
            <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            
            <script src="../../../addons/jquery-ui/jquery-ui.js" type="text/javascript"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.js"></script>

            <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
            <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 


            <!-- PivotTable.js libs from ../dist -->
            <link href="../../../addons/pivottable-master/dist/pivot.css" rel="stylesheet" type="text/css"/>     
            <script src="../../../addons/pivottable-master/dist/pivot.js" type="text/javascript"></script>
            <script src="../../../addons/pivottable-master/dist/pivot.ru.js" type="text/javascript"></script>
            <script type="text/javascript" src="../../../addons/pivottable-master/dist/export_renderers.js"></script>       
            <script type="text/javascript" src="../../../addons/pivottable-master/dist/d3_renderers.js"></script>       
            <script type="text/javascript" src="../../../addons/pivottable-master/dist/c3_renderers.js"></script>
            <link href="../../../css/report.css" rel="stylesheet" type="text/css"/>




        </head>

        <body>

            <script type="text/javascript">

                $(document).ready(function () {

                    $(function () {
                        var derivers = $.pivotUtilities.derivers;

                        var renderers = $.extend(
                                $.pivotUtilities.renderers,
                                $.pivotUtilities.c3_renderers,
                                $.pivotUtilities.d3_renderers,
                                $.pivotUtilities.export_renderers
                                );
                        var set = '';


                        // первоначальная загрузка таблицы

                        // задаем параметры
                        $('#m').addClass('active');
                        set = "https://nebesa.me/parser/a_ctr/c_parser.php?type=getjson&set=mSyktyvkar";
                        var options = {
                            renderers: renderers,
                            onRefresh: function (config) {
                                var config_copy = JSON.parse(JSON.stringify(config));

                                //delete some values which are functions
                                delete config_copy["aggregators"];
                                delete config_copy["renderers"];
                                //if new table need delete
                                   delete config_copy["derivedAttributes"];
                                //delete some bulky default values
                                delete config_copy["rendererOptions"];
                                delete config_copy["localeStrings"];
                                $("#query").text(JSON.stringify(config_copy, undefined, 2));
                            }

                        };


                        //функция инициализации таблицы               
                        function getTable(set, options) {
                            $.getJSON(set, function (mps) {
                                //     console.log('опции при рендеринге');
                                //     console.log(options);
                                $("#output").pivotUI(mps, options, false, "ru");
                            });
                        }
                        ;


                        var query = {
                            "hiddenAttributes": [],
                            "cols": [],
                            "rows": [
                                "компания",
                                "имяУправляющего",
                                "телефон"
                            ]};


                        $.extend(options, query);
                        //получаем таблицу
                        getTable(set, options);

                        $('#drop-list').on("change", function () {

                            $("#output").empty().text("Загрузка...");
                            $("#output").removeData();


                            table = $('.json.active').attr('id'); //идентификатор таблицы
                            city = $('#city').val(); //идентификатор города
                            set = table + city;
                            set = "https://nebesa.me/parser/a_ctr/c_parser.php?type=getjson&set=" + set;


                            setTimeout(getQuery, 300);

                            function getQuery() {
                               
                             var   query = $('#savedQuery').text();
                                query = JSON.parse(query);

                                var options = {
                                    renderers: renderers,
                                    onRefresh: function (config) {
                                        var config_copy = JSON.parse(JSON.stringify(config));

                                        //delete some values which are functions
                                        delete config_copy["aggregators"];
                                        delete config_copy["renderers"];
                                            delete config_copy["derivedAttributes"];
                                        //delete some bulky default values
                                        delete config_copy["rendererOptions"];
                                        delete config_copy["localeStrings"];
                                        $("#query").text(JSON.stringify(config_copy, undefined, 2));
                                    }
                                };




                                $.extend(options, query);


                                //получаем таблицу
                                //    getTable(set, options);
                                $.getJSON(set, function (mps) {
                                    $("#output").pivotUI(mps, options, false, "ru");
                                });


                            }
                        });

                        // получение списка сохраненных запросов
                        $('#drop-list').select2({
                            minimumInputLength: 2,
                            ajax: {
                                url: getPath,
                                dataType: 'json',
                                data: function (term, page) {
                                    return {
                                        q: term

                                    };
                                },
                                processResults: function (data, page) {
                                    var response = data;
                                    // console.log(response);
                                    return {
                                        results: response
                                    };
                                },
                                cache: true
                            },
                            escapeMarkup: function (markup) {
                                return markup;
                            }, // let our custom formatter work
                            templateResult: formatRepo, // omitted for brevity, see the source of this page
                            templateSelection: formatRepoSelection, // omitted for brevity, see the source of this page
                            placeholder: "введи запрос"
                        });

                        // получение параметров ссылки
                        function getPath() {
                            var table = $('.json.active').attr('id'); //идентификатор таблицы
                            var city = $('#city').val(); //идентификатор города
                            var path = "../../../../parser/a_ctr/c_respond.php?type=getTable&city=" + city + "&nameTable=" + table;
                            return path;
                        }
                        //формирование выдачи блока
                        function formatRepo(repo) {
                            if (repo.loading)
                                return repo.nameQuery;
                            var markup = '<div class="clearfix">' +
                                    '<div class="col-sm-12">' + repo.nameQuery + '</div>' +
                                    '</div>';
                            return markup;
                        }

                        function formatRepoSelection(repo) {

                            var markup = '<div>' +
                                    '<div>' + repo.nameQuery + '</div>' +
                                    '</div><div id="savedQuery" class="hidden">' + repo.query + '</div>' +
                                    '</div>';

                            return repo.text || markup;
                            // console.log(repo.nameQuery);
                        }

                        // скрипт перехода по таблицам.                
                        $('.json').on('click', function () {

                            $('#drop-list').val(null).trigger("change");

                            //убираем активность со всех кнопок класса и вешаем на активированную
                            $('.json').removeClass('active');
                            $(this).addClass('active');
                            var table = $(this).attr('id'); //идентификатор таблицы
                            var city = $('#city').val(); //идентификатор города
                            var set = table + city;
                            $("#output").empty().text("Загрузка...");
                            $("#output").removeData();

                            //получить параметры запроса шаблона таблицы.

                            $.getJSON("https://nebesa.me/parser/a_ctr/c_parser.php?type=getjson&set=" + set, function (mps) {
                                //   console.log(mps);
                                if (table == 'h') {
                                    $("#output").pivotUI(mps, {
                                        renderers: renderers,
                                        derivedAttributes: {
                                            "ВсегоКвартирДиап": derivers.bin("всегоКвартир", 50),
                                            "ВсегоКвартирДиап2": derivers.bin("всегоКвартир", 100)
                                        },
                                        cols: ["вЭксплС"], rows: ["ВсегоКвартирДиап"],
                                        aggregatorName: "Счет",
                                        vals: ["всегоКвартир"],
                                        rendererName: "Stacked Bar Chart",
                                        onRefresh: function (config) {
                                            var config_copy = JSON.parse(JSON.stringify(config));
                                            //delete some values which are functions
                                            delete config_copy["aggregators"];
                                            delete config_copy["renderers"];
                                                 delete config_copy["derivedAttributes"];
                                            //delete some bulky default values
                                            delete config_copy["rendererOptions"];
                                            delete config_copy["localeStrings"];
                                            $("#query").text(JSON.stringify(config_copy, undefined, 2));
                                        }
                                    }, false, "ru");
                                } else if (table == 'm') {

                                    $("#output").pivotUI(mps, {
                                        renderers: renderers,
                                        rows: ["компания", "имяУправляющего", "телефон"],
                                        onRefresh: function (config) {
                                            var config_copy = JSON.parse(JSON.stringify(config));
                                    //      delete some values which are functions
                                            delete config_copy["aggregators"];
                                            delete config_copy["renderers"];
                                               delete config_copy["derivedAttributes"];
                                            //delete some bulky default values
                                            delete config_copy["rendererOptions"];
                                            delete config_copy["localeStrings"];
                                            $("#query").text(JSON.stringify(config_copy, undefined, 2));
                                        }

                                    }, false, "ru");
                                }

                            });
                        });
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
            <div class="col-md-12">
                <div class="starter-template">
                    <div class="btn btn-default pull-left json" id="m">Компании</div>
                    <div class="btn btn-default pull-left json" id="h">Дома</div>

                    <div id="dialog" title="Сохранить запрос">
                        <div class='ajax-respond alert alert-success' style="display:none"></div>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <div class="btn btn-success" id="success">Сохранить</div>
                            </div>
                            <input id="nameQuery" type="text" class="form-control" aria-label="...">
                        </div>
                        <textarea style="float: left; width: 250px; height: 150px; margin: 10px 90px 5px 0px;" readonly id="point"></textarea>
                        <textarea style="float: left; width: 250px; height: 150px; margin: 5px 90px 10px 0px;" readonly id="query"></textarea>
                    </div>
                    <button class="btn btn-default" id="opener">Сохранить</button>

                    <select style="min-width:300px" class="btn btn-default" id="drop-list">
                        <option>Введи</option>
                    </select>

                    <!-- Open Map-->                 
                    <input id="popMap" class="btn btn-default" type="button" value="Карта" />
                    <!--the div that going to hold the map--->
                    <div id="mapcanvas" style="display:none;">
                    </div>


                    <select id="city" style="border-radius: 6px;" class="btn btn-default pull-right">
                        <option value="Syktyvkar">Сыктывкар</option>
                        <option value="Uhta">Ухта</option>
                        <option value="Kirov">Киров</option>
                    </select>
                    <h4 class="text-right">Таблица анализа служб жкх</h4>
                    <div id="output" style="font-size: 12px;"></div>
                </div>
            </div><!-- /.container -->


            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->

                <!--  <script src="../../../js/jquery-1.9.1.min.js" type="text/javascript"></script>
            -->  <script src="../../../js/bootstrap.min.js" type="text/javascript"></script>

            <script type="text/javascript">

                $(document).ready(function () {
                  
                    $('#drop-list').select2();

                    //открытие окна для сохранения
                    $(function () {
                        $("#dialog").dialog({
                            
                            
                            
                            autoOpen: false,
                            show: {
                                effect: "blind",
                                duration: 200
                            },
                            hide: {
                                effect: "explode",
                                duration: 200
                            },
                            position: {my: "center", at: "center"},
                            modal: true,
                            resizable: false
                        });

                        $("#opener").click(function () {
                            $("#dialog").dialog("open");
                        });
                    });

                    //открытие окна с загрузкой данных

                    var width = $(window).width() * 0.7;
                    console.log(width);
                    $(function () {
                        $("#mapcanvas").dialog({
                             
                            title: 'Карта: ' + $('#city').val(),
                            width: width,
                            height: 500,
                            autoOpen: false,
                            show: {
                                effect: "blind",
                                duration: 200
                            },
                            hide: {
                                effect: "explode",
                                duration: 200
                            },
                            position: {my: "center", at: "center"}
                        });

                        $("#popMap").click(function () {

                            //google maps
                            var  circle, circleOptions, setCenter, marker;

                            $("#mapcanvas").dialog("open");
                            var map, circle, circleOptions, setCenter, marker;
                            var geocoder = new google.maps.Geocoder(); //create geocoder object
                            // calling the geocode() function
                            geocoder.geocode({address: $('#city').val()}, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    //map option parameters
                                    var mapOptions = {center: results[0].geometry.location, zoom: 11, mapTypeId: google.maps.MapTypeId.TERRAIN};
                                    //create map to draw address location
                                    map = new google.maps.Map(document.getElementById('mapcanvas'), mapOptions);
                                    // create the map point
                                    // marker = new google.maps.Marker({map: map, position: results[0].geometry.location});

                                setCenter = true;
    
                                circleOptions = {
                                    fillColor:"#1E7490",
                                    fillOpacity:0.5,
                                    strokeColor:"#901E56",
                                    strokeOpacity:0.8,
                                    strokeWeight:2,
                                    clickable:false
                                };

                                google.maps.event.addListener(map, 'click', function(event) {
                                    if (setCenter) {
                                        if (marker != undefined) {
                                            marker.setMap(null);
                                        }
                                                    marker = new google.maps.Marker({
                                                            position:event.latLng,
                                                            clickable:false
                                                    });
                                                    marker.setMap(map);
                                        circleOptions.center = event.latLng;
                                        setCenter = false;
                                    }
                                    else {
                                        //баАбббаИббаВаАаЕаМ баАбббаОбаНаИаЕ аМаЕаЖаДб баОбаКаАаМаИ
                                        var radius = distHaversine(circleOptions.center, event.latLng);
                                        circleOptions.edge = event.latLng;
                                        circleOptions.radius = radius*1000;
                                        if (circle != undefined) {
                                            circle.setMap(null);
                                        }
                                        circle = new google.maps.Circle(circleOptions);
                                        circle.setMap(map);
                                        
                                        setCenter = true;
                                       $('#ui-id-2').text('');
                                        var text = $('#city').val();
                                        $('#ui-id-2').text(text + '. Радиус: '+ circleOptions.radius );
                                        
                                         var copy_circleOptions = JSON.parse(JSON.stringify(circleOptions)); 
                                         //переводим значение замыкания в элемент массива
                                         copy_circleOptions.edge.lat = circleOptions.edge.lat();
                                         copy_circleOptions.edge.lng = circleOptions.edge.lng();
                                         copy_circleOptions.center.lat = circleOptions.center.lat();
                                         copy_circleOptions.center.lng = circleOptions.center.lng();

                                            //delete some values which are functions
                                            delete copy_circleOptions["fillColor"];
                                            delete copy_circleOptions["fillOpacity"];
                                            delete copy_circleOptions["strokeColor"];                                        
                                            delete copy_circleOptions["strokeOpacity"];
                                            delete copy_circleOptions["strokeWeight"];
                                            delete copy_circleOptions["clickable"];
                                            delete copy_circleOptions["visible"];
                                            
                                            $("#point").text(JSON.stringify(copy_circleOptions, undefined, 2));
                                        
                                        
                                    }
                                });
                                }
                            });    
                        });
                    });

                });
                                
                rad = function(x) {return x*Math.PI/180;};

                    distHaversine = function(p1, p2) {
                        var R = 6371; // earth's mean radius in km
                        var dLat  = rad(p2.lat() - p1.lat());
                        var dLong = rad(p2.lng() - p1.lng());

                        var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                                Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) * Math.sin(dLong/2) * Math.sin(dLong/2);
                        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                        var d = R * c;

                        return d.toFixed(3);
                    };

                

                //сохранение значений формы на удаленный сервер            
                $('#success').click(function (config) {
                    var data = new FormData();
                    data.append('type', 'saveTable'); //тип запроса
                    data.append('city', $('#city').val());
                    data.append('nameTable', $('.json.active').attr('id')); // имя таблицы
                    data.append('nameQuery', $('#nameQuery').val()); //имя конфигурации таблицы
                    data.append('query', $('#query').val()); // конфигурация таблицы                                              
                    //     console.log(data);
                    $.ajax({
                        url: '../../../../parser/a_ctr/c_respond.php',
                        type: 'POST',
                        data: data,
                        cache: false,
                        dataType: 'json',
                        processData: false, // Не обрабатываем файлы (Don't process the files)
                        contentType: false, // Так jQuery скажет серверу что это строковой запрос
                        success: function (respond, textStatus, jqXHR) {

                            // Если все ОК
                            if (typeof respond.error === 'undefined') {

                                //вывододим сообщение в окно
                                $('.ajax-respond').text(respond.success).fadeIn('slow');
                                window.setTimeout(function () {
                                    $('.ajax-respond').text(respond.success).fadeOut('slow');
                                }, 2000);
                            } else {
                                console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log('ОШИБКИ AJAX запроса: ' + textStatus);

                        }
                    });
                });
            </script>
        <?php endif; ?>       
    </body>
</html>

