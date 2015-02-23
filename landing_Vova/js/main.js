$( document ).ready(function() {
    var clientH = $(window).height(); 
    $('.full-container').height(clientH + 'px');
    console.log("height = " + clientH);
    
    /* smooth scroll event */
    $('a[href^="#"]').on('click',function (e) {
        e.preventDefault();
    
        var target = this.hash;
        var $target = $(target);
    
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });
   
   /* bootstrap scrollspy */
   $('body').scrollspy({target: ".navbar-left"});
   
   /* scrollspy event change bgColor */
   $('.navbar-left').on('activate.bs.scrollspy', function () {
       var location = $(this).find('li.active a').attr('href');
       if(location == "#home") {
            $('body').animate({
               backgroundColor: "#ffffff"
            }, 200);
            return;
       } else if(location == "#hanoi") {
            $('body').animate({
               backgroundColor: "#f8ffc5"
            }, 200);
            return;
       } else if(location == "#hockey") {
            $('body').animate({
               backgroundColor: "#ffbfd4"
            }, 200);
            return;
       } else if(location == "#madhead") {
            $('body').animate({
               backgroundColor: "#e0ffd9"
            }, 200);
            return;
       }
   }) 
    
});

