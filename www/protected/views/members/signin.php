<div class="inner-page">
    <form method="post" autocomplete="off" action="<?=CHtml::normalizeUrl(array('members/signin'));?>" class="global_form" enctype="application/x-www-form-urlencoded" id="user_form_login">
        <input type="hidden" name="insert_flag" value="1" />

        <div>
            <?
            if(!empty($error))
            {
                ?>
                <ul class="form-errors">
                    <?
                    foreach($error as $value)
                    {
                        print '<li>'.$value.'</li>';
                    }
                    ?>
                </ul>
                <?
            }
            ?>

            <h3 class="inner-title">Member Sign In</h3>
            If you already have an account, please enter your details below. If you don't have one yet, please <?=CHtml::link('sign up',array('members/signup'));?> first.
            <br />
            <br />
            <br />

            <div class="form-elements">
                <div class="form-wrapper" id="email-wrapper">
                    <div class="form-label" id="email-label">
                        <label class="required" for="email">Email Address</label>
                    </div>

                    <div class="form-element" id="email-element">
                        <input type="text" class="text radius" tabindex="1" autofocus="autofocus" value="<?=$_POST['email'];?>" id="email" name="email">
                    </div>
                </div>

                <div class="form-wrapper" id="password-wrapper">
                    <div class="form-label" id="password-label">
                        <label class="required" for="password">Password</label>
                    </div>

                    <div class="form-element" id="password-element">
                        <input type="password" class="text radius" tabindex="2" value="<?=$_POST['password'];?>" id="password" name="password">
                    </div>
                </div>

                <div class="form-wrapper" id="submit-wrapper">
                    <div class="form-label" id="submit-label">&nbsp;</div>

                    <div class="form-element" id="submit-element">
                        <input type="submit" class="submin-button" tabindex="7" name="submit" value="Sign In" />
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>