<div class="page-content">
<div class="aside">
    <div class="status border-bottom">
        <div><?=CHtml::encode($_SESSION['MEMBERS']['name']);?>’s Status:<a href="#" class="pancel"></a></div>
        <a void-text="set status message" href="#" <?=trim($_SESSION['MEMBERS']['status'])==''?'class="text-status void-status"':'class="text-status"';?>>
            <?php
            if(trim($_SESSION['MEMBERS']['status'])!='')
                print CHtml::encode($_SESSION['MEMBERS']['status']);
            else
                print 'set status message';
            ?>
        </a>
    </div>
    <div class="share border-bottom">
        <a href="#" class="button button-big button-big-find"></a>
        <a href="#" class="button button-big button-big-group"></a>
        <a href="#" class="button button-big button-big-events"></a>
    </div>
    <?
    /**
     * новые заявки в друзья
     */
    if(count($newFriend)>0)
    {
        ?>
        <div class="friends border-bottom" id="friend-new-list">
            <a class="title">Vorschläge:</a>
            <div class="add-friends-holder">
                <?
                foreach($newFriend as $k => $value)
                {
                    $hidden = '';
                    if($k>2)
                        $hidden = 'hidden';

                    ?>
                    <div class="add-friends-new <?=$hidden;?>">
                        <input type="hidden" name="friend_user_id" value="<?=intval($value['id']);?>" />

                        <a target="_blank" href="/profile/<?=trim($value['username']);?>">
                            <img class="thumb" src="/photos/<?=trim($value['image_31']);?>" />
                        </a>
                        <a target="_blank" href="/profile/<?=trim($value['username']);?>">
                            <b><?=trim($value['name']);?></b>
                        </a><br />
                        <a href="#" class="add-friend">Hinzufügen</a>
                        <a href="#" class="remove-friend">Folgen</a>
                        <a href="#" class="deleter-friend"></a>
                    </div>
                    <?
                }

                if(count($newFriend)>3)
                {
                    ?>
                    <a href="#" class="show_all_new_friend">Mehr Vorschläge ›</a>
                    <?
                }
                ?>
            </div>
        </div>
        <?
    }
    ?>

    <?
    $hidden_friend_list = '';
    if(count($this->myFriend)==0)
    {
        $hidden_friend_list = 'hidden';
    }
    ?>
    <div class="friends add-friend-section-show border-none <?=$hidden_friend_list;?>">
        <a class="title">Gemeinsame Freunde (<span><?=count($this->myFriend);?></span>):</a>

        <?
        foreach((array)$this->myFriend as $value)
        {
            $hidden = '';
            if($k>8 && count($this->myFriend)>10)
                $hidden = 'hidden';

            ?>
            <a href="/profile/<?=trim($value['username']);?>" class="fried">
                <img class="thumb" src="/photos/<?=trim($value['image_31']);?>" align="absmiddle" />
            </a>
            <?
        }

        if(count($this->myFriend)>10)
        {
            ?>
            <a href="#" class="show-all">Alle ›</a>
            <?
        }
        else
        {
            ?>
            <a href="#" class="show-all hidden">Alle ›</a>
            <?
        }
        ?>
        <div class="clear-left add-friend-section-show border-bottom <?=$hidden_friend_list;?>"></div>
    </div>


    <div class="groups border-bottom">
        <a class="title">Meine Veranstaltungen (12):</a>
        <div class="group-row">
            <img src="i/group-fish.png" />
            <a href=""><b>Workshop Spiel<br>
                und Spass</b></a><br />
            <a href="#" class="location">Gockhausen, ZH</a><br />
            <span class="time">Sa, 20.02.12</span>
        </div>
        <div class="group-row">
            <img src="i/group-fish.png" />
            <a href=""><b>Workshop Spiel<br>
                und Spass</b></a><br />
            <a href="#" class="location">Gockhausen, ZH</a><br />
            <span class="time">Sa, 20.02.12</span>
        </div>
        <div class="group-row">
            <img src="i/group-fish.png" />
            <a href=""><b>Workshop Spiel<br>
                und Spass</b></a><br />
            <a href="#" class="location">Gockhausen, ZH</a><br />
            <span class="time">Sa, 20.02.12</span>
        </div>
        <a href="#">weitere</a>
    </div>
    <div class="ads">
        <div class="ads-holder">
            <span class="pick"></span>
            Anzeige
            <img src="i/ads.png" />
        </div>
    </div>
</div>

<div class="logo-holder">
    <div class="logo">
        <a class="fancy_feed_photo" href="/photos/<?=$_SESSION['MEMBERS']['image_1024'];?>">
            <img src="/photos/<?=$_SESSION['MEMBERS']['image_thumb'];?>" class="thumb" />
        </a>
        <input type="hidden" name="image_50" value="<?=trim($_SESSION['MEMBERS']['image_50']);?>" />
        <input type="hidden" name="image_31" value="<?=trim($_SESSION['MEMBERS']['image_31']);?>" />
        <input type="hidden" name="members_name" value="<?=trim($_SESSION['MEMBERS']['name']);?>" />
        <input type="hidden" name="members_home" value="<?=trim($_SESSION['MEMBERS']['username']);?>" />
        <a href="#" class="pancel"></a>
    </div>

    <h1><?=$_SESSION['MEMBERS']['name'];?></h1>
    <div class="status-line">
        <span>Tierart:</span> Katze; <span>Rasse:</span> Exotic Shorthair; <span>Geboren:</span> 31. August 2006; <span>Wohnort:</span> 6003, Luzern ... <a href="#">bearbeiten</a> <a href="#" class="pancel"></a>
    </div>
    <ul class="date-hidtory">
        <li>
            <a href="#" class="radius active">Jetzt</a>
        </li>
        <li>
            <a href="#" class="radius">Dezember</a>
        </li>
        <li>
            <a href="#" class="radius">November</a>
        </li>
        <li>
            <a href="#" class="radius">August</a>
        </li>
        <li>
            <a href="#" class="radius">2010</a>
        </li>
        <li>
            <a href="#" class="radius">2009</a>
        </li>
        <li>
            <a href="#" class="radius">2008</a>
        </li>
        <li>
            <a href="#" class="radius">2007</a>
        </li>
        <li>
            <a href="#" class="radius">Geburt</a>
        </li>
    </ul>
</div>

<div class="left-menu">
    <div class="border-bottom">
        <table class="counter-table" width="100%">
            <tr>
                <td width="33%">
                    <span><?=count($this->myFriend);?></span><br />
                    Freunde
                </td>
                <td width="33%" class="middle">
                    <span><?=intval($_SESSION['MEMBERS']['follower_count']);?></span><br />
                    Folger
                </td>
                <td width="34%">
                    <span><?=intval($_SESSION['MEMBERS']['folgs_count']);?></span><br />
                    Folgt
                </td>
            </tr>
        </table>
    </div>
    <div class="border-bottom">
        <ul>
            <li>
                <a href="<?=CHtml::normalizeUrl(array('profile/'.$_SESSION['MEMBERS']['username']));?>">Info</a>
            </li>
            <li>
                <a href="<?=CHtml::normalizeUrl(array('/wall'));?>"><span>457</span>Pinnwand</a>
            </li>
            <li>
                <a href="<?=CHtml::normalizeUrl(array('photos/index'));?>"><span>457</span>Fotos</a>
            </li>
            <li>
                <a href="#">Videos</a>
            </li>
            <li>
                <a href="#"><span class="green">5 km</span>Revier</a>
            </li>
        </ul>
    </div>
    <div class="border-bottom">
        <ul>
            <li>
                <a href="#"><?=count($newFriend)>0?'<span id="new-friend-count">'.count($newFriend).'</span>':'';?>Freunde</a>
            </li>
            <li>
                <a href="#">Folger</a>
            </li>
        </ul>
    </div>
    <div class="border-bottom">
        <ul>
            <li>
                <a href="#"><span class="red">457</span>Stammbaum</a>
            </li>
            <li>
                <a href="#"><span class="yello">457</span>Mitbewohner</a>
            </li>
            <li>
                <a href="#"><span class="blue">33</span>Geschenke</a>
            </li>
            <li>
                <a href="#">Auszeichnungen</a>
            </li>
        </ul>
    </div>
    <div class="border-bottom">
        <ul>
            <li>
                <a href="#">Gruppen</a>
            </li>
            <li>
                <a href="#">Veranstaltungen</a>
            </li>
            <li>
                <a href="#">Links</a>
            </li>
        </ul>
    </div>

    <div class="border-bottom ads">
        <a><b>Innovative Weiterbildung</b></a><br />
        <b><span>hslu.ch/weiterbildung</span></b>
        <img src="i/left-ads.png" />
        Machen Sie mehr aus sich.
        Mit einer Weiterbildung an
        der Hochschule Luzern. Jetzt
        Info-Unterlagen bestellen!
    </div>
</div>