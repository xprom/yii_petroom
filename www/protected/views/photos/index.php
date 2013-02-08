

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
            <a href="" class="folder_id">
                <img src="<?=$value['img'];?>" />
                <span>
                    <?=$value['title'];?>
                </span>
            </a>
            <?
        }
        ?>
        </div>

    </div>
</div>

