<div class="modal-header">
    <button type="button" class="close modal-fix" data-dismiss="modal" aria-hidden="true">&times;</button>
    <?php include './elements/popmenu.php'; ?>
    <h4 class="modal-title" id="myModalLabel">События</h4>
</div>
<div class="modal-body">


    <div class="btn-group btn-group-justified">
        <a href="#" class="btn btn-primary btn-filter">Все новости</a>
        <a href="#" class="btn btn-primary btn-filter">Спектакль</a>
        <a href="#" class="btn btn-primary btn-filter">За кадром</a>
        <a href="#" class="btn btn-primary btn-filter">Мероприятие</a>

    </div>  

    <div class="row events-body">
        <div class="col-sm-8 col-md-8 events-col ">
            
            <div id="result"></div>
           
        </div>
        <div class="col-md-4 col-sm-4">
            <div id="my-calendar"></div>
        </div>
    </div>



</div>
<div class="modal-footer">
    <button type="button" id="nextpage" class="btn btn-modal-footer pull-left">Следующая страница</button> 
    <button type="button" class="btn btn-modal-footer" data-dismiss="modal">Закрыть</button>
</div>


<script type="application/javascript">
    
   
   $(document).ready(function () {
        
    $("#my-calendar").zabuto_calendar({
    language: "ru",
    today: true,
    nav_icon: {
    prev: '<i class="fa fa-chevron-circle-left"></i>',
    next: '<i class="fa fa-chevron-circle-right"></i>',
    },
   ajax: {
          url: "a_mdl/m_calendar.php",
          modal: true
      }
    });
    
       
    
   

    var page = 1;
    var count;
   
    $('#nextpage').on('click', function (event) {
        event.preventDefault();
        var countNews = $('.newssection').length;
        
        if (countNews == '3' ) {            
             page = page + 1;
             count = page + 1;
             console.log('first way');
             console.log(countNews);       
           $('#nextpage').text('Дальше');
            
        }
        
        else  {
            page = 1;
            count = 2;
            console.log('second way');
            console.log(countNews);  
            $('#nextpage').text('Дальше');
        }
        
            
                
        $('#modal').animate({ scrollTop: 0 }, 'slow');
        getnews(page);
        
       
        
    });
    
    getnews(page);
    
    function getnews(page) {   
        var get = new FormData();
        get.append('form', 'getnews');
        get.append('page', page);


         $.ajax({
                url: 'a_mdl/m_submit.php',
                type: 'POST',
                data: get,
                cache: false,
                dataType: 'json',
                processData: false, // Не обрабатываем файлы (Don't process the files)
                contentType: false, // Так jQuery скажет серверу что это строковой запрос
                success: function (respond, textStatus, jqXHR) {

           //     console.log(respond);
                
                
                 var cnt = 0;
                 for (var i = 0; i < respond.length; i++) {
                     if (respond[i] !== undefined) {
                         ++cnt;
                     }
                 }         
               // console.log(cnt);
               
                                
                var template = $.templates("#theTmpl");
                var htmlOutput = template.render(respond);
                $.when($("#result").html(htmlOutput)).done(
                openFullPage()
                    );
                    
                 
                    // Если все ОК

                    if (typeof respond.error === 'undefined') {
                    }
                    else {
                        console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('ОШИБКИ AJAX запроса: ' + textStatus);
                }
            });      
    }
    
    
     function openFullPage(){                    
                      $('.newssection').on('click', function (event) {                                       
                            $(this).find('.news-full').css('margin-left','15px');
                            $(this).find('.news-full').css('margin-top','15px');
                            $(this).find('.news-full').css('margin-bottom','15px');
                            $(this).find('.news-full').css('margin-right','15px');                 
                                var width = $(this).find('.panel-news').width() +'px';                                
                    if ($(this).find('.news-full').is(':visible')) {
                           $(this).find('.news-full').slideUp('slow'); }        
                    else { 
                        $(this).find('.news-full').slideDown('slow'); }                
                          }); }
                    
    });
    
    
    
    
    
    
    
</script>





<script id="theTmpl" type="text/x-jsrender">
    
 <section class="newssection" id = "toggle" style="cursor:pointer">
   
    <div class="panel panel-default panel-news">
   
        <div class="panel-heading">
            <span class="news-status bg-purple pull-right">{{:theme}}</span>
            <div class="panel-title ">
            {{:subject}}
            </div>
        </div>
        <div class="panel-body"></div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-5 col-news-image ">
                <img src="{{:thumb}}" class="img-responsive" style ="max-height:185px;"> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-7 col-news-content">
            
                <div class="news-short toggle">
                {{:shmessage}}                          
                </div>
                
           
                <hr>
                <div class="news-info container-fluid">                                
                    <span class="fa fa-ellipsis-v"></span>
                    <span class="fa fa-clock-o"></span><span>{{:ago}}</span>
                    <span class="fa fa-ellipsis-v"></span>
                       
                </div>
        <hr>
            </div>
            
                <div class="col-md-12">
                    <div class="news-full toggle" style="display:none" >
                     {{:message}}  
                    </div>
                </div>
            
        </div>
       
    </div>
    
</section>
</script>





<!--
{{:theme}}
{{:subject}}
{{:thumb}}
{{:message}}
{{:views}}
{{:timeago}}

-->


