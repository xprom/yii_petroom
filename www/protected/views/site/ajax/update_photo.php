<?php
print '<input type="hidden" name="image"       value="'.$new_file_name.'" />';
print '<input type="hidden" name="image_thumb" value="'.$new_file_name_thumb.'" />';
print '<input type="hidden" name="image_50"    value="'.$new_file_name_50.'" />';
print '<input type="hidden" name="image_31"    value="'.$new_file_name_31.'" />';
print '

';
?>
<script>
$ = window.parent.$;

function uploadFinish(){
    $('.shadow-form-center-holder-main-photo .toglleHide').toggle();
    $('.shadow-form-center-holder-main-photo .slider').remove();
    $('.shadow-form-center-holder-main-photo iframe').hide();
    $('#shadow-form-center-holder-main-photo-slider').empty();

    <?
    list($width,$height) = getimagesize('./photos/'.$new_file_name_1024);
    $max_size = max($width,$height);
    /**
     * определяем максимальную пропорцию
     */
    $k = $max_size/534;
    $w = ceil($width/$k);
    $h = ceil($height/$k);

    $size = min($w,$h)-100;
    ?>

    var html = "<div class=\"photo-thumb-choose\"><img src=\"/photos/<?=$new_file_name_1024;?>\" />\
    <form method=\"post\" id=\"send_main_photo\">\
     <input type=\"hidden\" name=\"image_1024\" value=\"<?=$new_file_name_1024;?>\" />\
     <input type=\"hidden\" name=\"x1\" value=\"<?=ceil($w-$size)/2;?>\" />\
     <input type=\"hidden\" name=\"x2\" value=\"<?=($w - ceil($w-$size)/2);?>\" />\
     <input type=\"hidden\" name=\"y1\" value=\"<?=ceil($h-$size)/2;?>\" />\
     <input type=\"hidden\" name=\"y2\" value=\"<?=($h- ceil($h-$size)/2);?>\" />\
     <input type=\"submit\" class=\"hidden\" value=\"\" />\
        </form>\
    </div>";
    $('.shadow-form-center-holder-main-photo iframe').after(html);
    $('.shadow-form-center-holder-main-photo .photo-thumb-choose img').imgAreaSelect({
        handles: true,
        aspectRatio: "1:1",
        x1: <?=ceil($w-$size)/2;?>,
        y1: <?=ceil($h-$size)/2;?>,

        x2: <?=($w - ceil($w-$size)/2);?>,
        y2: <?=($h- ceil($h-$size)/2);?>,
        onSelectEnd: function (img, selection) {
            $('.photo-thumb-choose input[name=x1]').val(selection.x1);
            $('.photo-thumb-choose input[name=x2]').val(selection.x2);
            $('.photo-thumb-choose input[name=y1]').val(selection.y1);
            $('.photo-thumb-choose input[name=y2]').val(selection.y2);
        }
    });

    if(!$('.shadow-form-center-holder-main-photo .submit-button-back').hasClass('click-flag'))
    {
        $('.shadow-form-center-holder-main-photo .submit-button-back').addClass('click-flag');
        $('.shadow-form-center-holder-main-photo .submit-button-back, .shadow-form-center-holder-main-photo .close').click(function(){
            $('.shadow-form-center-holder-main-photo .photo-thumb-choose img').imgAreaSelect({remove:true});
            $('.shadow-form-center-holder-main-photo .photo-thumb-choose').remove();
            $('.shadow-form-center-holder-main-photo form input[type=reset]').click();
            $('.shadow-form-center-holder-main-photo form').show();
            $('.shadow-form-center-holder-main-photo .toglleHide').show();
            $('.shadow-form-center-holder-main-photo .toglleHide.hidden').hide();
            return false;
        });

        $('.shadow-form-center-holder-main-photo .submit-button-save').click(function(){
            $('#send_main_photo input[type=submit]').click();
            $('.shadow-form-center-holder-main-photo .close').click();
            return false;
        });

        $('.shadow, .inner-shadow .close').click(function(){
            if($('.shadow-form-center-holder-main-photo .photo-thumb-choose img').size()==1)
                $('.shadow-form-center-holder-main-photo .photo-thumb-choose img').imgAreaSelect({remove:true});
        })
    }

    return false;
}
uploadFinish();
</script>