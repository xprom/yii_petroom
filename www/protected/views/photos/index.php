

<div class="inner-content">
    <div class="content">
        <div class="border-bottom">
            <table class="counter-table counter-table-inner" width="100%">
                <tr>
                    <td>
                        <span></span>Upload photo
                    </td>
                </tr>
            </table>
        </div>

        <div class="photo_folder_list">
        <?php
        foreach($folder as $value)
        {
            ?>
            <a href="/photos/folder/<?=$value['id'];?>/" class="folder_id">
                <img src="<?=$value['image_thumb'];?>" />
                <span>
                <span>
                    <?php
                    if($value['title']==Photo::PHOTO_THUMB_FOLDER_TITLE)
                        $value['title'] = 'My profile photos';
                    ?>
                    <?=$value['title'];?>
                </span>
                </span>
            </a>
            <?
        }
        ?>
        </div>

    </div>
</div>

