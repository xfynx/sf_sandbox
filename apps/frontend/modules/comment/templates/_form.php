<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php slot('title', 'Оставить комментарий') ?>
<form action="<?php echo url_for('comment/'.
    ($form->getObject()->isNew() ? 'create' : 'update').
    (!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>"
      method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
        <tr>
            <td colspan="2">
                <a class="btn btn-default" href="javascript:history.back()">Отмена</a>
                <?php if (!$form->getObject()->isNew()): ?>
                    <?php echo link_to('Delete', 'comment/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Вы уверены?')) ?>
                <?php endif; ?>
                <input class="btn btn-primary" type="submit" value="Сохранить" />
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php echo $form ?>
        </tbody>
    </table>
</form>
