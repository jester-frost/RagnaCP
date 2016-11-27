jQuery(function(){

    $(' .tab-item ').click(function(){
        var link = $(this).attr('href');
        $(' .tab-nav .tab-item ').removeClass(' active ');
        $(' .tab-content > div').addClass('hide');
        $(' .tab-content '+ link).toggleClass('hide');
        $(this).toggleClass('active');
        return false;
    });

    //Leia Mais 
    $('.single-post .more-link').click(function(){
        $(this).parent().fadeToggle();
        $('.publicacao').fadeToggle();
        return false;
    });

    function carousel_width(){    

        // configurações
        var width = 0;
        prev_next = 0;
        element_width = $('.carousel-inner ul li').width() + 10;
        slide = 1;
        number = 1;
        
        $('.carousel-navigation .prev').hide();

        $('.carousel-inner ul li').each(function(){
            width += ($(this).width() + 10);
        });

        $('.carousel-inner ul').width(width);
        // chama a função que criar paginação
        checando();
    }

    // Menu accordion para resetar chars .. bobeirinha mais ajuda a organizar
    $('.reset-char > h4').click(function(){
        $(this).parent().find('div').slideToggle();
    });

    // Se o item do menu tiver submenu o link retorna falso, sem dar refresh ou redicerionar
    $('.menu-item-has-children > a').click(function(){
        return false;
    });

    // Checa elementos no carousel e cria paginação
    function checando() {
        filhos = $('.carousel-inner ul').children().length;
        if (filhos <= 1) {
            $('.carousel-navigation .next').hide()}
        else {
            $('.carousel-navigation .next').show();
        }        if (prev_next > 0) {
            $('.carousel-navigation .prev').show();
        }

        total = filhos * element_width;
        limit = (total - (element_width*slide));
        $('.carousel-pagination').html('<p> <span>' + number +'</span> / '  + filhos +'</p>');
    }

    // removendo refresh
    $('.carousel-navigation .next, .carousel-navigation .prev').click(function(){
        return false;
    });

    // avança elementos
    $('.carousel-navigation .next').click(function(){

        var $carousel_inner = $('.carousel-inner ul');
        prev_next+=(element_width*slide);

        checando();

        if (prev_next == (limit) ) {
            $carousel_inner.animate({"right": (prev_next) });
            $(this).hide();
            
        } else {
            $carousel_inner.animate({"right": (prev_next) });
            $('.carousel-navigation .prev').show();
        }

        number=number+1;
        $('.carousel-pagination').html('<p> <span>' + number +'</span> / '  + filhos +'</p>');
    });

    // regride elementos
    $('.carousel-navigation .prev').click(function(){

        var $carousel_inner = $('.carousel-inner ul');
        prev_next -= (element_width*slide);
        checando();

        if (prev_next == 0){
            $carousel_inner.animate({"right": '0' });
            $(this).hide();
        } else {
            $carousel_inner.animate({"right": (prev_next) });
            $('.carousel-navigation .next').show();
        }
        number=number-1;
        $('.carousel-pagination').html('<p> <span>' + number +'</span> / '  + filhos +'</p>');
    });

    

    $( ".error, .error-msg, .sucess-msg" ).hover(function() {
      $( this ).fadeOut( 500 );
    });
    $(document).ready(function(){
        carousel_width();
        $("#data").mask('0000-00-00');
    });

    $(function(){
        $('.ipt-num').bind('keydown',soNums); 
    });
 
    function soNums(e){
        keyCodesPermitidos = new Array(8,9,37,39,46);
        for(x=48;x<=57;x++){
            keyCodesPermitidos.push(x);
        }
        for(x=96;x<=105;x++){
            keyCodesPermitidos.push(x);
        }
        keyCode = e.which; 
        if ($.inArray(keyCode,keyCodesPermitidos) != -1){
            return true;
        }    
        return false;
    }

    $('.menu-principal .menu-item-has-children').hover(
        function(){
            $('.behavior').fadeToggle();
        }, function() {
            $('.behavior').fadeToggle();
    });
    $('.left .menu li ').hover(function(){
        event.preventDefault();
            $(this).find('.sub-menu').slideToggle();
        });
     
     $('.span-right').click(function(){
            $('.right').animate({
                right:"0"
              }, {
              duration: 500,
              queue: false
            });
            $(this).fadeToggle();
            $('.span-right-fade').fadeToggle();
            $('.behavior').fadeToggle();
     });
     $('.span-right-fade').click(function(){
            $('.right').animate({
                right:"-=40%"
              }, {
              duration: 500,
              queue: false
            });
            $(this).fadeToggle();
            $('.span-right').fadeToggle();
            $('.behavior').fadeToggle();
     });





     $('.span-left').click(function(){
            $('.left').animate({
                left:"0"
              }, {
              duration: 500,
              queue: false
            });
            $(this).fadeToggle();
            $('.span-left-fade').fadeToggle();
            $('.behavior').fadeToggle();
     });
     $('.span-left-fade').click(function(){
            $('.left').animate({
                left:"-=40%"
              }, {
              duration: 500,
              queue: false
            });
            $(this).fadeToggle();
            $('.span-left').fadeToggle();
            $('.behavior').fadeToggle();
     });
     
     $('input[type=submit].proc-edit-account ').click(function(){
        $('.tab-content .form-editar').fadeToggle;
     });

    $("#buscamarota").keyup(function(){
    var texto = $(this).val().toLowerCase();
    $(".rank-player tbody tr").css("display", "table-row");
        $(".rank-player tbody tr").each(function(){
        if($(this).text().toLowerCase().indexOf(texto) < 0)
           $(this).css("display", "none");
        });
    });


    $('.emblema').each(function(){

        canvasid = $(this).find('canvas').attr('id');

        var imageObj = new Image();
        imageObj.src = $(this).find('img').attr('src');
        $(this).find('img').remove();

        canvas = document.getElementById(canvasid);
        var ctx= canvas.getContext("2d");

        ctx.drawImage(imageObj, 0, 0);
        var id= ctx.getImageData(0, 0, canvas.width, canvas.height);

        // Iterate over data.  Data is RGBA matrix so go by +=4 to get to next pixel data.

        for (var i = 0; i < id.data.length; i += 4) {
            // id.data[i] vermelho
            // id.data[i+1] verde
            // id.data[i+2] azul
            // id.data[i+3] alpha    
            if (( id.data[i] == 255 ) & ( id.data[i+1] == 0 ) & ( id.data[i+2] == 255 )){
                id.data[i+3] = 0; //muda magenta para transparente
            }
        }
        ctx.putImageData(id, 0, 0);
        
    });

    // Funções de administração
    
    $(document).delegate(".ip-to-search","click",function(e){
        var link = $(this).attr('href');
            $('.proc-ip .ipt').val(link);
            $('.proc-ip .btn').click();
            $('.ip-tab').click();
        return false;
    });

    $(document).delegate(".acc-id-to-edit","click",function(e){
        var link = $(this).attr('href');
            $('.proc-edit-account #buscamarota').val(link);
            $('.proc-edit-account .btn').click();
            $('.edit-tab').click();
        return false;
    });

    $(document).delegate(".char-id-to-edit","click",function(){
        var link = $(this).attr('href');
            $('.proc-char-acc .ipt').val(link);
            $('.proc-char-acc .btn').click();
            $('.char-info-tab').click();
        return false;
    });


    $(document).delegate(".acc-id-to-ban","click",function(){
        var link = $(this).attr('href');
            $('.proc-ban-acc #account-ban-id').val(link);
            $('.proc-ban-acc .btn').click();
            $('.acc-ban').click();
        return false;
    });


    $(document).delegate(".char-detail","click",function(){
        $(this).children('div').fadeToggle(200);
        return false;
    });

    $(document).delegate(".error, .error-msg, .sucess-msg".hover,function() {
      $( this ).fadeOut( 500 );
    });

});