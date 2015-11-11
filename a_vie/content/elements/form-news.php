
<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">

    <form id="news" role="form">
        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-5">
            <div class="form-group">                    
                <input name="subject" placeholder="Тема" class="form-control" id="subject" type="text">
            </div>
        </div>
        
        
        <div class=" col-xs-12 col-sm-2 col-md-3">
            <div class="form-group">
                <div class="datepicker fuelux" id="myDatepicker">
                    <div class="input-group">
                        <input class="form-control" id="myDatepickerInput" type="text" />
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="fa fa-calendar"></span>
                                <span class="sr-only">Календарь</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right datepicker-calendar-wrapper" role="menu">
                                <div class="datepicker-calendar">
                                    <div class="datepicker-calendar-header">
                                        <button type="button" class="prev"><span class="fa fa-arrow-circle-o-left"></span><span class="sr-only">Previous Month</span></button>
                                        <button type="button" class="next"><span class="fa fa-arrow-circle-o-right"></span><span class="sr-only">Next Month</span></button>
                                        <button type="button" class="title" data-month="11" data-year="2014">
                                            <span class="month">
                                                <span data-month="0">Январь</span>
                                                <span data-month="1">Февраль</span>
                                                <span data-month="2">Март</span>
                                                <span data-month="3">Апрель</span>
                                                <span data-month="4">Май</span>
                                                <span data-month="5">Июнь</span>
                                                <span data-month="6">Июль</span>
                                                <span data-month="7">Август</span>
                                                <span data-month="8">Сентябрь</span>
                                                <span data-month="9">Октябрь</span>
                                                <span data-month="10">Ноябрь</span>
                                                <span data-month="11" class="current">Декабрь</span>
                                            </span> <span class="year">2015</span>
                                        </button>
                                    </div>
                                    <table class="datepicker-calendar-days">
                                        <thead>
                                            <tr>
                                                <th>Вс</th>
                                                <th>Пн</th>
                                                <th>Вт</th>
                                                <th>Ср</th>
                                                <th>Чт</th>
                                                <th>Пт</th>
                                                <th>Сб</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <div class="datepicker-calendar-footer">
                                        <button type="button" class="datepicker-today">Сегодня</button>
                                    </div>
                                </div>
                                <div class="datepicker-wheels" aria-hidden="true">
                                    <div class="datepicker-wheels-month">
                                        <h2 class="header">Месяц</h2>
                                        <ul>
                                            <li data-month="0"><button type="button">Янв</button></li>
                                            <li data-month="1"><button type="button">Фев</button></li>
                                            <li data-month="2"><button type="button">Март</button></li>
                                            <li data-month="3"><button type="button">Апр</button></li>
                                            <li data-month="4"><button type="button">Май</button></li>
                                            <li data-month="5"><button type="button">Июнь</button></li>
                                            <li data-month="6"><button type="button">Июль</button></li>
                                            <li data-month="7"><button type="button">Авг</button></li>
                                            <li data-month="8"><button type="button">Сент</button></li>
                                            <li data-month="9"><button type="button">Окт</button></li>
                                            <li data-month="10"><button type="button">Ноя</button></li>
                                            <li data-month="11"><button type="button">Дек</button></li>
                                        </ul>
                                    </div>
                                    <div class="datepicker-wheels-year">
                                        <h2 class="header">Год</h2>
                                        <ul></ul>
                                    </div>
                                    <div class="datepicker-wheels-footer clearfix">
                                        <button type="button" class="btn datepicker-wheels-back"><span class="glyphicon glyphicon-arrow-left"></span><span class="sr-only">Вернуться к календарю</span></button>
                                        <button type="button" class="btn datepicker-wheels-select">Выбрать <span class="sr-only">Месяц и год</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-2 col-md-2">
            <div class="form-group">     
                
                    <button data-toggle="dropdown" class="btn btn-default btn-blue dropdown-toggle">
                        <i class="icon-remove"></i> Мероприятие 
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li>
                            <input id="ex2_2_1" name="theme" value="1"  type="radio">
                            <label for="ex2_2_1"><i class="icon-edit"></i>Спектакль</label>
                        </li>
                        <li>
                            <input id="ex2_2_2" name="theme" value="2" type="radio">
                            <label for="ex2_2_2"><i class="icon-remove"></i>За кадром</label>
                        </li>
                        <li>
                            <input id="ex2_2_3" name="theme" value="3" type="radio">
                            <label for="ex2_2_3"><i class="icon-print"></i>Мероприятие</label>
                        </li>
                        <li>
                            <input id="ex2_2_4" name="theme" value="4" type="radio">
                            <label for="ex2_2_4"><i class="icon-edit"></i>Загрузка фото</label>
                        </li>
                    </ul>
                
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 col-md-2">
            <div class="form-group">
              <div class="wrapper">
                  <span class="file-input btn btn-blue btn-file">
                      Вложение&hellip;
                  <input type="file"  multiple="multiple" accept=".txt,image/*">
		 </span>
                <a href="#" class="hidden submit button btn">Загрузить файлы</a>
		
	</div>
            </div>
        </div>     
</div>
        <div class="row">
        <div class=" col-md-12">
            <div class="form-group">
                <textarea id="message" placeholder="Новость" name="message" class="form-control" rows="4" id="cmessage"></textarea>                            
            </div>
        </div>
        </div>
    </form>        

</div>


<script type="text/javascript">
    $('#myDatepicker').datepicker({
        allowPastDates: true
    });
    
     var files;
    // Вешаем функцию на событие
    // Получим данные файлов и добавим их в переменную
    $('input[type=file]').change(function () {
        files = this.files;
    });

    $('#submit-news').click(function (e) {
        e.preventDefault();

        // Переменная куда будут располагаться данные файлов
        var data = new FormData();
        
        data.append('form', 'addnews');
        data.append('subject', $('#subject').val());
        data.append('date', $('#myDatepickerInput').val());
        data.append('theme', $('input[name="theme"]:checked').val());
        data.append('message', $('#message').val());
        
        if(!!files) {        
         $.each(files, function (key, value) {
            data.append(key, value);
        });       
        }
              
        // Отправляем запрос

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

    
    /*
    
    $(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});



$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
    
   
});
   
   */ 
</script>