<div class="inner-page">
    <form method="post" action="<?=CHtml::normalizeUrl(array('members/signup'));?>" class="global_form" enctype="application/x-www-form-urlencoded" id="user_form_login">

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

            <h3 class="inner-title">Personal Information</h3>
            <br />

            <div class="form-elements">

                <div class="form-wrapper" id="name-wrapper">
                    <div class="form-label" id="name-label">
                        <label class="required" for="name">Animal nickname</label>
                    </div>
                    <div class="form-element" id="name-element">
                        <input type="text" class="text radius" value="<?=$_POST['name'];?>" id="name" name="name" />
                    </div>
                </div>

                <div class="form-wrapper" id="sex-wrapper">
                    <div class="form-label" id="sex-label">
                        <label class="optional" for="sex">Gender</label>
                    </div>

                    <div class="form-element" id="sex-element">
                        <select class="field_container field_5 option_1 parent_1" id="sex" name="sex" style="margin-top: 10px;">
                            <option label="" value=""></option>
                            <option label="Male" value="2">Male</option>
                            <option label="Female" value="3">Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-wrapper" id="day-wrapper">
                    <div class="form-label" id="day-label">
                        <label class="optional" for="day">Birthday</label>
                    </div>

                    <div class="form-element" id="day-element">
                        <select class="field_container field_6 option_1 parent_1" id="day" name="day" style="margin-top: 10px;>
                        <?php
                        for($x=0;$x<=31;$x++)
                        {
                            $selected = '';
                            if($x==$_POST['day'])
                                $selected = 'selected="selected"';

                            print '<option '.$selected.' label="'.$x.'" value="'.$x.'">'.$x.'</option>';
                        }
                        ?>
                        </select>
                        &nbsp;
                        <select name="month" id="month" style="margin-top: 10px;>
                            <option value="0"></option>
                            <?php
                            for($x=1;$x<=12;$x++)
                            {
                                $selected = '';
                                if($x==$_POST['month'])
                                    $selected = 'selected="selected"';

                                $month = date('F',strtotime('01.'.$x.'.2013'));

                                print '<option '.$selected.' label="'.$month.'" value="'.$x.'">'.$month.'</option>';
                            }
                            ?>
                        </select>&nbsp;

                        <select class="field_container field_6 option_1 parent_1" id="year" name="year"" style="margin-top: 10px;>
                            <option label=" " value="0"> </option>
                            <?php
                            for($x=date('Y');$x>=1960;$x--)
                            {
                                $selected = '';
                                if($x==$_POST['year'])
                                    $selected = 'selected="selected"';

                                print '<option '.$selected.' label="'.$x.'" value="'.$x.'">'.$x.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <h3 class="inner-title">Contact Information</h3>

                <div class="form-wrapper" id="site-wrapper">
                    <div class="form-label" id="site-label">
                        <label class="optional" for="site">Website</label>
                    </div>

                    <div class="form-element" id="site-element">
                        <input type="text" class="text radius" value="<?=$_POST['site'];?>" id="site" name="site" />
                    </div>
                </div>

                <div class="form-wrapper" id="twitter-wrapper">
                    <div class="form-label" id="twitter-label">
                        <label class="optional" for="twitter">Twitter</label>
                    </div>

                    <div class="form-element" id="twitter-element">
                        <input type="text" class="text radius" value="<?=$_POST['twitter'];?>" id="twitter" name="twitter" />
                    </div>
                </div>

                <div class="form-wrapper" id="facebook-wrapper">
                    <div class="form-label" id="facebook-label">
                        <label class="optional" for="facebook">Facebook</label>
                    </div>

                    <div class="form-element" id="facebook-element">
                        <input type="text" class="text radius" value="<?=$_POST['facebook'];?>" id="facebook" name="facebook" />
                    </div>
                </div>

                <div class="form-wrapper" id="aim-wrapper">
                    <div class="form-label" id="aim-label">
                        <label class="optional" for="aim">AIM</label>
                    </div>

                    <div class="form-element" id="aim-element">
                        <input type="text" class="text radius" value="<?=$_POST['aim'];?>" id="aim" name="aim" />
                    </div>
                </div>

                <h3 class="inner-title">Personal Details</h3>

                <div class="form-wrapper" id="about-wrapper">
                    <div class="form-label" id="about-label">
                        <label class="optional" for="about">About Me</label>
                    </div>

                    <div class="form-element" id="about-element">
                        <textarea class="text radius" rows="6" cols="45" id="about" name="about"><?=$_POST['about'];?></textarea>
                    </div>
                </div>

                <div class="form-wrapper" id="submit-wrapper">
                    <div class="form-label" id="submit-label">&nbsp;</div>

                    <div class="form-element" id="submit-element">
                        <button type="submit" id="submit" name="submit">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>