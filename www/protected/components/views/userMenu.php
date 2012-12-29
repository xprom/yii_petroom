
    <?php echo CHtml::link('Создать новую запись',array('TblPost/create')); ?>
    <?php echo CHtml::link('Управление записями',array('TblPost/admin')); ?>
    <?php echo CHtml::link('Одобрение комментариев',array('TblComment/index'))
        . ' (' . TblComment::model()->pendingCommentCount . ')'; ?>
    <?php echo CHtml::link('Выход',array('site/logout')); ?>
