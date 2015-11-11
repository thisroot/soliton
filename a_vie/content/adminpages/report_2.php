<?php
session_start();
require_once '../../../addons/php-auth/classes/Auth.class.php';
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
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.10/c3.min.js"></script>
          
            <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
            <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


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
                .select2-container--default .select2-selection--single {
                    background-color: rgb(144, 30, 86);
                    border: 1px solid rgba(255, 255, 255, 0);
                    border-radius: 2px;
                   
                }
                
                .select2-container--default .select2-selection--single .select2-selection__rendered {
                    color: rgb(255, 252, 252);
                    line-height: 28px;
                }
                
                .select2-container--default .select2-selection--single .select2-selection__arrow b {
                    border-color: #FFF transparent transparent;
                }
                
                .select2-container .select2-selection--single {
                height: 32px;
                }
            </style>

        </head>

        <body>

            <script type="text/javascript">

                $(function () {
                    var derivers = $.pivotUtilities.derivers;

                    var renderers = $.extend(
                            $.pivotUtilities.renderers,
                            $.pivotUtilities.c3_renderers,
                            $.pivotUtilities.d3_renderers,
                            $.pivotUtilities.export_renderers
                            );



                    // первоначальная загрузка таблицы

                    // задаем параметры
                    $('#m').addClass('active');
                    var set = "https://nebesa.me/parser/a_ctr/c_parser.php?type=getjson&set=mSyktyvkar";
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

                    // переданный объект                    
                    var tempQuery = {
                        "hiddenAttributes": [],
                        // "menuLimit": 200,
                        "cols": [],
                        "rows": [
                            "компания",
                            "имяУправляющего",
                            "телефон"
                        ],
                        "vals": [],
                        "exclusions": {
                            "улица": [
                                "Бабушкина  ул",
                                "Банбана  ул",
                                "Береговая  ул",
                                "Борисова  ул",
                                "Боровая  ул",
                                "Бумажников  пр-кт",
                                "Быковского  ул",
                                "Весенняя  ул",
                                "Ветеранов  ул",
                                "Водника  ул",
                                "Восточная  ул",
                                "Гаражная  ул",
                                "Геологов  проезд",
                                "Гора  мкр",
                                "Горького  ул",
                                "Дальняя  ул",
                                "Дивизии  ул",
                                "Димитрова  ул",
                                "Дорожная  ул",
                                "Дружбы  ул",
                                "Дырнос  м",
                                "Емвальская  ул",
                                "Жилиных  ул",
                                "Заводская  ул",
                                "Заводской  пер",
                                "Западная  ул",
                                "Запань  м",
                                "Интернациональная  ул",
                                "Каликовой  ул",
                                "Карьерная  ул",
                                "Катаева  ул",
                                "Кирова  ул",
                                "Кирпичная  ул",
                                "Колхозная  ул",
                                "Комарова  ул",
                                "Коммуны  ул",
                                "Корткеросская  ул",
                                "Космодемьянской  пер",
                                "Космодемьянской  ул",
                                "Космонавтов  ул",
                                "Кочпонская  ул",
                                "Красноармейская  ул",
                                "Куратова  ул",
                                "Кутузова  ул",
                                "Ленина  ул",
                                "Лесозаводская  ул",
                                "Луговая  ул",
                                "Магистральная  ул",
                                "Магистральный  проезд",
                                "Маегова  ул",
                                "Малышева  ул",
                                "Маркова  ул",
                                "Маркса  ул",
                                "Марта  ул",
                                "Маяковского  ул",
                                "Межевая  ул",
                                "Мелиораторов  ул",
                                "Менделеева  ул",
                                "Микушева  ул",
                                "Мира  ул",
                                "Молодежная  ул",
                                "Морозова  ул",
                                "Московская  ул",
                                "Набережный  проезд",
                                "Навигационная  ул",
                                "Нагорный  проезд",
                                "Национальная  ул",
                                "Новоселов  ул",
                                "Озерная  ул",
                                "Октябрьский  пр-кт",
                                "Оплеснина  ул",
                                "Орджоникидзе  ул",
                                "Осипенко  ул",
                                "Островского  ул",
                                "Папанина  ул",
                                "Парковая  ул",
                                "Партизан  ул",
                                "Первомайская  ул",
                                "Перевозная  ул",
                                "Пермская  ул",
                                "Песчаная  ул",
                                "Петрозаводская  ул",
                                "Печорская  ул",
                                "Печорский  пер",
                                "Победы  ул",
                                "Покровский  б-р",
                                "Поселковая  ул",
                                "поселок  ул",
                                "Почтовая  ул",
                                "Почтовый  проезд",
                                "Пригородная  ул",
                                "Пригородный  пер",
                                "Пришкольная  ул",
                                "Промышленная  ул",
                                "Пушкина  ул",
                                "Рабочий  пер",
                                "Радиоцентр  тер",
                                "Рейдовая  ул",
                                "Республиканская  ул",
                                "Ручейная  ул",
                                "Савина  ул",
                                "Садовая  ул",
                                "Свободы  ул",
                                "Северная  ул",
                                "Серова  ул",
                                "Складская  ул",
                                "Славы  ул",
                                "Слободская  ул",
                                "Снежная  ул",
                                "Советская  ул",
                                "Сосновая  ул",
                                "Сосновый  пер",
                                "Социалистический  пер",
                                "Сплавная  ул",
                                "Станционная  ул",
                                "Старовского  ул",
                                "Стахановская  ул",
                                "Сысольское  ш",
                                "Тентюковская  ул",
                                "Урожайная  ул",
                                "Цеткин  ул",
                                "Чернова  ул",
                                "Чит  мкр",
                                "Чкалова  ул",
                                "Чов  м",
                                "Човью  м",
                                "Школьная  ул",
                                "Школьный  пер",
                                "Эжвинская  ул",
                                "Энгельса  ул",
                                "Южная  ул",
                                "Юности  ул",
                                "Юхнина  ул",
                                "Ярославская  ул"
                            ],
                            "компания": [
                                "ТСЖ &quot;Карла Маркса 199",
                                "ТСЖ &quot;Карла Маркса 213&quot;",
                                "ТСЖ &quot;Карла Маркса, 180/1&quot;",
                                "ТСЖ ул.Коммунистическая,64"
                            ]
                        },
                        "inclusions": {
                            "улица": [
                                "Коммунистическая  ул"
                            ],
                            "компания": [
                                "ЖСК 17",
                                "ЖСК 33А",
                                "ЖСК - 21",
                                "ЖСК №14",
                                "ЖСК №29 &quot;Заря-3&quot;",
                                "ЖСК № 40",
                                "ЖСК-20",
                                "ЖСК-26",
                                "ЖСК-27",
                                "ЖСК-45",
                                "ООО &quot;ГЖЭК&quot;",
                                "ООО &quot;ЖилвестСити&quot;",
                                "ООО &quot;ЖИЛКОМВЕСТ&quot;",
                                "ООО &quot;ЖУК&quot;",
                                "ООО &quot;КРиУ&quot;",
                                "ООО &quot;РЭУ №1&quot;",
                                "ООО &quot;Северное тепло&quot;",
                                "ООО &quot;Служба заказчика&quot;",
                                "ООО &quot;СпбГлавСтройУправление&quot;",
                                "ООО &quot;Сыктывкарская Управляющая Компания&quot;",
                                "ООО &quot;Тентюково&quot;",
                                "ООО &quot;УК &quot; Дом&quot;",
                                "ООО &quot;УК &quot;Служба заказчика&quot;",
                                "ООО &quot;УК &quot;Солнечный дом&quot;",
                                "ООО &quot;УК ЖУК&quot;",
                                "ООО &quot;УК КРиУ&quot;",
                                "ООО &quot;УК УРЭК&quot;",
                                "ООО &quot;УК&quot;РЭКОН&quot;",
                                "ООО &quot;Эжвинский Жилкомхоз&quot;",
                                "ООО «СЖКК-Давпон»",
                                "ООО «СЖКК-Орбита»",
                                "ООО «Теплокомфорт»",
                                "ООО «УК «Теплокомфорт»",
                                "ООО Компания &quot;Жилвест&quot;",
                                "ООО РЭКОН",
                                "ООО РЭП",
                                "ООО УК &quot;ЖИЛВЕСТ&quot;",
                                "ООО УК &quot;Жилсервис&quot;",
                                "ООО УК &quot;ЖилСервис&quot;",
                                "ООО УК &quot;ОУК&quot;",
                                "ООО УК &quot;Сыктывкарская&quot;",
                                "ООО УК «СЖКК»",
                                "ТСЖ &quot;77/2&quot;",
                                "ТСЖ &quot;Аврора&quot;",
                                "ТСЖ &quot;АНТОША&quot;",
                                "ТСЖ &quot;Артмас&quot;",
                                "ТСЖ &quot;Бастион&quot;",
                                "ТСЖ &quot;Бумажников-53Б&quot;",
                                "ТСЖ &quot;Вермас&quot;",
                                "ТСЖ &quot;Весна&quot;",
                                "ТСЖ &quot;Ветеранов 6&quot;",
                                "ТСЖ &quot;Восточная, 91&quot;",
                                "ТСЖ &quot;Вычегда&quot;",
                                "ТСЖ &quot;Галич&quot;",
                                "ТСЖ &quot;Геолог&quot;",
                                "ТСЖ &quot;Д. Каликова, 25&quot;",
                                "ТСЖ &quot;Давпон-жилье&quot;",
                                "ТСЖ &quot;Домны Каликовой-26&quot;",
                                "ТСЖ &quot;Домовик 2&quot;",
                                "ТСЖ &quot;Домовик-3&quot;",
                                "ТСЖ &quot;Дорожник-2&quot;",
                                "ТСЖ &quot;Жилавиа&quot;",
                                "ТСЖ &quot;Интер 111&quot;",
                                "ТСЖ &quot;Интернациональная, 77&quot;",
                                "ТСЖ &quot;Интернациональная, 196&quot;",
                                "ТСЖ &quot;Капель&quot;",
                                "ТСЖ &quot;Карла Маркса, 156&quot;",
                                "ТСЖ &quot;Катаева,51&quot;",
                                "ТСЖ &quot;Кедр&quot;",
                                "ТСЖ &quot;Керка&quot;",
                                "ТСЖ &quot;Колхозная-2&quot;",
                                "ТСЖ &quot;Коммуна 75/2&quot;",
                                "ТСЖ &quot;Коммунистическая 19&quot;",
                                "ТСЖ &quot;Коммунистическая 21/1&quot;",
                                "ТСЖ &quot;Коммунистическая, 18&quot;",
                                "ТСЖ &quot;Кутузова 17&quot;",
                                "ТСЖ &quot;Кутузова 36&quot;",
                                "ТСЖ &quot;Ленина 43&quot;",
                                "ТСЖ &quot;Ленина, 89&quot;",
                                "ТСЖ &quot;Ленина-17&quot;",
                                "ТСЖ &quot;Ленина-23А&quot;",
                                "ТСЖ &quot;Малышева 12&quot;",
                                "ТСЖ &quot;Маркова 59&quot;",
                                "ТСЖ &quot;Маркова 61&quot;",
                                "ТСЖ &quot;Маркова,д.33&quot;",
                                "ТСЖ &quot;Микушева, 7&quot;",
                                "ТСЖ &quot;Морозова 104&quot;",
                                "ТСЖ &quot;Морозова 166&quot;",
                                "ТСЖ &quot;Морозова - 185&quot;",
                                "ТСЖ &quot;Морозова - 191&quot;",
                                "ТСЖ &quot;Морозова, 177&quot;",
                                "ТСЖ &quot;Морозова-167&quot;",
                                "ТСЖ &quot;Моя семья&quot;",
                                "ТСЖ &quot;Наш дом&quot;",
                                "ТСЖ &quot;Октябрь&quot;",
                                "ТСЖ &quot;Октябрьский проспект 124&quot;",
                                "ТСЖ &quot;Октябрьский проспект, 180/1&quot;",
                                "ТСЖ &quot;Орджоникидзе-28&quot;",
                                "ТСЖ &quot;Первомайская-83&quot;",
                                "ТСЖ &quot;Петрозаводская 17&quot;",
                                "ТСЖ &quot;Пешеходный бульвар&quot;",
                                "ТСЖ &quot;Покровский бульвар 2&quot;",
                                "ТСЖ &quot;Покровский бульвар - 14&quot;",
                                "ТСЖ &quot;Пришкольная, 22&quot;",
                                "ТСЖ &quot;проспект Бумажников-44&quot;",
                                "ТСЖ &quot;Пушкина 127/2&quot;",
                                "ТСЖ &quot;Рост&quot;",
                                "ТСЖ &quot;Ручейная 39/2&quot;",
                                "ТСЖ &quot;Ручейная, 40&quot;",
                                "ТСЖ &quot;Свобода-17&quot;",
                                "ТСЖ &quot;Свобода-19&quot;",
                                "ТСЖ &quot;Свободы,35/75&quot;",
                                "ТСЖ &quot;Свой дом&quot;",
                                "ТСЖ &quot;Север-жилье&quot;",
                                "ТСЖ &quot;Северная - 61&quot;",
                                "ТСЖ &quot;Советская, 1&quot;",
                                "ТСЖ &quot;Советская, 8&quot;",
                                "ТСЖ &quot;Тентюковская, 126&quot;",
                                "ТСЖ &quot;Тентюковская, 144&quot;",
                                "ТСЖ &quot;Тентюковская, 150&quot;",
                                "ТСЖ &quot;Тентюковская, 154&quot;",
                                "ТСЖ &quot;Теремок&quot;",
                                "ТСЖ &quot;Ул.Славы-35&quot;",
                                "ТСЖ &quot;Усадьба&quot;",
                                "ТСЖ &quot;Центральный&quot;",
                                "ТСЖ &quot;Школьный-14&quot;",
                                "ТСЖ &quot;Юность&quot;",
                                "ТСЖ «Перекресток»",
                                "ТСЖ «Старовского, 22/1»",
                                "ТСЖ ДОМОВИК",
                                "ТСЖ Советская2/1",
                                "ЭМУП &quot;Жилкомхоз&quot;",
                                "Энергоресурс"
                            ]
                        },
    //  "unusedAttrsVertical": 85,
                        // "autoSortUnusedAttrs": false,
                        "inclusionsInfo": {
                            "улица": [
                                "Коммунистическая  ул"
                            ],
                            "компания": [
                                "ЖСК 17",
                                "ЖСК 33А",
                                "ЖСК - 21",
                                "ЖСК №14",
                                "ЖСК №29 &quot;Заря-3&quot;",
                                "ЖСК № 40",
                                "ЖСК-20",
                                "ЖСК-26",
                                "ЖСК-27",
                                "ЖСК-45",
                                "ООО &quot;ГЖЭК&quot;",
                                "ООО &quot;ЖилвестСити&quot;",
                                "ООО &quot;ЖИЛКОМВЕСТ&quot;",
                                "ООО &quot;ЖУК&quot;",
                                "ООО &quot;КРиУ&quot;",
                                "ООО &quot;РЭУ №1&quot;",
                                "ООО &quot;Северное тепло&quot;",
                                "ООО &quot;Служба заказчика&quot;",
                                "ООО &quot;СпбГлавСтройУправление&quot;",
                                "ООО &quot;Сыктывкарская Управляющая Компания&quot;",
                                "ООО &quot;Тентюково&quot;",
                                "ООО &quot;УК &quot; Дом&quot;",
                                "ООО &quot;УК &quot;Служба заказчика&quot;",
                                "ООО &quot;УК &quot;Солнечный дом&quot;",
                                "ООО &quot;УК ЖУК&quot;",
                                "ООО &quot;УК КРиУ&quot;",
                                "ООО &quot;УК УРЭК&quot;",
                                "ООО &quot;УК&quot;РЭКОН&quot;",
                                "ООО &quot;Эжвинский Жилкомхоз&quot;",
                                "ООО «СЖКК-Давпон»",
                                "ООО «СЖКК-Орбита»",
                                "ООО «Теплокомфорт»",
                                "ООО «УК «Теплокомфорт»",
                                "ООО Компания &quot;Жилвест&quot;",
                                "ООО РЭКОН",
                                "ООО РЭП",
                                "ООО УК &quot;ЖИЛВЕСТ&quot;",
                                "ООО УК &quot;Жилсервис&quot;",
                                "ООО УК &quot;ЖилСервис&quot;",
                                "ООО УК &quot;ОУК&quot;",
                                "ООО УК &quot;Сыктывкарская&quot;",
                                "ООО УК «СЖКК»",
                                "ТСЖ &quot;77/2&quot;",
                                "ТСЖ &quot;Аврора&quot;",
                                "ТСЖ &quot;АНТОША&quot;",
                                "ТСЖ &quot;Артмас&quot;",
                                "ТСЖ &quot;Бастион&quot;",
                                "ТСЖ &quot;Бумажников-53Б&quot;",
                                "ТСЖ &quot;Вермас&quot;",
                                "ТСЖ &quot;Весна&quot;",
                                "ТСЖ &quot;Ветеранов 6&quot;",
                                "ТСЖ &quot;Восточная, 91&quot;",
                                "ТСЖ &quot;Вычегда&quot;",
                                "ТСЖ &quot;Галич&quot;",
                                "ТСЖ &quot;Геолог&quot;",
                                "ТСЖ &quot;Д. Каликова, 25&quot;",
                                "ТСЖ &quot;Давпон-жилье&quot;",
                                "ТСЖ &quot;Домны Каликовой-26&quot;",
                                "ТСЖ &quot;Домовик 2&quot;",
                                "ТСЖ &quot;Домовик-3&quot;",
                                "ТСЖ &quot;Дорожник-2&quot;",
                                "ТСЖ &quot;Жилавиа&quot;",
                                "ТСЖ &quot;Интер 111&quot;",
                                "ТСЖ &quot;Интернациональная, 77&quot;",
                                "ТСЖ &quot;Интернациональная, 196&quot;",
                                "ТСЖ &quot;Капель&quot;",
                                "ТСЖ &quot;Карла Маркса, 156&quot;",
                                "ТСЖ &quot;Катаева,51&quot;",
                                "ТСЖ &quot;Кедр&quot;",
                                "ТСЖ &quot;Керка&quot;",
                                "ТСЖ &quot;Колхозная-2&quot;",
                                "ТСЖ &quot;Коммуна 75/2&quot;",
                                "ТСЖ &quot;Коммунистическая 19&quot;",
                                "ТСЖ &quot;Коммунистическая 21/1&quot;",
                                "ТСЖ &quot;Коммунистическая, 18&quot;",
                                "ТСЖ &quot;Кутузова 17&quot;",
                                "ТСЖ &quot;Кутузова 36&quot;",
                                "ТСЖ &quot;Ленина 43&quot;",
                                "ТСЖ &quot;Ленина, 89&quot;",
                                "ТСЖ &quot;Ленина-17&quot;",
                                "ТСЖ &quot;Ленина-23А&quot;",
                                "ТСЖ &quot;Малышева 12&quot;",
                                "ТСЖ &quot;Маркова 59&quot;",
                                "ТСЖ &quot;Маркова 61&quot;",
                                "ТСЖ &quot;Маркова,д.33&quot;",
                                "ТСЖ &quot;Микушева, 7&quot;",
                                "ТСЖ &quot;Морозова 104&quot;",
                                "ТСЖ &quot;Морозова 166&quot;",
                                "ТСЖ &quot;Морозова - 185&quot;",
                                "ТСЖ &quot;Морозова - 191&quot;",
                                "ТСЖ &quot;Морозова, 177&quot;",
                                "ТСЖ &quot;Морозова-167&quot;",
                                "ТСЖ &quot;Моя семья&quot;",
                                "ТСЖ &quot;Наш дом&quot;",
                                "ТСЖ &quot;Октябрь&quot;",
                                "ТСЖ &quot;Октябрьский проспект 124&quot;",
                                "ТСЖ &quot;Октябрьский проспект, 180/1&quot;",
                                "ТСЖ &quot;Орджоникидзе-28&quot;",
                                "ТСЖ &quot;Первомайская-83&quot;",
                                "ТСЖ &quot;Петрозаводская 17&quot;",
                                "ТСЖ &quot;Пешеходный бульвар&quot;",
                                "ТСЖ &quot;Покровский бульвар 2&quot;",
                                "ТСЖ &quot;Покровский бульвар - 14&quot;",
                                "ТСЖ &quot;Пришкольная, 22&quot;",
                                "ТСЖ &quot;проспект Бумажников-44&quot;",
                                "ТСЖ &quot;Пушкина 127/2&quot;",
                                "ТСЖ &quot;Рост&quot;",
                                "ТСЖ &quot;Ручейная 39/2&quot;",
                                "ТСЖ &quot;Ручейная, 40&quot;",
                                "ТСЖ &quot;Свобода-17&quot;",
                                "ТСЖ &quot;Свобода-19&quot;",
                                "ТСЖ &quot;Свободы,35/75&quot;",
                                "ТСЖ &quot;Свой дом&quot;",
                                "ТСЖ &quot;Север-жилье&quot;",
                                "ТСЖ &quot;Северная - 61&quot;",
                                "ТСЖ &quot;Советская, 1&quot;",
                                "ТСЖ &quot;Советская, 8&quot;",
                                "ТСЖ &quot;Тентюковская, 126&quot;",
                                "ТСЖ &quot;Тентюковская, 144&quot;",
                                "ТСЖ &quot;Тентюковская, 150&quot;",
                                "ТСЖ &quot;Тентюковская, 154&quot;",
                                "ТСЖ &quot;Теремок&quot;",
                                "ТСЖ &quot;Ул.Славы-35&quot;",
                                "ТСЖ &quot;Усадьба&quot;",
                                "ТСЖ &quot;Центральный&quot;",
                                "ТСЖ &quot;Школьный-14&quot;",
                                "ТСЖ &quot;Юность&quot;",
                                "ТСЖ «Перекресток»",
                                "ТСЖ «Старовского, 22/1»",
                                "ТСЖ ДОМОВИК",
                                "ТСЖ Советская2/1",
                                "ЭМУП &quot;Жилкомхоз&quot;",
                                "Энергоресурс"
                            ]
                        },
                        "aggregatorName": "Счет",
                        "rendererName": "Table"
                    };
                    // слияние с главным обьектом    
                    $.extend(options, tempQuery);
                    
                    
                    //функция инициализации таблицы               
                    function getTable(set, options) {
                        $.getJSON(set, function (mps) {
                            $("#output").pivotUI(mps, options, false, "ru");
                        });
                    }
                    ;
                    //получаем таблицу
                    getTable(set, options);
                    
                    
                    


                    // скрипт перехода по таблицам.                
                    $('.json').on('click', function () {
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
                            }
                        });
                        var explode = function () {
                            $('select').addClass('btn btn-default');
                            $('select').css('border-radius', '6px');
                            $('.pvtAttr').css('background-color', '#1E7490 none repeat scroll 0% 0%');
                            $('.pvtAttr').css('padding', '4px 5px');
                            $('.pvtAttr').css('color', 'white');
                            $('table.pvtTable tr th, table.pvtTable tr').css('background-color', '#DAB3C6');
                            $('.pvtAxisLabel, .pvtTotalLabel').css('background-color', 'rgb(144, 30, 86)');
                            $('.pvtAxisLabel, .pvtTotalLabel').css('color', 'white');
                            $('.pvtAxisContainer, .pvtVals').css('border', '1px solid #D7ACC1');
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
                        <textarea style="float: left; width: 250px; height: 300px; margin:10px;" readonly id="query"></textarea>
                    </div>
                    
                    <button class="btn btn-default" id="opener">Сохранить</button>

                    <select style="width:20%" class="btn btn-default" id="drop-list">
                            <option value="AL">Открыть</option>
                            <option value="WY">Wyoming</option>
                            <option value="WY">dddssds</option>
                            <option value="WY">dsddsd</option>
                            <option value="WY">yttrter</option>
                            <option value="WY">cbcxcs</option>
                            <option value="WY">xsdswddx</option>
                            <option value="WY">jiyhgffvd</option>
                            <option value="WY">cdfedb</option>
                    </select>


                  

                    
                  



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
                    $(function () {
                        $("#openQuery").dialog({
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

                        $("#openerQuery").click(function () {
                            $("#openQuery").dialog("open");
                        });
                    });
                    //сборка css на отрисованной таблице    
                    var explode = function () {
                        $('select').addClass('btn btn-default');
                        $('select').css('border-radius', '6px');
                        $('.pvtAttr').css('background-color', '#1E7490 none repeat scroll 0% 0%');
                        $('.pvtAttr').css('padding', '4px 5px');
                        $('.pvtAttr').css('color', 'white');
                        $('table.pvtTable tr th, table.pvtTable tr th').css('background-color', '#DAB3C6');
                        $('.pvtAxisLabel, .pvtTotalLabel').css('background-color', 'rgb(144, 30, 86)');
                        $('.pvtAxisLabel, .pvtTotalLabel').css('color', 'white');
                        $('.pvtAxisContainer, .pvtVals').css('border', '1px solid #D7ACC1');
                    };
                    setTimeout(explode, 3000);

                });

                //сохранение значений формы на удаленный сервер            
                $('#success').click(function (config) {
                    var data = new FormData();
                    data.append('type', 'saveTable'); //тип запроса
                    data.append('city', $('#city').val());
                    data.append('nameTable', $('.json.active').attr('id')); // имя таблицы
                    data.append('nameQuery', $('#nameQuery').val()); //имя конфигурации таблицы
                    data.append('query', $('#query').val()); // конфигурация таблицы                                              
                    console.log(data);
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

                //загрузка данных

            </script>
        <?php endif; ?>       
    </body>
</html>

