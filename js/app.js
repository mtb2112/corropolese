(function($){

    $(document).ready( function(){
        $(window).on('load',function(){
            $('#cff.cff-fixed-height, .twitter-feed-wrap .ctf-type-usertimeline').mCustomScrollbar({
                theme: 'corropolese'
            });
        });

        $(".alert .close").click(function() {
          $( ".alert" ).remove();
        });
    });

})(jQuery);