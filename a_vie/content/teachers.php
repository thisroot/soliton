<div class="modal-header">
    <button type="button" class="close modal-fix" data-dismiss="modal" aria-hidden="true">&times;</button>
<?php include './elements/popmenu.php'; ?>
    <h4 class="modal-title" id="myModalLabel">Преподаватели</h4>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a data-toggle="tab" id="equipment" href="#about1">Оснащение</a></li>
                    <li><a data-toggle="tab" href="#about2" id="exams" >Поступление</a></li>
                    <li><a data-toggle="tab" href="#about4" id="lessons" >Дисциплины</a></li>
                    <li><a data-toggle="tab" href="#about3" id="teachers">Преподаватели</a></li>                  
                </ul>
            </div>
            <div class="tab-content col-md-9">
                <div id="about1" class="tab-pane fade in active">
                     <h4>Оснащение театра</h4>
                    <div class="slider-equipment" id="result-equipment">  
                    </div>
                    
                </div>
                <div id="about2" class="tab-pane fade">
                     <h4>Поступление</h4>
                     <p>
                         Чтобы стать участником нашего театра нужно поступить на 
                         театральное отделение «Гимназии искусств при Главе Республики Коми»
                         им. Ю.А. Спиридонова  в 7, 8 или 10. Традиционно вступительные испытания
                         проводятся по окончании учебного года, в июне.
                       
                     </p>
                     <p> Абитуриенты готовят чтецкую программу:</p>
                     <ul>
                         <li>
                             Стихотворение
                         </li>
                         <li>
                             Басню
                         </li>
                         <li>
                             Отрывок из прозаического произведения
                         </li>
                         <li>
                             Песню
                         </li>
                     </ul>
                     <p>
                         При желании и наличии инструмента поступающий может 
                         продемонстрировать владение музыкальным инструментом; 
                         показать танцевальный номер.
                     </p>
                </div>
                 <div id="about4" class="tab-pane fade">
                     <h4>Дисциплины</h4>
                     <p>
                         В настоящее время педагогами отделения ведется работа по созданию 
                         дополнительной предпрофессиональной общеобразовательной программы в
                         области театрального искусства «Искусство театра» с пятилетним сроком 
                         обучения (с 7 по 11 класс общеобразовательной школы)
                     </p>
                     <p>
                         Эта программа включает в себя следующие предметы:
                     </p>
                     <div class="row">
                         <div class="col-xs-12 col-sm-6">
                             <ul>
                                 <li>
                                     Основы актерского мастерства;
                                 </li>
                                 <li>
                                     Художественное слово;
                                 </li>
                                 <li>
                                     Сценическое движение;
                                 </li>
                                 <li>
                                     Ритмика;
                                 </li>
                                 <li>
                                     Танец;
                                 </li>
                                 <li>
                                     История театра;
                                 </li>
                             </ul>
                         </div>
                          <div class="col-xs-12 col-sm-6">
                             <ul>
                                 <li>
                                     Сценарное мастерство;
                                 </li>
                                 <li>
                                     Слушание музыки и музыкальная грамота;
                                 </li>
                                 <li>
                                     Вокальный ансамбль;
                                 </li>
                                 <li>
                                    Сольное пение;
                                 </li>
                                 <li>
                                     Грим
                                 </li>
                                 
                             </ul>
                         </div>
                     </div>
                     <p>
                         Уроки проводятся в форме групповых и индивидуальных занятий во 
                         второй половине учебного дня с 15:00 до 18:00 часов, время, как 
                         правило, предназначенное для досуга.
                     </p>
                     <p>
                         В процессе обучения воспитанников большая часть учебного времени 
                         посвящена осуществлению разнообразных творческих проектов, во время 
                         которых «ордымовцы» приобретают огромный опыт сценической практики,
                         навык публичного выступления.
                     </p>
                </div>
                
                 <div id="about3" class="tab-pane fade">
                      <h4>Преподавательский состав</h4>
                      <div class="slider-teachers" id="result-teachers">  
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
          
          
           var teachers = [
               
    {
      "name": "Виктор Михайлович Напалков",
      "body": "создатель театра, заслуженный работник РК, лауреат государственной преми правительства РК, режиссер-постановщик и художественный руководитель театра-студии «Ордым»;",
      "photo": "1.jpg"
    },
    {
      "name": "Наталья Михайловна Гнедых",
      "body": "педагог театральных дисциплин, заслуженный работник культуры РФ, заслуженный работник РК, лауреат государственной премии правительства РК;",
      "photo": "2.jpg"
    },
    {
      "name": "Наталья Петровна Михеева",
      "body": "лауреат всероссийских конкурсов, педагог театральных дисциплин;",
      "photo": "3.jpg"
    },
    {
      "name": "Ирина Николаевна Джигалло",
      "body": "педагог театральных дисциплин;",
      "photo": "4.jpg"
    },
    {
      "name": "Екатерина Николаевна Мосова",
      "body": "педагог театральных дисциплин;",
      "photo": "5.jpg"
    },
     {
      "name": "Оксана Ивановна Роман",
      "body": "педагог по танцу;",
      "photo": "6.jpg"
    },
    
    {
      "name": "Светлана Валентиновна Малькова",
      "body": "актриса драматического театра им. В.Савина;",
      "photo": "7.jpg"
    },
     {
      "name": "Владимир Григорьевич Рочев",
      "body": "актер драматического театра им. В.Савина, лауреат государственной премии правительства РК.",
      "photo": "8.jpg"
    },
     {
      "name": "Татьяна Михайловна Попова;",
      "body": "Режиссер",
      "photo": "9.jpg"
    },
     {
      "name": "Ирина Федоровна Рюхова",
      "body": "Режиссер",
      "photo": "10.jpg"
    },
     {
      "name": "Леонид Владимирович Джигалло",
      "body": "Режиссер",
      "photo": "11.jpg"
    },
     {
      "name": "Денис Александрович Рассыхаев",
      "body": "актер и режиссер драматического театра им. В.Савина",
      "photo": "12.jpg"
    },
     {
      "name": "Надежда Николаевна Изюмская",
      "body": "почетный работник культуры РК, педагог колледжа культуры РК им. В.Чисталева",
      "photo": "13.jpg"
    },
     {
      "name": "Валентина Максимовна Муратова",
      "body": "почётный работник среднего профессионального образования РФ, педагог колледжа культуры РК им. В.Чисталева;",
      "photo": "14.jpg"
    },
    {
      "name": "Мария Леонидовна Владимирова",
      "body": "кандидат педагогических наук, преподаватель театральных дисциплин детской школы искусств №11 г. Киров;",
      "photo": "15.jpg"
    },
    
    ]
    
    
    var equipment = [
         {
     "name":"Учебный корпус",
     "body":"",
     "photo":""             
    },
    
     {
     "name":"Общежитите",
     "body":"",
     "photo":""             
    },
        
     {
     "name":"Концертный зал",
     "body":"В концертном зале сосредоточена основная работа нашего театра: здесь в специальных аудиториях проходят занятия по актерскому мастерству, речи, проводятся встречи и мастер-классы, ведутся теоретические и индивидуальные занятия. Здесь есть даже небольшая театральная костюмерная.",
     "photo":""            
    },
      {
     "name":"Костюмерная",
     "body":"",
     "photo":""             
    },
     {
     "name":"Зал хореографии",
     "body":"",
     "photo":""             
    },
    ]

                  var template = $.templates("#tmpl-teachers");
                  var htmlOutput = template.render(teachers);
                  $("#result-teachers").html(htmlOutput);
                  
                  var template = $.templates("#tmpl-equipment");
                  var htmlOutput = template.render(equipment);
                  $("#result-equipment").html(htmlOutput);
                  
                
     
    $('.slider-teachers').slick({
                                  autoplay: true,
                                  autoplaySpeed: 7000,                               
                                  dots: true,
                                  infinite: true,
                                  slidesToShow: 2,
                                  slidesToScroll: 2,
                                  adaptiveHeight:true,                                  
                                  responsive: [
                                {
                                  breakpoint: 768,
                                  settings: {
                                    autoplay: true,
                                    arrows: false,                                                                    
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                  }
                                }

                              ]
                              });
     $('.slider-equipment').slick({
                                  autoplay: true,
                                  autoplaySpeed: 7000,                               
                                  dots: true,
                                  infinite: true,
                                  slidesToShow: 1,
                                  slidesToScroll: 1,
                                  adaptiveHeight:true                                  
                                  
                              });
                              
   
  $('#teachers').on('click', function(event) {
          event.preventDefault();
  $('.slider-teachers').slick('slickGoTo',0);

  });
  
   
  $('.slider-equipment').slick('slickGoTo',0);

  
  
  
  
      });
      
 </script>

<script id="tmpl-teachers" type="text/x-jsrender">
    <div>
    <div class="col-xs-12">
     <img class="img-responsive thumbnail" src="img/teachers/{{:photo}}" alt=""/>
    </div>
    <div class="col-xs-12">
    <strong>{{:name}}</strong>
    </div>
    <div class="col-xs-12">
   {{:body}}
    </div>
    </div>   
</script>

<script id="tmpl-equipment" type="text/x-jsrender">
    <div>
    <div class="col-xs-12 col-sm-8">
    <div class="col-xs-12">
      <strong>{{:name}}</strong>
    </div>
    <div class="col-xs-12">
    {{:body}}
    </div>
    </div>
    <div class="col-xs-12 col-sm-4">
   <img class="img-responsive thumbnail" src="img/equipment/{{:photo}}" alt=""/>
    </div>
    </div>   
</script>


