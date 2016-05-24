<div class="modal-header">
    <button type="button" class="close modal-fix" data-dismiss="modal" aria-hidden="true">&times;</button>
<?php include './elements/popmenu.php'; ?>
    <h4 class="modal-title" id="myModalLabel">Галерея</h4>
</div>
<div class="modal-body">
  

    <div id="lightgallery">
        <a href="img/gallery/1.jpg">
            <img src="img/gallery/1_tmb.jpg" class="img-thumbnail"  />
      </a>
       <a href="img/gallery/2.jpg">
            <img src="img/gallery/2_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/3.jpg">
            <img src="img/gallery/3_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/4.jpg">
            <img src="img/gallery/4_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/5.jpg">
            <img src="img/gallery/5_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/6.jpg">
            <img src="img/gallery/6_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/7.jpg">
            <img src="img/gallery/7_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/8.jpg">
            <img src="img/gallery/8_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/9.jpg">
            <img src="img/gallery/9_tmb.jpg" class="img-thumbnail" />
      </a>
        
         <a href="img/gallery/11.jpg">
            <img src="img/gallery/11_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/12.jpg">
            <img src="img/gallery/12_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/13.jpg">
            <img src="img/gallery/13_tmb.jpg" class="img-thumbnail" />
      </a>
         <a href="img/gallery/14.jpg">
            <img src="img/gallery/14_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/15.jpg">
            <img src="img/gallery/15_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/16.jpg">
            <img src="img/gallery/16_tmb.jpg" class="img-thumbnail"  />
      </a>
         
         <a href="img/gallery/18.jpg">
            <img src="img/gallery/18_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/19.jpg">
            <img src="img/gallery/19_tmb.jpg" class="img-thumbnail"  />
      </a>
         <a href="img/gallery/20.jpg">
            <img src="img/gallery/20_tmb.jpg" class="img-thumbnail"  />
      </a>
        <a href="img/gallery/21.jpg">
            <img src="img/gallery/21_tmb.jpg" class="img-thumbnail"  />
      </a>
        <a href="img/gallery/22.jpg">
            <img src="img/gallery/22_tmb.jpg" class="img-thumbnail"  />
      </a>
        <a href="img/gallery/23.jpg">
            <img src="img/gallery/23_tmb.jpg" class="img-thumbnail" />
      </a>
        <a href="img/gallery/24.jpg">
            <img src="img/gallery/24_tmb.jpg" class="img-thumbnail" />
      </a>
        <a href="img/gallery/25.jpg">
            <img src="img/gallery/25_tmb.jpg" class="img-thumbnail" />
      </a>
        <a href="img/gallery/26.jpg">
            <img src="img/gallery/26_tmb.jpg" class="img-thumbnail" />
      </a>
        <a href="img/gallery/27.jpg">
            <img src="img/gallery/27_tmb.jpg" class="img-thumbnail" />
      </a>
        <a href="img/gallery/28.jpg">
            <img src="img/gallery/28_tmb.jpg" class="img-thumbnail" />
      </a>
        <a href="img/gallery/29.jpg">
            <img src="img/gallery/29_tmb.jpg" class="img-thumbnail" />
      </a>
       
        <a href="img/gallery/31.jpg">
            <img src="img/gallery/31_tmb.jpg" class="img-thumbnail" />
      </a>
       
        <a href="img/gallery/33.jpg">
            <img src="img/gallery/33_tmb.jpg" class="img-thumbnail" />
      </a>
        <a href="img/gallery/34.jpg">
            <img src="img/gallery/34_tmb.jpg" class="img-thumbnail" />
      </a>
      
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-modal-footer" data-dismiss="modal">Закрыть</button>
</div>





    <script type="text/javascript">
        
                
        $(document).ready(function() {
            $("#lightgallery").lightGallery(); 
                      
          $('#lightgallery img').hide();
        setTimeout(function () {
            
        var maxwidth = '19.7%';    
        var width =  $('#lightgallery').width();
        console.log(width);
       if (width < 350) {
           maxwidth = '98%';
           console.log('xs');
       }
       
       if (width > 350) {
           maxwidth = '49%';
           console.log('sm');
       }
       
       if (width > 500) {
           maxwidth = '32.3%';
           console.log('md');
       };
       
       if (width > 700) {
           maxwidth = '18.7%';
           console.log('md');
       };
       
       if (width > 800) {
           maxwidth = '19.3%';
           console.log('md');
       };
       
           
            $('#lightgallery img').css('max-width', maxwidth);
            $('#lightgallery img').fadeIn('slow'); 
        }, '300');  
        
         




         });
         
         
         


         
         
    </script>


