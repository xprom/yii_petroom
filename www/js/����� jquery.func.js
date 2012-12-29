$(document).ready(function(){

    $('#login-holder input[name=nickname]').focus(function(){
        if( $(this).val()=='Tiername' )
            $(this).val('');

        $(this).addClass('focus');
    });

    if( $('#login-holder input[name=nickname]').val()!='Tiername' )
        $('#login-holder input[name=nickname]').addClass('focus');

    if( $('#login-holder input[name=email]').val()!='E-Mail-Adresse' )
        $('#login-holder input[name=email]').addClass('focus');

    ~function(){
        if( $('input[name=type-select]').val()!='' )
        {
            var id = $('input[name=type-select]').val();
            $('#login-holder span.text').html( $('#login-holder .select-values a[id='+id+']').html() );
            $('#login-holder .select-values a[id='+id+']').hide();
            $('.select-holder').addClass('focus');
        }
    }();

    $('#login-holder input[type=password]').each(function(){
        if( $(this).val()!='' )
        {
            $(this).addClass('focus')
                   .parents('label')
                   .find('span')
                   .hide();
        }
    })

    $('#login-holder input[name=nickname]').blur(function(){
        if($(this).val()=='')
            $(this).val('Tiername').removeClass('focus');
    });

    $('#login-holder input[name=email], #head_line input[name=email]').focus(function(){
        if( $(this).val()=='E-Mail-Adresse' )
            $(this).val('');

        $(this).addClass('focus');
    });

    $('#login-holder input[name=email], #head_line input[name=email]').blur(function(){
        if($(this).val()=='')
            $(this).val('E-Mail-Adresse').removeClass('focus');
    });

    $('#login-holder input[type=password], #head_line input[type=password]').focus(function(){
        $(this).parents('label').find('span').hide();

        $(this).addClass('focus');
    });

    $('#login-holder input[type=password], #head_line input[type=password]').blur(function(){
        if( $(this).val()=='' )
            $(this).parents('label').find('span').show().removeClass('focus');
    });

    $('ul.lenta').html( $('ul.lenta').html() + $('ul.lenta').html() + $('ul.lenta').html() );
    var lenta_count = $('ul.lenta li').size();
    $('ul.lenta').css('width',lenta_count*125+'px');
    window['slider_c'] = 0;
    window['slider_buzy'] = 0;

    $('.sub-slider a.right').click(function(){

        if(window['slider_buzy'] == 1)
            return false;

        window['slider_buzy'] = 1;
        $('ul.lenta').animate({marginLeft:'-=125px'},function(){
            window['slider_buzy'] = 0;
            if( window['slider_c']==7 || window['slider_c']==-7 )
            {
                window['slider_c'] = 0;
                $('ul.lenta').css({marginLeft:'0px'});
            }
        });
        window['slider_c'] += 1;
        return false;
    })

    $('.sub-slider a.left').click(function(){

        if(window['slider_buzy'] == 1)
            return false;

        window['slider_buzy'] = 1;
        $('ul.lenta').animate({marginLeft:'+=125px'},function(){
            window['slider_buzy'] = 0;
            if( window['slider_c']==7 || window['slider_c']==-7 )
            {
                window['slider_c'] = 0;
                $('ul.lenta').css({marginLeft:'0px'});
            }
        });
        window['slider_c'] -= 1;
        return false;
    })

    $('.select-holder').click(function(){
        $(this).toggleClass('active');
        $('.select-values').toggle();

        return false;
    })

    $('#login-holder .select-values a').click(function(){
        $('.select-holder span').html( $(this).html() );
        $('.select-holder').addClass('focus');
        $('.select-holder').toggleClass('active');
        $('.select-values').toggle();

        $('input[name=type-select]').val( $(this).attr('id') );
        $('#login-holder .select-values a').show();
        $(this).hide();
        return false;
    })

    window['next_slider_speed'] = 3500;
    window['next_slider'] = function(timer){
        var eq = $('.navigator a').index( $('.navigator a.active') );
        eq++;
        if(eq>=4)
            eq = 0;

        $('.navigator a').eq(eq).click();
        if(timer==1)
            window['slider_time'] = window.setTimeout('next_slider();',window['next_slider_speed']);

        return false;
    }

    window.setTimeout('next_slider(1);',window['next_slider_speed']);

    $('.navigator a').click(function(){
        if($(this).hasClass('active'))
            return false;

        clearTimeout(window['slider_time']);


        $('#intro-holder .el').stop();

        $('.navigator a').removeClass('active');
        $(this).addClass('active');

        var eq = $('.navigator a').index(this);
        ~function(eq){
        $('#intro-holder .el').eq( eq ).css({'opacity':0});
        $('#intro-holder .el').animate({opacity:0},{
            duration:'slow',
            complete:function(){
                $('#intro-holder .el').stop();
                $('#intro-holder .el').eq( eq ).animate({'opacity':1},{
                    duration:'slow',
                    complete:function(){
                        window['slider_time'] = window.setTimeout('next_slider();',window['next_slider_speed']);
                    }
                });


            }
        })}(eq);
    })
})