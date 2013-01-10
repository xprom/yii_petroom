$(document).ready(function(){

    $('#login-holder input[name=nickname]').focus(function(){
        if( $(this).val()=='Tiername' )
            $(this).val('');

        $(this).addClass('focus');
    });

    $('#user_form_login input[name=username]').keypress(function(){
        $('#profile_address_text').html( $(this).val() );
    });

    $('#user_form_login input[name=username]').keyup(function(){
        $('#profile_address_text').html( $(this).val() );
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

    /**
     * смена статуса
     */
    $('.aside .status a').click(function(){
        if($('.aside .status a.void-status').size()==0)
        {
            $('.change-current-status input[type=text]').val($.trim($('.aside .status a.text-status').html()) );
        }
        $('.shadow, .change-current-status').show();
        return false;
    })

    $('.change-current-status input[type=button]').click(function(){
        if($.trim($('.change-current-status input[type=text]').val())=='')
        {
            $('.aside .status a.text-status').html($.trim($('.aside .status a.text-status').attr('void-text')))
                                             .addClass('void-status');
        }
        else
        {
            $('.aside .status a.text-status').html($.trim($('.change-current-status input[type=text]').val()))
                                             .removeClass('void-status');
        }
        $.ajax({
            url:'/?save_status=1',
            data:{
                text:$.trim($('.change-current-status input[type=text]').val())
            }
        });
        $('.shadow, .change-current-status').hide();
    })

    /**
     * вставка нового поста
     */
    $('.insert-news textarea').focus(function(){
        $('#send-button-post-div').show();
        if($.trim($(this).val())==$(this).attr('void-text'))
            $(this).val('');

        $(this).animate({
            height:'50px'
        },{
            complete:function(){

            }
        });
    });

    $('.insert-news textarea').blur(function(){
        if($.trim($(this).val())=='' || $.trim($(this).val())==$(this).attr('void-text'))
        {
            ~function(self){
                window['timer_post_message'] = window.setTimeout(function(){
                    $(self).val($(self).attr('void-text'));
                    $('#send-button-post-div').hide();

                    $(self).animate({
                        height:'18px'
                    },{
                        complete:function(){

                        }
                    });
                },100);
            }(this);
        }
    });

    $('#send-button-post-div input[type=button]').click(function(){
        clearTimeout(window['timer_post_message']);
        $.ajax({
            url:'?savePost',
            data:{
                text:$('.insert-news textarea').val()
            }
        })


        $('.insert-news').after('<div class="post border-bottom">\
            <div class="post-logo">\
            <span class="online"></span>\
            <img class="thumb" src="/photos/'+$('input[name=image_50]').val()+'">\
            Online\
            </div>\
        <a href="/profile/'+$('input[name=members_home]').val()+'"><b>'+$('input[name=members_name]').val()+'</b></a><br />\
            <div class="post-left post-text">\
            '+$('.insert-news textarea').val().replace(/\n/g,"<br>")+'\
            </div>\
        <div class="post-date post-left">Donnerstag um 20:54 | <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a></div>\
        </div>');

        $('.insert-news textarea').val('');
        $('.insert-news textarea').blur();
        return false;
    });

    Window.prototype.show_comment_form = function(el){
        if($(el).parents('.post').find('.insert-comment').size()==0)
        {
            $(el).parents('.post')
                .append('<div class="insert-comment">\
                            <textarea class="radius" name="text">Schreib hier dein Kommentar</textarea>\
                        </div>');
        }
        $(el).parents('.post').find('.insert-comment textarea').focus();
    }

    $('.post .insert-comment textarea').live('focus',function(){

        if( $(this).parents('.insert-comment').find('.submin-button').size()==0 )
        {
            $(this).after('<input type="button" class="submin-button" value="Send"> <span>Ctrl+Enter – send message</span>');
            $(this).before('<img class="thumb" src="/photos/'+$('input[name=image_50]').val()+'">');
            $(this).parents('.insert-comment').addClass('insert-comment-focus');
        }

        if($(this).val()=='Schreib hier dein Kommentar')
            $(this).val('');
    });

    $('.post .insert-comment textarea').live('blur',function(){

        !function(self){
            window['comment_timer'] = window.setTimeout(function(){
                $(self).parents('.insert-comment')
                    .removeClass('insert-comment-focus')
                    .find(':not(textarea)')
                    .remove();

                if($.trim($(self).val())=='')
                    $(self).val('Schreib hier dein Kommentar');
            },100);
        }(this);
    });

    $('.post .insert-comment input[type=button]').live('click',function(){
        clearTimeout(window['comment_timer']);

        var text = $(this).parents('.insert-comment').find('textarea');
        if($.trim(text.val())=='' || $.trim(text.val())=='Schreib hier dein Kommentar')
        {
            text.focus();
            return;
        }

    });

    $('.post .insert-comment textarea').live('blur',function(){

        if($(this).val()=='')
            $(this).val('Schreib hier dein Kommentar');

    });


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