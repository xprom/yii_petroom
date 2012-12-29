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


    <script language="javascript" src="js/jquery-1.8.0.min.js"></script>
    <script language="javascript" src="js/jquery.func.js?v=2"></script>

    <!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAEzaqyohIf7CKIpbLMpYPRRSxySEUo0SD7BB5qr-gNI7PlVxRXxSxAv7dtpRGQlOqWidII22v8YU5Qw" type="text/javascript"></script>-->
</head>
<body>
    <div id="page_wrap" class="scroll_fix_wrap">

        <div id="head_line">
            <div class="l"></div>
            <div class="r"></div>

            <a href="/" class="logo"></a>

            <form method="POST" action="/login/">
                <input type="submit" class="submit" value="Einloggen" />

                <label>
                    Hier einloggen:
                    <input type="text" class="text radius" name="email" value="E-Mail-Adresse" />
                </label>

                <label class="pass_label">
                    <span>Passwort</span>
                    <input type="password" class="text radius" name="pass" value="" />
                </label>


            </form>


        </div>

        <?php echo $content; ?>

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
</body>
</html>


<?
exit();
?>


<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
        <?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>
	</div>

    <!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
