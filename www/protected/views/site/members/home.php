

    <div class="inner-content">
        <div class="content">
            <div class="insert-news border-bottom">
                <div id="insert-post-attache">
                    <a href="#" id="insert-news"></a>
                    <a href="#" id="insert-map"></a>
                    <a href="#" id="insert-link"></a>
                    <a href="#" id="insert-photo"></a>
                    <a href="#" id="insert-video"></a>
                </div>
                <textarea name="text" rows="0" class="radius" void-text="Teile hier etwas">Teile hier etwas</textarea>
                <div id="media-holder">
                </div>
                <div id="send-button-post-div">
                    <input type="button" class="submin-button" value="Send" />
                </div>
            </div>
            <?php
            foreach((array)$wall as $key => $value)
            {
                ?>
                <div class="post post-<?=$value['id'];?> <?=count($wall)!=++$key?'border-bottom':'';?>">
                    <input type="hidden" name="post[<?=$value['id'];?>]" class="post-id" value="<?=$value['id'];?>" />
                    <div class="post-logo">
                        <span class="online"></span>

                        <a href="/profile/<?=trim($value['username']);?>">
                            <img class="thumb" src="/photos/<?=trim($value['image_50']);?>" />
                        </a>

                        Online
                    </div>

                    <a href="/profile/<?=trim($value['username']);?>"><b><?=trim($value['name']);?></b></a>

                    <?
                    if(!empty($value['image_news']) && $value['photo_folder_title']==Photo::PHOTO_THUMB_FOLDER_TITLE)
                    {
                        print 'hat Profilbild aktualisiert';
                    }
                    ?>

                    <br />

                    <div class="post-left post-text">
                        <?=nl2br(trim($value['text']));?>

                        <?
                        if(!empty($value['map_x']) && !empty($value['map_y']) && !empty($value['zoom']) )
                        {
                            ?>
                            <div class="post-media">
                                <input type="hidden" name="map_x" value="<?=$value['map_x'];?>" />
                                <input type="hidden" name="map_y" value="<?=$value['map_y'];?>" />
                                <input type="hidden" name="zoom" value="<?=$value['zoom'];?>" />
                                <img align="text-top" width="180" height="70" src="http://maps.googleapis.com/maps/api/staticmap?center=<?=$value['map_x'];?>,<?=$value['map_y'];?>&amp;zoom=<?=$value['zoom'];?>&amp;size=180x70&amp;sensor=false&amp;language=en">
                                <div class="marker-shadow">
                                </div>
                            </div>
                            <?
                        }

                        if(!empty($value['image_news']))
                        {
                            ?>
                            <a class="fancy_feed_photo" title="Loading..." post-id="<?=$value['id'];?>" href="#d<?=$value['id'];?>"><img src="/photos/<?=$value['image_news'];?>" /></a>
                            <div id="d<?=$value['id'];?>" style="display:none;">
                                <img class="photo_fancy" src="/photos/<?=$value['image_1024_news'];?>" align="absmiddle" />
                            </div>
                            <?
                        }

                        if(!empty($value['link']))
                        {
                            print '<div class="post-media"><div class="media-holder-link">';

                            if(!empty($value['image']))
                            {
                                ?>
                                </a><img src="<?=$value['image'];?>" />
                                <?
                            }

                            ?>
                                <table class="<?=empty($value['image'])?'void_image':'';?>">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a target="_blank" href="<?=$value['link'];?>">
                                                    <?=$value['title'];?>
                                                </a><br />
                                                <?=$value['description'];?>
                                                <br />
                                                <br />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div></div>
                            <?
                        }
                        ?>
                    </div>


                    <div class="post-date post-left">
                        <div image-arr="<?=$value['like_images'];?>" class="like-<?=$value['id'];?> like <?=!empty($value['like_active'])?'like-active':'';?>"><span>mir gefällt</span><span class="counter"><?=intval($value['like_count']);?></span></div>
                        <span class="time_needs_update" timestamp="<?=intval($value['date']);?>" abs_time="<?=Post::timeFormat($value['date']);?>"><?=Post::timeFormatFeed($value['date']);?></span>
                        | <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a>
                        <?
                        if($value['user_id']==$_SESSION['MEMBERS']['ID'])
                        {
                            ?>
                            | <a href="#" class="comment" onclick="delete_comment(this); return false;">Delete</a>
                            <?
                        }
                        ?>
                    </div>

                    <?
                    if(count((array)$value['comment'])>10)
                    {
                        ?>
                        <div class="comment-count post-left">Alle <?=count((array)$value['comment']);?> Kommentare anzeigen</div>
                        <?
                    }
                    ?>

                    <?
                    foreach((array)$value['comment'] as $k => $v)
                    {
                        $hidden = '';
                        if(count((array)$value['comment'])>10)
                        {
                            if($k<count((array)$value['comment'])-5)
                            {
                                $hidden = 'hidden';
                            }
                        }

                        ?>
                        <div class="post post-<?=$v['id'];?> sub-post <?=$hidden;?> <?=count($value['comment'])!=++$k?'border-bottom':'';?>" post-text">
                            <input type="hidden" name="post[<?=$v['id'];?>]" class="post-id" value="<?=$v['id'];?>" />
                            <div class="post-logo">
                                <span class="online"></span>

                                <a href="/profile/<?=trim($v['username']);?>">
                                    <img class="thumb" src="/photos/<?=trim($v['image_50']);?>" />
                                </a>
                                Online
                            </div>

                            <a href="/profile/<?=trim($v['username']);?>"><b><?=trim($v['name']);?></b></a>
                            <br />

                            <div class="post-left">
                                <?=nl2br($v['text']);?>
                            </div>

                            <div class="post-date post-left">
                                <div image-arr="<?=$v['like_images'];?>" class="like-<?=$v['id'];?> like <?=!empty($v['like_active'])?'like-active':'';?>"><span>mir gefällt</span><span class="counter"><?=intval($v['like_count']);?></span></div>
                                <span class="time_needs_update" timestamp="<?=intval($v['date']);?>" abs_time="<?=Post::timeFormat($v['date']);?>"><?=Post::timeFormatFeed($v['date']);?></span>
                                <?
                                if($v['user_id']==$_SESSION['MEMBERS']['ID'])
                                {
                                    ?>
                                    | <a href="#" class="comment" onclick="delete_comment(this); return false;">Delete</a>
                                    <?
                                }
                                ?>
                            </div>
                        </div>
                        <?
                    }
                    ?>

                    <div class="insert-comment <?=count((array)$value['comment'])>0?:'hidden';?>">
                        <textarea name="text" class="radius">Schreib hier dein Kommentar</textarea>
                    </div>
                </div>
                <?
            }
            ?>

        </div>
    </div>
