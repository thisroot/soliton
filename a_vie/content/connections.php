<div class="modal-header">
    <button type="button" class="close modal-fix" data-dismiss="modal" aria-hidden="true">&times;</button>
<?php include './elements/popmenu.php'; ?>
    <h4 class="modal-title" id="myModalLabel">Связь</h4>
</div>
<div class="modal-body">
    <div class="container-fluid" style="min-height: 200px;">
    <div class="row">
        <div class="col-md-12"><h5 id="header-message" class="h-color-main text-center text-uppercase">Выберите тему Ваших коммуникаций</h5></div>
        <div class="row text-center" id="connection-case">
           
            
            
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="question-block hvr hvr-bounce-in" id="education">                   
                    <div class="col-md-12"><span class="flaticon flaticon-people"></span></div>
                    <div class="col-md-12 text-lowercase"><h5>Вопросы <br> Обучения <br> в отделении</h5></div>                    
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="question-block hvr hvr-bounce-in" id="action">                   
                    <div class="col-md-12"><span class="flaticon flaticon-fair15"></span></div>
                    <div class="col-md-12 text-lowercase"><h5>Вопросы <br> по заказу <br> мероприятий</h5></div>                    
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <div class="question-block hvr hvr-bounce-in" id="sponsors">                   
                    <div class="col-md-12"><span class="flaticon flaticon-briefcase69"></span></div>
                    <div class="col-md-12 text-lowercase"><h5>Вопросы <br> спонсорского <br>участия</h5></div>                    
                </div>
            </div>           
        </div>
        <div class="row" id="connection-form" style="display: none;">
            <form id="question-form" role="form">
                <div class="row-fluid">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <input name="name" id="name" class="form-control input-sm" placeholder="Ф.И.О" type="text">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <input name="text" id="phone" class="form-control input-sm" placeholder="Номер телефона" type="text">
                        </div>
                    </div>
                     <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <input name="email" id="email" class="form-control input-sm" placeholder="Электронная почта" type="email">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <textarea name="message" rows="5" id="message" class="form-control input-md" placeholder="Оставьте сообщение"></textarea>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
       
    </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" id="back" class="btn btn-modal-footer pull-left" style="display: none">Вернуться</button>
    <button type="button" id="success" class="btn btn-modal-footer pull-left ajax-respond" style="display: none">Отправить</button>
    <button type="button" class="btn btn-modal-footer" data-dismiss="modal">Закрыть</button>
</div>

<script type="application/javascript">
    
     $(document).ready(function () {
         
         var theme;
         
         $('.question-block').on('click', function(event) {
                                    event.preventDefault();
                                    
                  theme = $(this).attr('id');
                //  console.log(theme);
                  $('#connection-case').animate({'marginLeft':'-120%'},{duration:400,queue:false});   
                  $('#connection-case').fadeOut(400);
                  $('#header-message').text('Оставьте свое сообщение');
                  $('#connection-form').fadeIn(600);
                  $('#connection-form').animate({'marginLeft':'0%'},{duration:400,queue:false});                  
                  $('#success').fadeIn(600);
                  $('#back').fadeIn(600);
       
            });
            
             $('#back').on('click', function(event) {                                
                                    event.preventDefault();
                  $('#success').fadeOut(600);
                  $('#back').fadeOut(600);                  
                  $('#connection-form').animate({'marginLeft':'-120%'},{duration:400,queue:false});   
                  $('#connection-form').fadeOut(400);
                  $('#header-message').text('Выберите тему Ваших коммуникаций');
                  $('#connection-case').fadeIn(600);
                  $('#connection-case').animate({'marginLeft':'0%'},{duration:400,queue:false});     
                 
       
            });
            
            
             $('#success').click(function (e) {
                e.preventDefault(); 
                
                var data = new FormData();
                data.append('form', 'connections');
                data.append('theme', theme);
                data.append('name', $('#name').val());
                data.append('phone', $('#phone').val());
                data.append('email', $('#email').val());
                data.append('message', $('#message').val());
                
             //   console.log(theme);
             //   console.log($('#name').val());
            //    console.log($('#phone').val());
             //   console.log($('#email').val());
           //     console.log($('#message').val());
        
        $.ajax({
            
            url: 'a_mdl/m_submit.php',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function (respond, textStatus, jqXHR) {

                // Если все ОК

                if (typeof respond.error === 'undefined') {
                    // Файлы успешно загружены, делаем что нибудь здесь

                    // выведем пути к загруженным файлам в блок '.ajax-respond'
               //     var files_path = respond.files;
                    
               //     var html = '';
               //     $.each(files_path, function (key, val) {
               //         html += val + '<br>';
               //     });
                    
                    $('.ajax-respond').text('Отправлено').fadeIn('slow');
                    resetFormInputs('form');
                        setTimeout(function() {
                       
                        $('#modal').modal('hide');
                        $('#modal').removeData();
                    }, 2000);
                }
                else {
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('ОШИБКИ AJAX запроса: ' + textStatus);
                $('.ajax-respond').text('Отправлено без вложений').fadeIn('slow');
                resetFormInputs('form');              
                setTimeout(function() {
                    $('#modal').modal('hide');
                    $('#modal').removeData();
                   
                }, 2000);
                
            }
        });
        
        
    });
    
    
    
        // очистка форм
function resetFormInputs(context) {

    $(':input', context)
            .removeAttr('checked')
            .removeAttr('selected')
            .not(':button, :submit, :reset, :hidden')

            .each(function () {
                $(this).val($(this).prop('defautValue'));
            });

    // очистка плагина чекбоксов iCheck
    $('form').find('div').removeClass('checked');
}


Array.prototype.clean = function (deleteValue) {
    for (var i = 0; i < this.length; i++)
    {
        if (this[i] == deleteValue)
        {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
};

    
    
            
            
     });
     
     
     
     
     
     
     
     
     
     
</script>



