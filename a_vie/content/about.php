<div class="modal-header">
    <button type="button" class="close modal-fix" data-dismiss="modal" aria-hidden="true">&times;</button>
    <?php include './elements/popmenu.php'; ?>

    <h4 class="modal-title" id="myModalLabel">О театре</h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="tab" id="school" href="#about1">Возникновение</a></li>
                    <li><a data-toggle="tab" href="#about2" id="office" >Спектакли</a></li>
                    <li><a data-toggle="tab" href="#about3" id="autodrome">Выпускники</a></li>
                    <li><a data-toggle="tab" href="#about4" id="regards">Наши достижения</a></li>
                </ul>
            </div>
            <div class="tab-content col-md-9">
                <div id="about1" class="tab-pane fade in active">
                    <h4>Возникновение театра</h4>
                    <p>
                        Ордым – тропинка (с коми языка).
                        Своеобразное название театру дал его создатель, режиссер, 
                        театральный педагог Виктор Михайлович Напалков. «Ордым», по его 
                        словам, - это маленькая лесная тропинка, ведущая к большой дороге жизни.
                        Одних эта тропинка приведет в большой мир искусства, другим даст возможность
                        понять и раскрыть себя, а третьим откроет смыслы жизни, вечные ценности, 
                        человеческую мудрость.
                        Творческая биография театра-студии «Ордым» берет свое начало с 2004 года.
                        Именно в этом году гимназия набирает воспитанников в первую театральную 
                        группу, которая с 2013 года станет самостоятельным отделением гимназии.

                    </p>
                    <p>
                        Все работы «Ордым» демонстрировались на сцене концертного зала гимназии искусств на широкую публику. Частые гости нашего театра – учащиеся школ города Сыктывкара и близлежащих районов.
                        Творческие проекты театра-студии рождаются на одной из лучших сценических площадок Республики, оснащенной самым профессиональным световым и звуковым оборудованием. Здесь юные «ордымовцы» пробуют свои силы в различных направлениях театрального искусства: сценарном деле, звукорежиссуре, монтажном и осветительном мастерстве.
                    </p>

                </div>
                <div id="about2" class="tab-pane fade">
                    <h4>Проекты</h4>
                    <div class="about-slider" id="result">  
                    </div>
                </div>
                <div id="about3" class="tab-pane fade">
                    <h4>Выпускники</h4>
                    <div class="about-slider-masters" id="result2"> 
                    </div>
                </div>
                <div id="about4" class="tab-pane fade">
                    <h4>Наши достижения</h4>
                    <div class="about-slider-regards" id="result3"> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-modal-footer" data-dismiss="modal">Закрыть</button>
    </div>


    <script type="application/javascript">
    
      $(document).ready(function () {
        
          var respond = [
    {
      "number": "1",
      "title": "Спектакль: какой то",
      "body": "cxcxcxxcxknxcjbxc"
    },
    {
      "number": "2",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "3",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "4",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "5",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "6",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "7",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "8",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "9",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "10",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "11",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "12",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
    {
      "number": "13",
      "title": "Спектакль: какой то",
      "body": "cxcxcxcxcvc kjbjbzdbchd"
    },
  ];


   var respond2 = [
    {
      "name": "В. Рочев",
      "body": "Выпускник 2002 года, Санкт-Петербургская государственная академия театрального искусства (актер театра);",
      "photo": '1.jpg'
    },
    {
      "name": "М. Коровина",
      "body": "выпускница 2002 года, Санкт-Петербургская государственная академия театрального искусства, актерское отделение (актриса театра);",
      "photo": '2.jpg'
    },
    {
      "name": "Л. Мелехина",
      "body": "выпускница 2002 года, Санкт-Петербургская государственная академия театрального искусства, актерское отделение (актриса театра);",
      "photo": '3.jpg'
    },
    {
      "name": "И. Тарабукин",
      "body": "выпускник 2002 года, Санкт-Петербургская государственная академия театрального искусства, актерское отделение (актер театра);",
      "photo": '4.jpg'
    },
    {
      "name": "Д. Одинцов",
      "body": "выпускник 2007, РАТИ ГИТИС, актерское отделение;",
      "photo": '5.jpg'
    },
    {
      "name": "А. Есева",
      "body": "выпускница 2007 года, Коми республиканский колледж культуры им. В.Т. Чисталева, режиссура культурно-массовых мероприятий; Кировский филиал Пермского государственного института искусства и культуры, режиссура (режиссер);",
      "photo": ''
    },
     {
      "name": "А. Доронина",
      "body": "выпускница 2011 года, Республиканский колледж искусств (актерское отделение);",
      "photo": '7.jpg'
    },
     {
      "name": "Д. Греченюк",
      "body": "выпускник 2011 года, Республиканский колледж искусств (актерское отделение);",
      "photo": '8.jpg'
    },
     {
      "name": "М. Шучалина",
      "body": "выпускница 2011 года, Республиканский колледж искусств (актерское отделение);",
      "photo": '9.jpg'
    },
     {
      "name": "Н. Белорусов",
      "body": "выпускник 2012 года,Московский государственный институт культуры, институт масс-медиа, кафедра кино и телевидения;",
      "photo": '10.jpg'
    },
     {
      "name": "А. Егорова",
      "body": "выпускница 2014 года, Краснодарский государственный институт культуры и искусств, кафедра театрального искусства, режиссура;",
      "photo": ''
    },
     {
      "name": "А. Чукичева",
      "body": "выпускница 2014 года, Колледж искусств РК, актерское отделение;",
      "photo": '12.jpg'
    },
     {
      "name": "А. Калмыкова",
      "body": "выпускница 2015 года, Колледж искусств РК, актерское отделение;",
      "photo": '13.jpg'
    },
     {
      "name": "И. Николайченко",
      "body": "выпускник 2015 года, Театральный институт им. П.М. Ершова, актерское отделение",
      "photo": '14.jpg'
    }
   ];
   
   var respond3 = [
    {
      "date": "Октябрь 2014 г.",
      "place": "Мурманск",
      "body": 'в региональном этапе Всероссийского  фестиваля   "Салют Победы"  театр-студия "Ордым" завоевал диплом III степени за музыкально-поэтическую композицию "Уляшевы из села Бадъельск"'
    },
     {
      "date": "Ноябрь 2014 г.",
      "place": "Киров",
     "body": 'участие в VI Всероссийском конкурсе художественного слова «Моя Россия» принесло диплом лауреата I степени «ордымовцу» И. Николайченко.'
    },
   
    {
      "date": "Декабрь 2014 г.",
      "place": "Краснодар",
     "body": 'за участие в дистанционном VIII Международном конкурсе среди творческих коллективов и солистов "Первые ласточки" три спектакля нашего театра: «Опаленное детство», «Приключения веселого мышонка» и «Аистенок и Пугало» были награждены дипломами лауреата I, II и III степени в различных возрастных категориях.'
    },
    {
      "date": "Февраль 2015 г.",
      "place": "Москва",
     "body": 'участие в заочном Международном  конкурсе «Талант - 2015» принесло «Ордыму» два диплома лауреата III степени и диплом I степени в различных возрастных категориях за спектакли «Аистенок и пугало», «Опаленное детство», «Приключения веселого мышонка».'
    },
   
     {
      "date": "Март 2015 г.",
      "place": "Объячево",
     "body": 'Республиканский фестиваль народных и любительских театров  «Неделя театров в Прилузье» принес в копилку театра-студии диплом «За использование интерактивных форм в детском спектакле» «Приключения веселого мышонка».'
    },
     {
      "date": "Июнь 2015 г.",
      "place": "Королев",
     "body": 'в поездке на всероссийский театральный фестиваль-мастерские «Театральные витражи» драматическая композиция театра-студии «Не об этом мечтали мы…» по повести Б.Васильева «А зори здесь тихие» стала лауреатом II степени в номинации «Театр»; в номинации «Художественное слово» лауреатами I степени стали Софья Карнацкая и Эльвира Путинцева, лауреатом III степени – Андрей Зуев, дипломантом II степени – Наталья Корсакова.'
    },
   ];
   
   
                  var template = $.templates("#theTmpl");
                  var htmlOutput = template.render(respond);
                  $("#result").html(htmlOutput);
                
                  var template = $.templates("#theTmpl2");
                  var htmlOutput = template.render(respond2);
                  $("#result2").html(htmlOutput);
                  
                  var template = $.templates("#theTmpl3");
                  var htmlOutput = template.render(respond3);
                  $("#result3").html(htmlOutput);
        

  $('.about-slider').slick({
                                  autoplay: true,
                                  autoplaySpeed: 7000,
                                  prevArrow: $('#down'),
                                  nextArrow: $('#up'),
                                  dots: true,
                                  infinite: true,
                                  slidesToShow: 1,
                                  adaptiveHeight: true
                                
                              });

  $('.about-slider-masters').slick({
                                  autoplay: true,
                                  autoplaySpeed: 7000,                               
                                  dots: true,
                                  infinite: true,
                                  slidesToShow: 2,
                                  slidesToScroll: 2,
                                  adaptiveHeight: true
                                
                              });
                              
    $('.about-slider-regards').slick({
                                  autoplay: true,
                                  autoplaySpeed: 7000,                               
                                  dots: true,
                                  infinite: true,
                                  slidesToShow: 2,
                                  slidesToScroll: 2,
                                  adaptiveHeight: true
                                
                              });                         
                            

  $('#office').on('click', function(event) {
          event.preventDefault();
  $('.about-slider').slick('slickGoTo',0);
  });
  $('#autodrome').on('click', function(event) {
          event.preventDefault();
  $('.about-slider-masters').slick('slickGoTo',0);
  });
   $('#regards').on('click', function(event) {
          event.preventDefault();
  $('.about-slider-regards').slick('slickGoTo',0);
  });
                            
                          });


                        
                        
    </script>


    <script id="theTmpl" type="text/x-jsrender">
        <div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="col-xs-12"><h3>
                       {{:title}}</h3>
                    </div>
                    <div class="col-xs-12">
                    {{:body}}
                    </div>
                </div>        
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <img class="img-responsive thumbnail" src="img/presents/{{:number}}.jpg" alt=""/>
                </div>
            </div>
    
    </script>


    <script id="theTmpl2" type="text/x-jsrender">
    <div>
    
    <div class="col-xs-12">
    <strong>
        {{:name}}
    </strong>
    </div>
    <div class="col-xs-12">
        {{:body}}
    </div>
   
    <div class="col-xs-12">
    <img class="img-responsive thumbnail" src="img/outers/{{:photo}}" alt=""/>
    </div>
    </div>
    
    </script>
    
     <script id="theTmpl3" type="text/x-jsrender">
    <div>
    <div class="col-xs-12 col-sm-6"><strong>
    {{:date}}</strong>
    </div>
    <div class="col-xs-12 col-sm-6">
    {{:place}}
    </div>
    <div class="col-xs-12">
    {{:body}}
    </div>
    </div>
    
    </script>
