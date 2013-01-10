<div class="inner-page">
<form method="post" autocomplete="off" action="<?=CHtml::normalizeUrl(array('members/signup'));?>" class="global_form" enctype="application/x-www-form-urlencoded" id="user_form_login">
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

        <h3 class="inner-title">Create Account</h3>
        <br />

        <div class="form-elements">
            <div class="form-wrapper" id="email-wrapper">
                <div class="form-label" id="email-label">
                    <label class="required" for="email">Email Address</label>
                </div>

                <div class="form-element" id="email-element">
                    <input type="text" class="text radius" tabindex="1" autofocus="autofocus" value="<?=$_POST['email'];?>" id="email" name="email">
                    <p class="description">You will use your email address to login.</p>
                </div>
            </div>


            <div class="form-wrapper" id="password-wrapper">
                <div class="form-label" id="password-label">
                    <label class="required" for="password">Password</label>
                </div>

                <div class="form-element" id="password-element">
                    <input type="password" class="text radius" tabindex="2" value="<?=$_POST['password'];?>" id="password" name="password">
                    <p class="description">Passwords must be at least 6 characters in length.</p>
                </div>
            </div>

            <div class="form-wrapper" id="passconf-wrapper">
                <div class="form-label" id="passconf-label">
                    <label class="required" for="passconf">Password Again</label>
                </div>
                <div class="form-element" id="passconf-element">
                    <input type="password" class="text radius" tabindex="3" value="<?=$_POST['passconf'];?>" id="passconf" name="passconf">
                    <p class="description">Enter your password again for confirmation.</p>
                </div>
            </div>

            <div class="form-wrapper" id="username-wrapper">
                <div class="form-label" id="username-label">
                    <label class="required" for="username">Profile Address</label>
                </div>

                <div class="form-element" id="username-element">
                    <input type="text" class="text radius" tabindex="4" value="<?=$_POST['username'];?>" id="username" name="username">
                    <p class="description">This will be the end of your profile link, for example:
                        <br>
                        <span id="profile_address">
                            http://www.localhost/profile/<span id="profile_address_text">yourname</span>
                        </span>
                    </p>
                </div>
            </div>

            <div class="form-wrapper" id="timezone-wrapper">
                <div class="form-label" style="margin-top: -10px;" id="timezone-label">
                    <label class="optional" for="timezone">Timezone</label>
                </div>

                <div class="form-element" id="timezone-element">
                    <select tabindex="5" id="timezone" name="timezone">
                        <option <?=$_POST['timezone']=='Pacific/Auckland'?'US/Pacific':'';?> label="(UTC-8) Pacific Time (US &amp; Canada)" value="US/Pacific">(UTC-8) Pacific Time (US &amp; Canada)</option>
                        <option <?=$_POST['timezone']=='US/Mountain'?'selected="selected"':'';?> label="(UTC-7) Mountain Time (US &amp; Canada)" value="US/Mountain">(UTC-7) Mountain Time (US &amp; Canada)</option>
                        <option <?=$_POST['timezone']=='US/Central'?'selected="selected"':'';?> label="(UTC-6) Central Time (US &amp; Canada)" value="US/Central">(UTC-6) Central Time (US &amp; Canada)</option>
                        <option <?=$_POST['timezone']=='US/Eastern'?'selected="selected"':'';?> label="(UTC-5) Eastern Time (US &amp; Canada)" value="US/Eastern">(UTC-5) Eastern Time (US &amp; Canada)</option>
                        <option <?=$_POST['timezone']=='America/Halifax'?'selected="selected"':'';?> label="(UTC-4)  Atlantic Time (Canada)" value="America/Halifax">(UTC-4)  Atlantic Time (Canada)</option>
                        <option <?=$_POST['timezone']=='America/Anchorage'?'selected="selected"':'';?> label="(UTC-9)  Alaska (US &amp; Canada)" value="America/Anchorage">(UTC-9)  Alaska (US &amp; Canada)</option>
                        <option <?=$_POST['timezone']=='Pacific/Honolulu'?'selected="selected"':'';?> label="(UTC-10) Hawaii (US)" value="Pacific/Honolulu">(UTC-10) Hawaii (US)</option>
                        <option <?=$_POST['timezone']=='Pacific/Samoa'?'selected="selected"':'';?> label="(UTC-11) Midway Island, Samoa" value="Pacific/Samoa">(UTC-11) Midway Island, Samoa</option>
                        <option <?=$_POST['timezone']=='Etc/GMT-12'?'selected="selected"':'';?> label="(UTC-12) Eniwetok, Kwajalein" value="Etc/GMT-12">(UTC-12) Eniwetok, Kwajalein</option>
                        <option <?=$_POST['timezone']=='Canada/Newfoundland'?'selected="selected"':'';?> label="(UTC-3:30) Canada/Newfoundland" value="Canada/Newfoundland">(UTC-3:30) Canada/Newfoundland</option>
                        <option <?=$_POST['timezone']=='America/Buenos_Aires'?'selected="selected"':'';?> label="(UTC-3) Brasilia, Buenos Aires, Georgetown" value="America/Buenos_Aires">(UTC-3) Brasilia, Buenos Aires, Georgetown</option>
                        <option <?=$_POST['timezone']=='Atlantic/South_Georgia'?'selected="selected"':'';?> label="(UTC-2) Mid-Atlantic" value="Atlantic/South_Georgia">(UTC-2) Mid-Atlantic</option>
                        <option <?=$_POST['timezone']=='Atlantic/Azores'?'selected="selected"':'';?> label="(UTC-1) Azores, Cape Verde Is." value="Atlantic/Azores">(UTC-1) Azores, Cape Verde Is.</option>
                        <option <?=$_POST['timezone']=='Europe/London'?'selected="selected"':'';?> label="Greenwich Mean Time (Lisbon, London)" value="Europe/London">Greenwich Mean Time (Lisbon, London)</option>
                        <option <?=$_POST['timezone']=='Europe/Berlin'?'selected="selected"':'';?> label="(UTC+1) Amsterdam, Berlin, Paris, Rome, Madrid" value="Europe/Berlin">(UTC+1) Amsterdam, Berlin, Paris, Rome, Madrid</option>
                        <option <?=$_POST['timezone']=='Europe/Athens'?'selected="selected"':'';?> label="(UTC+2) Athens, Helsinki, Istanbul, Cairo, E. Europe" value="Europe/Athens">(UTC+2) Athens, Helsinki, Istanbul, Cairo, E. Europe</option>
                        <option <?=$_POST['timezone']=='Europe/Moscow'?'selected="selected"':'';?> label="(UTC+3) Baghdad, Kuwait, Nairobi, Moscow" value="Europe/Moscow">(UTC+3) Baghdad, Kuwait, Nairobi, Moscow</option>
                        <option <?=$_POST['timezone']=='Iran'?'selected="selected"':'';?> label="(UTC+3:30) Tehran" value="Iran">(UTC+3:30) Tehran</option>
                        <option <?=$_POST['timezone']=='Asia/Dubai'?'selected="selected"':'';?> label="(UTC+4) Abu Dhabi, Kazan, Muscat" value="Asia/Dubai">(UTC+4) Abu Dhabi, Kazan, Muscat</option>
                        <option <?=$_POST['timezone']=='Asia/Kabul'?'selected="selected"':'';?> label="(UTC+4:30) Kabul" value="Asia/Kabul">(UTC+4:30) Kabul</option>
                        <option <?=$_POST['timezone']=='Asia/Yekaterinburg'?'selected="selected"':'';?> label="(UTC+5) Islamabad, Karachi, Tashkent" value="Asia/Yekaterinburg">(UTC+5) Islamabad, Karachi, Tashkent</option>
                        <option <?=$_POST['timezone']=='Asia/Dili'?'selected="selected"':'';?> label="(UTC+5:30) Bombay, Calcutta, New Delhi" value="Asia/Dili">(UTC+5:30) Bombay, Calcutta, New Delhi</option>
                        <option <?=$_POST['timezone']=='Asia/Katmandu'?'selected="selected"':'';?> label="(UTC+5:45) Nepal" value="Asia/Katmandu">(UTC+5:45) Nepal</option>
                        <option <?=$_POST['timezone']=='Asia/Omsk'?'selected="selected"':'';?> label="(UTC+6) Almaty, Dhaka" value="Asia/Omsk">(UTC+6) Almaty, Dhaka</option>
                        <option <?=$_POST['timezone']=='Indian/Cocos'?'selected="selected"':'';?> label="(UTC+6:30) Cocos Islands, Yangon" value="Indian/Cocos">(UTC+6:30) Cocos Islands, Yangon</option>
                        <option <?=$_POST['timezone']=='Asia/Krasnoyarsk'?'selected="selected"':'';?> label="(UTC+7) Bangkok, Jakarta, Hanoi" value="Asia/Krasnoyarsk">(UTC+7) Bangkok, Jakarta, Hanoi</option>
                        <option <?=$_POST['timezone']=='Asia/Hong_Kong'?'selected="selected"':'';?> label="(UTC+8) Beijing, Hong Kong, Singapore, Taipei" value="Asia/Hong_Kong">(UTC+8) Beijing, Hong Kong, Singapore, Taipei</option>
                        <option <?=$_POST['timezone']=='Asia/Tokyo'?'selected="selected"':'';?> label="(UTC+9) Tokyo, Osaka, Sapporto, Seoul, Yakutsk" value="Asia/Tokyo">(UTC+9) Tokyo, Osaka, Sapporto, Seoul, Yakutsk</option>
                        <option <?=$_POST['timezone']=='Australia/Adelaide'?'selected="selected"':'';?> label="(UTC+9:30) Adelaide, Darwin" value="Australia/Adelaide">(UTC+9:30) Adelaide, Darwin</option>
                        <option <?=$_POST['timezone']=='Australia/Sydney'?'selected="selected"':'';?> label="(UTC+10) Brisbane, Melbourne, Sydney, Guam" value="Australia/Sydney">(UTC+10) Brisbane, Melbourne, Sydney, Guam</option>
                        <option <?=$_POST['timezone']=='Asia/Magadan'?'selected="selected"':'';?> label="(UTC+11) Magadan, Solomon Is., New Caledonia" value="Asia/Magadan">(UTC+11) Magadan, Solomon Is., New Caledonia</option>
                        <option <?=$_POST['timezone']=='Pacific/Auckland'?'selected="selected"':'';?> label="(UTC+12) Fiji, Kamchatka, Marshall Is., Wellington" value="Pacific/Auckland">(UTC+12) Fiji, Kamchatka, Marshall Is., Wellington</option>
                    </select>
                </div>
            </div>

            <div class="form-wrapper" id="terms-wrapper">
                <div class="form-label" id="terms-label">&nbsp;</div>

                <div class="form-element" id="terms-element">
                    <input type="checkbox" <?=!empty($_POST['terms'])?'checked="checked"':'';?> tabindex="6" value="1" id="terms" name="terms" />
                    <label for="terms" class="null">
                        I have read and agree to the <?=CHtml::link('terms of service',array('help/terms'),array('target'=>'_blank'));?>
                     </label>
                </div>
            </div>

            <div class="form-wrapper" id="submit-wrapper">
                <div class="form-label" id="submit-label">&nbsp;</div>

                <div class="form-element" id="submit-element">
                    <button tabindex="7" type="submit" id="submit" name="submit">Continue</button>
                </div>
            </div>

            </div>

    </div>
</form>
</div>