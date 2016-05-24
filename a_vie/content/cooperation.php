<div class="modal-header">
    <button type="button" class="close modal-fix" data-dismiss="modal" aria-hidden="true">&times;</button>
<?php include './elements/popmenu.php'; ?>
    <h4 class="modal-title" id="myModalLabel">Сотрудничество</h4>
</div>
<div class="modal-body">
   <div class="container-fluid">
       <div class="row">
           <div class="col-md-12 text-center">
               <h4 class="text-uppercase">Партнеры театра</h4>
               <span>Театр осуществляет активное взаимодействие со следующими организациями</span>
           </div> 
           <div class="col-md-12">
               <div class="slider-cooperation text-center" id="cooperation">  
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
          
          var cooperation = [
    {
      "name": "Театр оперы и балета",
      "body": "",
      "photo": "1.jpg"
    },
    {
      "name": "Драматический театр",
      "body": "",
      "photo": "2.jpg"
    },
    {
      "name": "Колледж искуств республики Коми",
      "body": "",
      "photo": "3.jpg"
    },
    {
      "name": "Юрган",
      "body": "",
      "photo": "4.jpg"
    },
    {
      "name": 'Журнал "Арт"',
      "body": "",
      "photo": "5.png"
    },
    {
      "name": 'Фестиваль: "Театральные витражи" ',
      "body": "",
      "photo": "6.jpg"
    },
     {
      "name": "Коми республиканский колледж культуры им. Чисталева",
      "body": "",
      "photo": "7.png"
    },
     {
      "name": 'Ансамбль народных песен "Околица"',
      "body": "",
      "photo": "8.png"
    },
     {
      "name": "Коми республиканская филармония",
      "body": "",
      "photo": "9.png"
    },
    
          ];
          
                  var template = $.templates("#tmpl-cooperation");
                  var htmlOutput = template.render(cooperation);
                  $("#cooperation").html(htmlOutput);
          
      
      
       $('.slider-cooperation').slick({
                                  autoplay: true,
                                  autoplaySpeed: 7000,                               
                                  dots: true,
                                  infinite: true,
                                  slidesToShow: 5,                               
                                  responsive: [
                                {
                                  breakpoint: 486,
                                  settings: {
                                    autoplay: true,
                                    arrows: false,                                   
                                   
                                    slidesToShow: 1
                                  }
                                }

                              ]
                              });
             
               $('.slider-cooperation').slick('slickGoTo',0);

              
          
          
       });  
       
       
       </script>
       
<script id="tmpl-cooperation" type="text/x-jsrender">
    <div>
    <div class="col-xs-12" style="margin-top:30px;"><img class="img-responsive " src="img/cooper/{{:photo}}" alt=""/>
    </div>
    <div class="col-xs-12"><strong>
    {{:name}}</strong>
    </div>
    <div class="col-xs-12">
    {{:body}}
    </div>
    </div>
    
</script>