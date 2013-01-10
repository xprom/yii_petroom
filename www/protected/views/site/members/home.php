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
        <div class="friends border-bottom">
            <a class="title">Vorschläge:</a>
            <div class="add-friends-holder">
                <div class="add-friends-new">
                    <a href="#"><img src="i/fish-1.png" /></a>
                    <a href="#"><b>Garfield06</b></a><br />
                    <a href="#" class="add-friend">Hinzufügen</a>
                    <a href="#" class="remove-friend">Folgen</a>
                    <a href="#" class="deleter-friend"></a>
                </div>
                <div class="add-friends-new">
                    <a href="#"><img src="i/fish-1.png" /></a>
                    <a href="#"><b>Garfield06</b></a><br />
                    <a href="#" class="add-friend">Hinzufügen</a>
                    <a href="#" class="remove-friend">Folgen</a>
                    <a href="#" class="deleter-friend"></a>
                </div>
                <div class="add-friends-new">
                    <a href="#"><img src="i/fish-1.png" /></a>
                    <a href="#"><b>Garfield06</b></a><br />
                    <a href="#" class="add-friend">Hinzufügen</a>
                    <a href="#" class="remove-friend">Folgen</a>
                    <a href="#" class="deleter-friend"></a>
                </div>

                <a href="#">Mehr Vorschläge ›</a>
            </div>
        </div>
        <div class="friends border-bottom">
            <a class="title">Gemeinsame Freunde (23):</a>
            <a href="" class="fried"><img src="i/fish-1.png" align="absmiddle" /></a>
            <a href="" class="fried fried-online"><img src="i/fish-2.png" align="absmiddle" /></a>
            <a href="" class="fried"><img src="i/fish-3.png" align="absmiddle" /></a>
            <a href="" class="fried fried-online"><img src="i/fish-1.png" align="absmiddle" /></a>
            <a href="" class="fried"><img src="i/fish-2.png" align="absmiddle" /></a>
            <a href="" class="fried"><img src="i/fish-3.png" align="absmiddle" /></a>
            <a href="" class="fried fried-online"><img src="i/fish-1.png" align="absmiddle" /></a>
            <a href="" class="fried"><img src="i/fish-2.png" align="absmiddle" /></a>
            <a href="" class="fried"><img src="i/fish-3.png" align="absmiddle" /></a>
            <a href="#" class="show-all">Alle ›</a>
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
            <img src="/photos/<?=$_SESSION['MEMBERS']['image_thumb'];?>" class="thumb" />
            <input type="hidden" name="image_50" value="<?=$_SESSION['MEMBERS']['image_50'];?>" />
            <input type="hidden" name="members_name" value="<?=$_SESSION['MEMBERS']['name'];?>" />
            <input type="hidden" name="members_home" value="<?=$_SESSION['MEMBERS']['username'];?>" />
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
                        <span><?=intval($_SESSION['MEMBERS']['friend_count']);?></span><br />
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
                    <a href="#">Info</a>
                </li>
                <li>
                    <a href="#"><span>457</span>Pinnwand</a>
                </li>
                <li>
                    <a href="#"><span>457</span>Fotos</a>
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
                    <a href="#"><span>457</span>Freunde</a>
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

<div class="inner-content">
<div class="content">
<div class="insert-news border-bottom">
    <textarea name="text" rows="0" class="radius" void-text="Teile hier etwas">Teile hier etwas</textarea>
    <div id="send-button-post-div">
        <input type="button" class="submin-button" value="Send" />
    </div>
</div>

<div class="post border-bottom">
    <div class="post-logo">
        <span class="online"></span>
        <img src="i/post-image.png" />
        Online
    </div>
    <a href="#"><b>Daisy</b></a><br />
    <div class="post-left post-text">
        Um reniae deliciliquo doluptat voluptam nonsect ibusdam, nest, omnia
        con pel ilit fugiant, aut ium iderum ugiant, aut ium iderum
    </div>
    <div class="post-date post-left">Donnerstag um 20:54 | <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a></div>
</div>
<div class="post border-bottom">
    <div class="post-logo">
        <span class="online"></span>
        <img src="i/post-image.png" />
        Online
    </div>
    <a href="#"><b>Lady Sonia</b></a><br />
    <div class="post-left post-text">
        Tempost eaquis dolest officae conseque parum :::::/(())
    </div>

    <div class="post-date post-left">
        <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
        Donnerstag um 20:54 | <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a>
    </div>
</div>
<div class="post border-bottom">
    <div class="post-logo">
        <span class="online"></span>
        <img src="i/post-image.png" />
        Online
    </div>
    <a href="#"><b>Lady Sonia</b></a>hat ein Video geteilt<br />
    <div class="post-left post-text">
        <img src="i/update-profiler.png">
    </div>

    <div class="post-date post-left">
        <div class="like like-active"><span>mir gefällt</span><span class="counter">12</span></div>
        Donnerstag um 20:54 | <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a>
    </div>

    <div class="comment-count post-left">Alle 6 Kommentare anzeigen</div>

    <div class="post sub-post border-bottom post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="post sub-post border-bottom post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="post sub-post border-bottom post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="post sub-post post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="insert-comment">
        <textarea name="text" class="radius">Schreib hier dein Kommentar</textarea>
    </div>
</div>

<div class="post border-bottom">
    <div class="post-logo">
        <span class="online"></span>
        <img src="i/post-image.png" />
        Online
    </div>
    <a href="#"><b>Lady Sonia</b></a>hat ein Video geteilt<br />
    <div class="post-left post-text">
        <a href="#"><img src="i/pho1.png" /></a>
        <a href="#"><img src="i/pho2.png" /></a>
        <a href="#"><img src="i/pho3.png" /></a>
    </div>

    <div class="post-date post-left">
        <div class="like like-active"><span>mir gefällt</span><span class="counter">12</span></div>
        Donnerstag um 20:54 | <a href="#" class="comment" onclick="show_comment_form(this); return false;">Kommentieren</a>
    </div>

    <div class="comment-count post-left">Alle 6 Kommentare anzeigen</div>

    <div class="post sub-post border-bottom post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="post sub-post border-bottom post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="post sub-post border-bottom post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="post sub-post post-text">
        <div class="post-logo">
            <span class="online"></span>
            <img src="i/post-image.png" />
            Online
        </div>
        <a href="#"><b>Lady Sonia</b></a><br />
        <div class="post-left">
            Tempost eaquis dolest officae conseque parum :::::/(())
        </div>

        <div class="post-date post-left">
            <div class="like"><span>mir gefällt</span><span class="counter">12</span></div>
            Donnerstag um 20:54
        </div>
    </div>
    <div class="insert-comment">
        <textarea name="text" class="radius">Schreib hier dein Kommentar</textarea>
    </div>
</div>

</div>
</div>

<div class="clear">
</div>

</div>