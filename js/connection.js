 $(document).ready(function () {
         
         $('#education').on('click', function(event) {
                                    event.preventDefault();
                  $('#connection-case').animate({'marginLeft':'-120%'},{duration:400,queue:false});   
                  $('#connection-case').fadeOut(400);  
                  setTimeout(function(){ $('.preloader').show(); },400);
               
         });
       
         
     });

