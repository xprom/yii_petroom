$(document).ready(function(){
    window['like_count_string'] = function(count){
        if( count>1 )
            count+= ' animals like this';
        else
            count+= ' animal like this';
        return count;
    }

    window['petroomNow'] = function(count){
        return +new Date;
    }

    $('#login-holder input[name=nickname]').focus(function(){
        if( $(this).val()=='Tiername' )
            $(this).val('');

        $(this).addClass('focus');
    });

    $('.like ').live('click',function(){
        $(this).toggleClass('like-active');
        if( $(this).hasClass('like-active'))
        {
            $(this).find('span.counter').html( parseInt($(this).find('span.counter').html())+1 );
            $.ajax({
                url:'/?makeLike=1',
                data: {
                    postId:$(this).parents('.post')
                                  .find('input.post-id')
                                  .val()
                }
            });
            $(this).mouseenter();
            var hover_id = $(this).data('hover_id');
            var like_string = $('input[name=members_home]').val() + '||' + $('input[name=image_31]').val();
            var image_arr = $(this).attr('image-arr');
            if(typeof(image_arr)=='undefined')
                image_arr = like_string;
            else
                image_arr = like_string + '//' + image_arr;

            $(this).attr('image-arr',image_arr);

            $('#'+hover_id).find('.tool-tip-count-holder')
                           .html(like_count_string(parseInt($(this).find('span.counter').html())));


            $('#'+hover_id).find('.line')
                           .css({marginLeft:'-31px'})
                           .prepend('<a href="/profile/'+ $('input[name=members_home]').val() +'"><img align="absmiddle" class="thumb" src="/photos/'+ $('input[name=image_31]').val() +'" /></a>')
                           .animate({
                                marginLeft:0
                            },100);
        }
        else
        {
            $(this).find('span.counter').html( parseInt($(this).find('span.counter').html())-1 );
            var current_count = parseInt($(this).find('span.counter').html());
            $(this).mouseenter();

            var hover_id = $(this).data('hover_id');
            var like_string = $('input[name=members_home]').val() + '||' + $('input[name=image_31]').val();
            var image_arr = $(this).attr('image-arr');
            image_arr = image_arr.replace(like_string,'');
            image_arr = image_arr.replace('////','');

            $(this).attr('image-arr',image_arr);


            $('#'+hover_id).find('.line')
                           .animate({marginLeft:'-31px'},100,function(){
                                $(this).find('img:eq(0)')
                                       .remove();
                                $(this).css({marginLeft:'0px'});
                           });

            $('#'+hover_id).find('.tool-tip-count-holder')
                           .html(like_count_string(current_count));

            /**
             * если никого не осталось,
             * кому бы нравился данный пост
             * то сразу скрываем
             */
            if(current_count==0)
            {
                $(this).mouseout();
            }

            $.ajax({
                url:'/?unLike=1',
                data: {
                    postId:$(this).parents('.post')
                        .find('input.post-id')
                        .val()
                }
            });
        }
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
            <a href="/profile/'+$('input[name=members_home]').val()+'"><img class="thumb" src="/photos/'+$('input[name=image_50]').val()+'"></a>\
            Online\
            </div>\
        <a href="/profile/'+$('input[name=members_home]').val()+'"><b>'+$('input[name=members_name]').val()+'</b></a><br />\
            <div class="post-left post-text">\
            '+$('.insert-news textarea').val().replace(/\n/g,"<br>")+'\
            </div>\
        <div class="post-date post-left"><div class="like "><span>mir gefällt</span><span class="counter">0</span></div>Donnerstag um 20:54 | <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a></div>\
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
            $(this).parents('.insert-comment')
                   .addClass('insert-comment-focus')
                   .show();
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

                /**
                 * если нет ниодного комментария у данной статьи - то скрываем и форму добавления
                 */
                if( $(self).parents('.post')
                           .find('.sub-post')
                           .size()==0 )
                {
                    $(self).parents('.insert-comment')
                           .hide();
                }

                if($.trim($(self).val())=='')
                    $(self).val('Schreib hier dein Kommentar');
            },200);
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
        else
        {
            var insertComment = $(this).parents('.insert-comment');
            insertComment.before('<div class="post sub-post border-bottom post-text">\
                <div class="post-logo">\
            <span class="online"></span>\
            <a href="/profile/'+$('input[name=members_home]').val()+'"><img class="thumb" src="/photos/'+$('input[name=image_50]').val()+'"></a>\
            Online\
            </div>\
        <a href="/profile/'+$('input[name=members_home]').val()+'"><b>'+$('input[name=members_name]').val()+'</b></a><br />\
                <div class="post-left">\
                ' + $.trim(text.val()).replace(/\n/g,"<br>") + '\
                </div>\
            <div class="post-date post-left">\
            <div class="like"><span>mir gefällt</span><span class="counter">0</span></div>\
            Donnerstag um 20:54\
        </div>\
            </div>');
            $.ajax({
                url:'?savePost=1',
                data:{
                    text:$.trim(text.val()),
                    parent_id:$(this).parents('.post')
                                     .find('input.post-id')
                                     .val()
                }
            });

            text.val('Schreib hier dein Kommentar');
            text.blur();
            return false;
        }
    });

    $('.post .insert-comment textarea').live('blur',function(){

        if($(this).val()=='')
            $(this).val('Schreib hier dein Kommentar');

    });

    /**
     * лайк новостей
     */
    $('.like').hover(function(){

        var count = parseInt($(this).find('span.counter').html());
        if(count==0)
            return false;

        count = like_count_string(count);
        if($(this).hasClass('hover'))
        {
            var hover_id = $(this).data('hover_id');
            clearTimeout(window['close_tip' + hover_id]);
            var tip = $('#'+hover_id);
            tip.stop();
            tip.css('visibility','visible');
            if($('.ie7').size()==0)
                tip.animate({opacity:0.8},100);

            return false;
        }

        $(this).addClass('hover');
        var hover_id = 'hover'+new Date().getTime();
        $(this).data('hover_id',hover_id);
        $(this).attr('id','like'+hover_id);

        var image_string = $(this).attr('image-arr');
        var image_arr = image_string.split('//');
        var tip_img_str = '';
        for(x in image_arr)
        {
            var s = image_arr[x].split('||');
            if(typeof(s[1])!='undefined')
                tip_img_str += '<a href="/profile/'+ s[0] +'"><img align="absmiddle" class="thumb" src="/photos/'+ s[1] +'"></a>';
        }

        tip = $('<div class="tool-tip" id="'+hover_id+'"><span class="tool-tip-count-holder">'+count +'</span><br /><div class="line-holder"><div class="line">' +
            tip_img_str +
            '</div></div><div class="tr">&nbsp;</div></div>');

        var offset = $(this).offset();

        tip.appendTo( $('body') );
        tip.css({ top: offset.top - 80 + 'px', visibility: 'hidden' });


        //tip.css({marginTop:'-'+ ( $(tip).height() + 19 ) +'px'})
//           .css({marginLeft:'-'+Math.round(0.5*($(tip).width()+25)) +'px'});
        tip.css('visibility','visible');
        if($('.ie7').size()==0)
            tip.animate({opacity:0.8},100);
    },function(){
        ~function(self){
            var hover_id = $(self).data('hover_id');
            window['close_tip' + hover_id] = window.setTimeout(function(){
                var tip = $('#'+hover_id);
                tip.animate({opacity:0},250,function(){
                    $(this).remove();
                    $(self).removeClass('hover')
                           .removeData('hover_id');
                });
            },400);
        }(this);
    });

    $(".tool-tip").live({
        mouseenter:
            function(){
                var hover_id = $(this).attr('id');
                clearTimeout(window['close_tip' + hover_id]);
                $(this).stop()
                       .css('visibility','visible');

                if($('.ie7').size()==0)
                    $(this).animate({opacity:0.8},100);
            },
            mouseleave:function(){
                var hover_id = $(this).attr('id');

                window['close_tip' + hover_id] = window.setTimeout(function(){
                    var tip = $('#'+hover_id);
                    tip.animate({opacity:0},250,function(){
                        $(this).remove();

                        $('#like'+hover_id).removeClass('hover')
                                           .removeData('hover_id');
                    });
                },400);
            }
        }
    );


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

    /**
     * обновление времени публикации статьи
     */
    $('.time_needs_update').each(function(){


    })

    /**
     *
     */
    $('.post .comment-count').click(function(){
        $(this).parents('.post')
               .find('.post')
               .show();
        $(this).hide();
        return false;
    })
})


//each(geByClass('rel_date_needs_update', cont || ge('page_wall_posts'), 'span'), function(k, v) {
//    if (!v) return;
//    var timeRow = intval(v.getAttribute('time')), diff = timeNow - timeRow, timeText = v.getAttribute('abs_time');
//    if (diff < 5) {
//        timeText = getLang('wall_just_now');
//    } else if (diff < 60) {
//        timeText = Wall.langWordNumeric(diff, cur.lang.wall_X_seconds_ago_words, cur.lang.wall_X_seconds_ago);
//    } else if (diff < 3600) {
//        timeText = Wall.langWordNumeric(intval(diff / 60), cur.lang.wall_X_minutes_ago_words, cur.lang.wall_X_minutes_ago);
//    } else if (diff < 4 * 3600) {
//        timeText = Wall.langWordNumeric(intval(diff / 3600), cur.lang.wall_X_hours_ago_words, cur.lang.wall_X_hours_ago);
//    } else {
//        toClean.push(v);
//    }
//    v.innerHTML = timeText;
//});