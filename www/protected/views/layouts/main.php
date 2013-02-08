<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6" lang="de"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7" lang="de"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8" lang="de"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="de"> <!--<![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=7, IE=9">
    <title></title>
    <meta name="robots" content="index, follow" />

    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
    <link rel="icon" href="/favicon.png" type="image/x-icon" />

    <link rel="stylesheet" href="s/style.css?v=1" media="screen" type="text/css" />
    <!--<link rel="stylesheet" href="/templates/s/jquery.fancybox-1.3.4.css" media="screen" type="text/css" />-->

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script>
    var config = {
        serverTimeStamp:<?=time();?>
    };
    </script>


    <script language="javascript" src="js/jquery-1.8.0.min.js"></script>
    <script language="javascript" src="js/jquery.imgareaselect.pack.js"></script>
    <script language="javascript" src="js/jquery.fancybox.js"></script>
    <script language="javascript" src="js/jquery.func.js?v=2"></script>

    <!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAEzaqyohIf7CKIpbLMpYPRRSxySEUo0SD7BB5qr-gNI7PlVxRXxSxAv7dtpRGQlOqWidII22v8YU5Qw" type="text/javascript"></script>-->
</head>
<body>
    <div id="page_wrap" class="scroll_fix_wrap">

        <div id="head_line">
            <div class="l"></div>
            <div class="r"></div>

            <a href="/" class="logo"></a>

            <?
            if(empty($_SESSION['MEMBERS']['ID']))
            {
                ?>
                <form method="POST" action="<?=CHtml::normalizeUrl(array('members/signin'));?>">
                    <input type="hidden" name="insert_flag" value="1" />
                    <input type="submit" tabindex="3" class="submit" value="Einloggen" />

                    <label>
                        Hier einloggen:
                        <input type="text" tabindex="1" class="text radius" name="email" value="E-Mail-Adresse" />
                    </label>

                    <label class="pass_label">
                        <span>Passwort</span>
                        <input type="password" tabindex="2" class="text radius" name="password" value="" />
                    </label>
                </form>
                <?
            }
            else
            {
                ?>
                <div class="nav">
                    <a href="/" class="nav1"></a>
                    <a href="#" class="nav2"></a>
                    <a href="<?=CHtml::normalizeUrl(array('inbox/index'));?>" class="nav3"></a>
                    <a href="#" class="nav4"></a>
                    <a href="<?=CHtml::normalizeUrl(array('presents/index'));?>" class="nav5"></a>
                    <a href="<?=CHtml::normalizeUrl(array('members/settings'));?>" class="nav6"></a>
                </div>

                <form method="GET">
                    <input type="text" name="s" class="search text radius" value="Suchen.." />
                    <input type="submit" class="hidden" />

                    <a href="/">
                        Mein Konto
                    </a>
                    |
                    <a href="<?=CHtml::normalizeUrl(array('members/logout'));?>">
                        Logout
                    </a>
                </form>
                <?
            }
            ?>


        </div>

        <?
        include __DIR__.'/left.php';
        ?>


        <?php echo $content; ?>


        <div class="clear"></div>
        </div>
    </div>

    <div id="footer">
        <table width="100%">
            <tr>
                <td width="25%">
                    <div><h2>Petroom ist social</h2></div>
                </td>
                <td width="25%">
                    <div><h2>&nbsp;</h2></div>
                </td>
                <td width="25%">
                    <div><h2>Direkt zu:</h2></div>
                </td>
                <td width="25%">
                    <div><h2>&nbsp;</h2></div>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <div><a href="#" class="social facebook"><span></span>Petroom auf Facebook</a></div>
                </td>
                <td class="border">
                    <div><a href="#" class="social flick"><span></span>Petroom bei Flickr</a></div>
                </td>
                <td class="border">
                    <div><a href="#">Über uns</a></div>
                </td>
                <td class="border">
                    <div><a href="#">AGB</a></div>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <div><a href="#" class="social twitter"><span></span>Petroom auf Twitter</a></div>
                </td>
                <td class="border">
                    <div><a href="#" class="social youtube"><span></span>Petroom-Channel auf YouTube</a></div>
                </td>
                <td class="border">
                    <div><a href="#">Werbung</a></div>
                </td>
                <td class="border">
                    <div><a href="#">Hilfe</a></div>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <div><a href="#" class="social google"><span></span>Petroom bei Google+</a></div>
                </td>
                <td class="border">
                    <div><a href="#" class="social vimeo"><span></span>Petroom-Channel bei Vimeo</a></div>
                </td>
                <td class="border">
                    <div><a href="#">Datenschutz</a></div>
                </td>
                <td class="border">
                    <div><a href="#">Petroom für Unternehmen</a></div>
                </td>
            </tr>
            <tr>
                <td class="border">
                    <div><a href="#" class="social rss"><span></span>Nachrichten abonnieren</a></div>
                </td>
                <td class="border">
                    <div><a href="#" class="social paypal"><span></span>Petroom akzeptiert PayPal</a></div>
                </td>
                <td class="border">
                    <div><a href="#">Impressum</a></div>
                </td>
                <td class="border">
                    <div><a href="#">Ihr Feedback</a></div>
                </td>
            </tr>
            <tr>
                <td class="border border-last">
                    <div><br /></div>
                </td>
                <td class="border border-last">
                    <div><br /></div>
                </td>
                <td class="border border-last">
                    <div><br /></div>
                </td>
                <td class="border border-last">
                    <div><br /></div>
                </td>
            </tr>
        </table>
        <p class="copy">Petroom © 2012 · Deutsch · Vitali Tcherednitchenko · Liebevoll in Zürich entwickelt</p>
    </div>

    <div class="shadow hidden"></div>
    <div class="change-current-status shadow-form">
        <div class="transparent-borders">
            <b class="cr t l png"></b>
            <b class="cr t r png"></b>
            <div class="sh-l">
                <div class="sh-r png">
                    <div class="inner-shadow">
                        <input type="text" maxlength="255" name="current-status" value="" /><br />
                        <input type="button" class="submin-button" value="Save" />

                    </div>
                </div>
            </div>
            <b class="cr b l png"></b>
            <b class="cr b r png"></b>
        </div>
    </div>


    <div class="shadow-form-center-holder shadow-form-center-holder-map shadow-form hidden">
        <div class="transparent-borders">
            <b class="cr t l png"></b>
            <b class="cr t r png"></b>
            <div class="sh-l">
                <div class="sh-r png">
                    <div class="inner-shadow">
                        <div class="title-shadow">
                            <a href="#" class="close">Close</a>
                            <h2>Attach a map</h2>
                            <br />

                            <input type="text" maxlength="255" name="search-street" style="margin-right: 15px" value="Search by city or street name.." />
                            <input type="button" class="submin-button" style="margin-right: 15px" value="Search" id="add_mark" />
                            <input type="button" class="submin-button" value="Attach map" id="save_mark" />
                        </div>
                        <div class="body-shadow">
                            <input type="hidden" name="mark" id="mark" value="" />
                            <input type="hidden" name="map" id="map1" value="" />
                            <input type="hidden" name="zoom" id="zoom" value="" />

                            <div id="gmap">
                                <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&language=de"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <b class="cr b l png"></b>
            <b class="cr b r png"></b>
        </div>
    </div>

    <div class="shadow-form-center-holder shadow-form-center-holder-link shadow-form hidden">
        <div class="transparent-borders">
            <b class="cr t l png"></b>
            <b class="cr t r png"></b>
            <div class="sh-l">
                <div class="sh-r png">
                    <div class="inner-shadow">
                        <div class="title-shadow">
                            <a href="#" class="close">Close</a>
                            <h2>Attach a link</h2>
                            <br />

                            <input type="text" maxlength="255" name="search-url" style="margin-right: 15px" value="Url.." />
                            <input type="button" class="submin-button" style="margin-right: 15px" value="Search" id="attach_link" />
                        </div>
                        <div class="body-shadow" id="parse-link">
                            Please enter the url...
                        </div>
                    </div>
                </div>
            </div>
            <b class="cr b l png"></b>
            <b class="cr b r png"></b>
        </div>
    </div>

    <div class="shadow-form-big-center-holder shadow-form hidden">
        <div class="transparent-borders">
            <b class="cr t l png"></b>
            <b class="cr t r png"></b>
            <div class="sh-l">
                <div class="sh-r png">
                    <div class="inner-shadow">
                        <div class="title-shadow">
                            <a href="#" class="close">Close</a>
                            <h2 class="title"></h2>
                            <br />
                        </div>
                        <div class="body-shadow">

                        </div>
                    </div>
                </div>
            </div>
            <b class="cr b l png"></b>
            <b class="cr b r png"></b>
        </div>
    </div>

    <div class="shadow-form-center-holder shadow-form-center-holder-main-photo shadow-form hidden">
        <div class="transparent-borders">
            <b class="cr t l png"></b>
            <b class="cr t r png"></b>
            <div class="sh-l">
                <div class="sh-r png">
                    <div class="inner-shadow">
                        <div class="title-shadow">
                            <a href="#" class="close">Close</a>
                            <h2>Upload a new photo</h2>
                            <br />
                        </div>
                        <div class="body-shadow">
                            <div class="toglleHide">
                            Please upload a real photo of yourself, so that friends can recognize you.
                            We support JPG, GIF or PNG files.<br /><br /><br />
                            </div>

                            <div class="toglleHide hidden">
                            Please select an area for your profile picture.
                            You can rotate the image to position it properly.<br /><br />
                            </div>

                            <form action="/?mainPhoto=1" method="post" target="shadow-form-center-holder-main-photo" enctype="multipart/form-data">
                                <input type="file" name="photo" value="" />
                                <input type="submit" class="hidden" />
                                <input type="reset" class="hidden" />
                            </form>
                            <iframe name="shadow-form-center-holder-main-photo" class="hidden" width="500" height="200"></iframe>
                            <div id="shadow-form-center-holder-main-photo-slider"></div>

                            <div class="toglleHide">
                            <br /><br />
                            If you have any problems with your upload, try using a smaller picture.
                            </div>

                            <div class="toglleHide hidden center">
                                <br />
                                <input type="button" class="submin-button submit-button-save" style="margin-right: 15px" value="Save and continue" />
                                <input type="button" class="submin-button submit-button-back" style="margin-right: 15px" value="Back" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <b class="cr b l png"></b>
            <b class="cr b r png"></b>
        </div>
    </div>



</body>
</html>
