

<div class="inner-content">
    <div class="content">
        <div class="border-bottom">
            <a href="#">
            <table class="counter-table counter-table-inner" width="100%">
                <tr>
                    <td>
                        <span></span>Upload photo
                    </td>
                </tr>
            </table>
            </a>
        </div>

        <div class="photo_list">
            <p>
                <?=count($photos);?> photos in the album
            </p>
            <?php
            foreach((array)$photos as $value)
            {
                ?>
                <a href="#d<?=$value['id'];?>" class="fancy_feed_photo folder_id">
                    <img src="/photos/<?=$value['image_145'];?>" align="absmiddle" />
                </a>
                <div id="d<?=$value['id'];?>" style="display:none;">
                    <img class="photo_fancy" src="/photos/<?=$value['image_1024'];?>" align="absmiddle" />
                </div>
                <?
            }
            ?>
        </div>

    </div>
</div>