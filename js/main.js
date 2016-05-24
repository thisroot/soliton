
$("#example, body").vegas({
    slides: [
  
        {src: "./img/bg/theme/retro/1.jpg"},
        {src: "./img/bg/theme/retro/2.jpg"},
        {src: "./img/bg/theme/retro/3.jpg"},
        {src: "./img/bg/theme/retro/4.jpg"},
        {src: "./img/bg/theme/retro/5.jpg"},
        {src: "./img/bg/theme/retro/6.jpg"},
        {src: "./img/bg/theme/retro/7.jpg"},
        {src: "./img/bg/theme/retro/8.jpg"},
        {src: "./img/bg/theme/retro/9.jpg"}
        
    ],
    
    overlay: true,
    transition: [ 'fade', 'fade2' ],
  //  animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ]
 
});

$('#retro').on('click', function(event) {
     event.preventDefault();
  

var slides = [
        {src: "./img/bg/theme/retro/1.jpg"},
        {src: "./img/bg/theme/retro/2.jpg"},
        {src: "./img/bg/theme/retro/3.jpg"},
        {src: "./img/bg/theme/retro/4.jpg"},
        {src: "./img/bg/theme/retro/5.jpg"},
        {src: "./img/bg/theme/retro/6.jpg"},
        {src: "./img/bg/theme/retro/7.jpg"},
        {src: "./img/bg/theme/retro/8.jpg"},
        {src: "./img/bg/theme/retro/9.jpg"}
    ];
$("#example, body").vegas('options', 'slides', slides);

 
});


$('#relax').on('click', function(event) {
     event.preventDefault();
     
     var slides = [
        {src: "./img/bg/4.jpg"},
        {src: "./img/bg/5.jpg"},
        {src: "./img/bg/6.jpg"},
        {src: "./img/bg/7.jpg"},
        {src: "./img/bg/9.jpg"}
    ];
$("#example, body").vegas('options', 'slides', slides);
   
 
 
});



// вызов страниц в модальных окнах
jQuery(document).ready(function($) {
    $('.btn-menu').on('click', function(event) {
        event.preventDefault();
 $('.modal-lg').css('width','950px');
// получаем адрес для загрузки
var name = $(this).attr('href');
var href = './a_vie/content/' + $(this).attr('href') + '.php';

//console.log(href);
// закрываем меню
      var e = jQuery.Event( "click" );
      $( ".cd-close" ).trigger( e );
     
      $('.modal-dialog').removeClass('modal-sm');
      $('.modal-dialog').removeClass('modal-lg');
      $('#modal').removeData();
      
      if ((name == 'auth/auth') || (name == 'auth/authorized')) {
          $('.modal-dialog').addClass('modal-sm');
      }      
      else { $('.modal-dialog').addClass('modal-lg');}
      $('.modal-lg').css('width','950px');
      $('#modal').modal({
          remote: href
      });
    });    
});
  
// функция показа загрузочного логотипа при открытии страницы
jQuery(window).load(function() {
        // will first fade out the loading animation
	jQuery(".status").delay(1000).fadeOut();
        // will fade out the whole DIV that covers the website.
	jQuery(".preloader").delay(1000).fadeOut("slow");
});

//функция центрирования логотипа по середине окна.
$.fn.center = function () {
   this.css("position","absolute");
   this.css("top", ( $(window).height() - this.height() ) / 2  + "px");
   this.css("left", ( $(window).width() - this.width() ) / 2 + "px");
   return this;
};


$.fn.centernav = function () {
   this.css("position","absolute");
   this.css("top", ( $(window).height() )/ 2  + "px");
   return this;
   
};




$(window).load(function()
{
	$('.nav').center();
        $('.cd-bouncy-nav').centernav();
});

$(window).resize(function()
{
	$('.nav').center();
         $('.cd-bouncy-nav').centernav();
});

