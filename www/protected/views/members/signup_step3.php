<div class="inner-page">



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

            <h3 class="inner-title">Add Your Photo</h3>

            <div class="form-elements photo-upload-form">
                Current Photo<br /><br />

                <form method="post" target="_self" action="<?=CHtml::normalizeUrl(array('members/signup'));?>" class="global_form" enctype="multipart/form-data" id="user_form_login2">
                    <div id="current-photo">
                        <img src="/i/nophoto_user_thumb_profile.png" />
                        <br />
                        <br />
                        <img src="/i/nophoto_user_thumb_icon.png" />
                    </div>
                </form>

                <br />

                <form method="post" target="photo_upload" action="<?=CHtml::normalizeUrl(array('members/signup'));?>" class="global_form" enctype="multipart/form-data" id="user_form_login">
                    <input type="hidden" name="upload_photo" value="1" />

                    Choose New Photo
                <input type="file" name="photo" />
                <input type="button" onclick="document.getElementById('user_form_login2').submit();" value="Save" /> or <a href="/">skip</a>
                </form>
                <br />
                <br />
                <br />

            </div>

            <script>
            $(document).ready(function(){
                $('input[type=file][name=photo]').change(function(){
                    document.getElementById('user_form_login').submit();
                });
            })
            </script>

        </div>

    <div class="hidden">
        <iframe name="photo_upload" width="1" height="1" id="photo_upload"></iframe>
    </div>
</div>