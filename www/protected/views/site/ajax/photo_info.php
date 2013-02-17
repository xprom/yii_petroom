<table width="100%" class="photo_post post-<?=$post_id;?>">
    <tr>
        <td>
            <div style="padding-bottom:10px;" class="border-bottom">
                <input type="hidden" class="post-id" name="post-id" value="<?=$post_id;?>" />

                Added: <?=$time;?>
                <span class="like-<?=$post_id;?> like <?=!empty($like_active)?'like-active':'';?>" image-arr="<?=$like_images;?>">
                    <span>mir gefällt</span>
                    <span class="counter"><?=$like_count;?></span>
                </span>
            </div>

            <?
            if(count((array)$post_list)>10)
            {
                ?>
                <div class="comment-count post-left">Alle <?=count((array)$post_list);?> Kommentare anzeigen</div>
                <?
            }
            ?>

            <?
            foreach((array)$post_list as $k => $v)
            {
                $hidden = '';
                if(count((array)$post_list)>10)
                {
                    if($k<count((array)$post_list)-5)
                    {
                        $hidden = 'hidden';
                    }
                }

                ?>
                    <div class="post post-<?=$v['id'];?> sub-post <?=$hidden;?> <?=count($post_list)!=++$k?'border-bottom':'';?>" post-text">
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
                            <div image-arr="<?=$v['like_images'];?>" class="like <?=!empty($v['like_active'])?'like-active':'';?>"><span>mir gefällt</span><span class="counter"><?=intval($v['like_count']);?></span></div>
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

            <div class="insert-comment">
                <textarea class="radius" name="text">Schreib hier dein Kommentar</textarea>
            </div>

        </td>
        <td width="15">
            <br />
        </td>
        <td align="right" width="150">
            Album:
            <br />

            <a href="/album/<?=$folder_id;?>"><?=$name;?>'s profile photos</a>
            <br /><br />

            Added by:<br />

            <a href="/profile/<?=$username;?>"><?=$name;?></a>
            <br />
        </td>
    </tr>
</table>



