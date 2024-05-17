$('.btn').click(function(){
    $('.dropdown-menu').toggle();
 });
 
 $('#choice').change(function () {
     if($(this).val() == "") {
        $(this).addClass("empty");
        
      }
     else {
        $(this).removeClass("empty")}
       
 });
 
     $('form > div input, form > div select').change(function() {
         var empty = false;
       
        $('.req').each(function(){
           if ($(this).val()==""){
           $(this).removeClass('ui-full')
        }
        else {
           $(this).addClass('ui-full');
        }
        });
        
          if ($('#choice').val()==""){
                   empty = true;
                }
         $('form > div input').each(function() {
             if ($(this).val() == '' ){
                 empty = true;
              
             }
          
         });
       
       
         if (empty) {
             $('#btn').attr('disabled', 'disabled'); 
         } 
         else {
            
             $('#btn').removeAttr('disabled'); 
         }
      
     });
 
 $('.referral').submit(function(e) {
    if (this.checkValidity()){
       e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, 600);
    
       $('#refer_name').html($('#name').val());
         $('#refer_pos').html($('#position').val());
         $('.modal').slideDown().addClass('show').removeClass('shrink');
       e.preventDefault();
    }
    else {}
 });
 
 $('.close-modal').click(function(){
    $('.modal').removeClass('show').addClass('shrink').slideUp();
 })
 
 $('.reset').click(function(){
    $('.modal').removeClass('show').addClass('shrink').slideUp();
   $('.req').val("").removeClass('ui-full');
   $('#choice').val("").addClass('empty');
      $('#btn').attr('disabled', 'disabled'); 
 });
 
 $('select').focus(function(){
    $('.dropdown-wrapper').addClass('outline');
 });
 
 $('select').on('focusout',function(){
    $('.dropdown-wrapper').removeClass('outline');
 });
 
 $('.pos-card').click(function(){
    $('.desc').removeClass('reveal');
   $(this).find('.desc').toggleClass('reveal');
 
 });
 
 $('.refer').click(function(e){
    e.stopPropagation();
  //  $('.positions').animate({ height: 'toggle', opacity: 'toggle' }, 'medium');
    $('.positions').addClass('fadeOut');
    $('.refer-card').addClass('fade');
    $('.return').fadeIn('fast');
 });
 
 $('.return').click(function(){
    $('.refer-card').removeClass('fade');
      $(this).hide();
    $('.positions').delay('200').removeClass('fadeOut');
    $('.desc').removeClass('reveal');
 });
 
 $('#pos_1 .refer').click(function(){
    $('#position').val('UI/UX Designer').addClass('ui-full');
    $('#choice').val(4).removeClass('empty');
 });
 
 $('#pos_2 .refer').click(function(){
    $('#position').val('Sales Manager').addClass('ui-full');
    $('#choice').val(2).removeClass('empty');
 });
 
 $('#pos_3 .refer').click(function(){
    $('#position').val('Business Analyst').addClass('ui-full');
    $('#choice').val(6).removeClass('empty');
 });
 
 