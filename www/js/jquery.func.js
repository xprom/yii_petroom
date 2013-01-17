var lang = {
    wall_X_seconds_ago_words:["","one second ago","two seconds ago","three seconds ago","four seconds ago","five seconds ago"],
    wall_X_seconds_ago:["","%s second ago","%s seconds ago"],
    wall_X_minutes_ago_words:["","one minute ago","two minutes ago","three minutes ago","4 minutes ago","5 minutes ago"],
    wall_X_minutes_ago:["","%s minute ago","%s minutes ago"],
    wall_X_hours_ago_words:["","one hour ago","two hours ago","3 hours ago","4 hours ago","5 hours ago"],
    wall_X_hours_ago:["","%s hour ago","%s hours ago"],
    weekDays:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"]
}
function isArray(obj) { return Object.prototype.toString.call(obj) === '[object Array]'; }
function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    hours = hours< 10 ? '0'+hours:hours;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}
function dateString()
{
    var date = new Date(petroomNow()*1000);
    return lang.weekDays[date.getDay()] + ' at ' + formatAMPM(date);
}




$(document).ready(function(){
    window['like_count_string'] = function(count){
        if( count>1 )
            count+= ' animals like this';
        else
            count+= ' animal like this';
        return count;
    }

    window['petroomNow'] = function(count){
        return parseInt(+new Date/1000);
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
        <div class="post-date post-left"><div class="like "><span>mir gefällt</span><span class="counter">0</span></div>\
            <span class="time_needs_update" timestamp="'+petroomNow()+'" abs_time="'+dateString()+'">A few seconds ago</span>\ | \
            \
            <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a>\
            | <a href="#" class="comment" onclick="delete_comment(this); return false;">Delete</a></div>\
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

            /**
             * делаем предыдущий комментарий с рамкой снизу
             */
            if(insertComment.prev('.post')
                .hasClass('sub-post'))
                insertComment.prev('.post').addClass('border-bottom');

            insertComment.before('<div class="post sub-post post-text">\
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
                    <span class="time_needs_update" timestamp="'+petroomNow()+'" abs_time="'+dateString()+'">A few seconds ago</span>\
                    | <a href="#" class="comment" onclick="delete_comment(this); return false;">Delete</a>\
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
    window['feed'] = {
        langWordNumeric: function(num, words, arr) {
            if (isArray(words) && num < words.length) {
                return words[num];
            }
            return arr[2].replace('%s',num);
        },
        feedTimeUpdater:function(){
            $('.time_needs_update').each(function(){
                var timeRow  = parseInt($(this).attr('timestamp')),
                    diff     = parseInt(petroomNow() - timeRow),
                    timeText = $(this).attr('abs_time'),

                    date = new Date(petroomNow()*1000),
                    date_yesterday = new Date(petroomNow()*1000),
                    date_post = new Date(timeRow*1000);

                date_yesterday.setDate(date_yesterday.getDate()-1);

                if (diff < 2)
                {
                    timeText = 'A few seconds ago';
                } else if (diff < 60) {
                    timeText = feed.langWordNumeric(diff,lang.wall_X_seconds_ago_words,lang.wall_X_seconds_ago);
                } else if (diff < 3600) {
                    timeText = feed.langWordNumeric(parseInt(diff / 60),lang.wall_X_minutes_ago_words,lang.wall_X_minutes_ago);
                } else if (diff < 4 * 3600) {
                    timeText = feed.langWordNumeric(parseInt(diff / 3600),lang.wall_X_hours_ago_words,lang.wall_X_hours_ago);
                } else if(date.getDay()==date_post.getDay() && date.getMonth()==date_post.getMonth() && date.getYear()==date_post.getYear()) {
                    timeText = 'Today at '+formatAMPM(date_post);
                } else if(date_yesterday.getDay()==date_post.getDay() && date_yesterday.getMonth()==date_post.getMonth() && date_yesterday.getYear()==date_post.getYear()) {
                    timeText = 'Yesterday at '+formatAMPM(date_post);
                }
                $(this).html(timeText);
            })

            window.setTimeout(window['feed'].feedTimeUpdater,1000);
        }
    }

    window['delete_comment'] = function(el){

        $.ajax({
            url:'?deletePost=1',
            data:{
                postId:$(el).parents('.post')
                    .find('input.post-id')
                    .val()
            }
        });

        $(el).parents('.post')
             .data('html',$(el).parents('.post').html())
             .html('Post deleted. <a href="#" onclick="undelete_comment(this); return false;" class="undo-delete">Undo</a>');
    }

    window['undelete_comment'] = function(el){
        var post = $(el).parents('.post')
             .html( $(el).parents('.post').data('html') );

        $.ajax({
            url:'?unDeletePost=1',
            data:{
                postId:post.find('input.post-id')
                    .val()
            }
        });
    }

    /**
     * обновляем время у каждой новости
     */
    window.setTimeout(window['feed'].feedTimeUpdater,1000);

    /**`
     * показывае все комментарии
     */
    $('.post .comment-count').click(function(){
        $(this).parents('.post')
               .find('.post')
               .show();
        $(this).hide();
        return false;
    })

    /**
     * работа со списком друзей
     * подтверждение статуса друга
     */
    $('.add-friends-new .add-friend').click(function(){

        $('.counter-table td:eq(0) span').html(parseInt($('.counter-table td:eq(0) span').html())+1);

        $('.add-friend-section-show').show();
        $('.add-friend-section-show a.title span').html( parseInt($('.add-friend-section-show a.title span').html())+1 );

        var new_friend_link = $(this).parents('.add-friends-new')
            .find('a:eq(0)');

        var count_current_friend = parseInt($('.add-friend-section-show a.title span').html());
        if(count_current_friend>9)
        {
            $('.add-friend-section-show a.show-all').show();
            $('.add-friend-section-show img:last').parents('a').remove();
        }

        $('.add-friend-section-show a.title').after('' +
            '<a target="_blank" href="'+new_friend_link.attr('href')+'" class="fried">\
                <img class="thumb" src="'+new_friend_link.find('img').attr('src')+'" align="absmiddle" />\
            </a>');

        /**
         * счётчик друзей в меню пользователя
         */
        $('#new-friend-count').html(parseInt($('#new-friend-count').html())-1);
        if(parseInt($('#new-friend-count').html())==0)
            $('#new-friend-count').hide();

        $.ajax({
            url:'/?confirmFriend=1',
            data: {
                friendId:$(this).parents('.add-friends-new')
                              .find('input[name=friend_user_id]')
                              .val()
            }
        });

        if($('.add-friends-new').size()==1)
        {
            $('#friend-new-list')
                .animate({
                    opacity:0
                },500,function (){
                    $(this).remove();
                });
        }
        else
        {
            $(this).parents('.add-friends-new')
                .animate({
                    opacity:0
                },500,function (){
                    $(this).remove();
                });
        }


        return false;
    })

    /**
     * оставить друга в подписчиках моей страницы
     */
    $('.add-friends-new .deleter-friend').click(function(){

        $('.counter-table td:eq(1) span').html(parseInt($('.counter-table td:eq(1) span').html())+1);

        /**
         * счётчик друзей в меню пользователя
         */
        $('#new-friend-count').html(parseInt($('#new-friend-count').html())-1);
        if(parseInt($('#new-friend-count').html())==0)
            $('#new-friend-count').hide();

        $.ajax({
            url:'/?deleteFriend=1',
            data: {
                friendId:$(this).parents('.add-friends-new')
                              .find('input[name=friend_user_id]')
                              .val()
            }
        });

        if($('.add-friends-new').size()==1)
        {
            $('#friend-new-list')
                .animate({
                    opacity:0
                },500,function (){
                    $(this).remove();
                });
        }
        else
        {
            $(this).parents('.add-friends-new')
                .animate({
                    opacity:0
                },500,function (){
                    $(this).remove();
                });
        }


        return false;
    })

    /**
     * удаление всех связей
     */
    $('.add-friends-new .remove-friend').click(function(){

        /**
         * счётчик друзей в меню пользователя
         */
        $('#new-friend-count').html(parseInt($('#new-friend-count').html())-1);
        if(parseInt($('#new-friend-count').html())==0)
            $('#new-friend-count').hide();

        $.ajax({
            url:'/?removeFriend=1',
            data: {
                friendId:$(this).parents('.add-friends-new')
                              .find('input[name=friend_user_id]')
                              .val()
            }
        });



        if($('.add-friends-new').size()==1)
        {
            $('#friend-new-list')
                .animate({
                    opacity:0
                },500,function (){
                    $(this).remove();
                });
        }
        else
        {
            $(this).parents('.add-friends-new')
                .animate({
                    opacity:0
                },500,function (){
                    $(this).remove();
                });
        }


        return false;
    })

    $('.show_all_new_friend').click(function(){
       $('.add-friends-new.hidden').show();
        $(this).hide();
    })
})


