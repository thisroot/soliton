<?php
//ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'] .'sessions/');

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}

session_start();

require_once 'addons/php-auth/classes/Auth.class.php';

?>
<?php require './a_vie/header.php'; ?>
<body>
    
    <!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter36066965 = new Ya.Metrika({
                    id:36066965,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/36066965" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


    <div class="preloader">
        <div class="status">&nbsp;</div>
    </div>
    
     <section class="menu-panel pull-left small-button">
    
    <div class="btn btn-default purple-btn" id="retro">Ретро</div>
    <div class="btn btn-default" id="relax">Релакс</div>
    </section>
    
    <section class="auth-panel">
        
        <?php if (Auth\User::isAdmin()): ?>        
         <div class="auth-user-info">
             <a class="btn-menu" href="auth/admin">
                 <span class="fa fa-2x fa-gears"></span>
             </a>
            
        </div>   
        
        <?php else: ?>
        <?php if (Auth\User::isAuthorized()): ?>
         <div class="auth-user-info">
             <a class="btn-menu" href="auth/authorized">
                 <span class="fa fa-2x fa-user">
                     
                 </span></a>
            
        </div>
        <?php else: ?>
        
        <div class="auth-user-info">
            <a class="btn-menu" href="auth/auth">
                <span class="fa fa-2x fa-user-plus"></span>
            </a>           
        </div>
         <?php endif; ?>   
    <?php endif; ?>
        
        
    </section>
    
    
   
    
    
    <div class="nav">
<section class="cd-section">
	<a class="cd-bouncy-nav-trigger" href="#0">
            <img  style="max-width: 200px;" src="img/logo2.png" alt=""/>
       
        </a>
</section>
        
       
    </div>
  <!--
<div class="cd-bouncy-nav-modal">
	<nav>
		<ul class="cd-bouncy-nav">
                    <li><a href="about" class="btn-menu">Компания</a></li>
                    <li><a href="events" class="btn-menu">Новости</a></li>
                    <li><a href="gallery" class="btn-menu">Услуги</a></li>
                    <li><a href="connections" class="btn-menu">Связь</a></li>
                    <li><a href="teachers" class="btn-menu">Отчеты</a></li>
                    <li><a href="cooperation" class="btn-menu">Загрузки</a></li>
		</ul>
	</nav>	
	<a href="#0" class="cd-close">Close modal</a>
</div> 
-->

<div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
    </div>
  </div>
</div>
   
    <?php require './a_vie/footer.php'; ?>
   
