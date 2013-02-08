
    <div class="inner-content">
        <div class="content">
            <div class="border-bottom">
                <table class="counter-table counter-table-inner" width="100%">
                    <tr>
                        <td>
                            <span></span><a href="/profile/<?=trim($_SESSION['MEMBERS']['username']);?>"><?=trim($_SESSION['MEMBERS']['name']);?></a> hat bereits <?=count($presentList);?> Geschenke erhalten
                        </td>
                    </tr>
                </table>
            </div>


            <?php
            foreach((array)$presentList as $k => $value)
            {
                ?>
                <div class="post <?=(++$k!=count((array)$presentList)?'border-bottom':'');?>">
                    <div class="post-logo">
                        <span class="online"></span>

                        <a href="/profile/<?=trim($value['username']);?>">
                            <img class="thumb" src="/photos/<?=trim($value['image_50']);?>" />
                        </a>

                        Online
                    </div>

                    <a href="/profile/<?=trim($value['username']);?>"><b><?=trim($value['name']);?></b></a>


                    <div class="post-left post-text">
                        <?=nl2br($value['message']);?><br />
                        <p align="center"></a><img src="i/<?=$value['image'];?>" class="no-border" /></p>
                    </div>
                    <div class="post-date post-left"><?=Post::timeFormat($value['date']);?> | <a href="/profile/<?=trim($value['username']);?>">Geschenke von <?=trim($value['name']);?></a></div>
                </div>
                <?
            }
            ?>

        </div>
    </div>
