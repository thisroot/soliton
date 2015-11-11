<div id="menu-box" class="pull-right">
    <span class="pop_ctrl"><i class="fa fa-bars"></i></span>
    <ul id="demo_ul_2">
        <li class="demo_li"><a class="link-menu" href="about"><div class="menu-image"></div><div></div></a></li>
        <li class="demo_li"><a class="link-menu" href="events"><div class="menu-image"></div><div></div></a></li>
        <li class="demo_li"><a class="link-menu" href="gallery"><div class="menu-image"></div><div></div></a></li>
        <li class="demo_li"><a class="link-menu" href="connections"><div class="menu-image"></div><div></div></a></li>
        <li class="demo_li"><a class="link-menu" href="teachers"><div class="menu-image"></div><div></div></a></li>
        <li class="demo_li"><a class="link-menu" href="cooperation"><div class="menu-image"></div><div></div></a></li>               
    </ul>
</div>

<script>
    $('#menu-box').popmenu({
        'background': 'rgba(10, 92, 104, 1)',
        'focusColor': 'rgba(57, 175, 191, 1)',
        'borderRadius': '3',
        'top': '-8',
        'left': '100',
        'iconSize': '90px',
        'width': '180px'
    });

    $('.link-menu').on('click', function (event) {
        event.preventDefault();
// получаем адрес для загрузки
        console.log(href);
        var href = './a_vie/content/' + $(this).attr('href') + '.php';

//console.log(href);
//делаем задержку очистки и запуска нового окна
        setTimeout(function () {
            $('#modal').removeData();
            $('#modal').modal({
                remote: href
            });
        }, 800);
// закрываем меню
        $('#modal').modal('hide');

    });




</script>