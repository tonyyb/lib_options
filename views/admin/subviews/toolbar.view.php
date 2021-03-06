<?php
if (empty($saveField) && !empty($fieldset)) {
    $saveField = $fieldset->field('save');
    if (!$saveField) $saveField = __('Save');
}
?>
<script type="text/javascript">
    require([
        'jquery-nos'
    ], function($) {
        $(function() {
            var $container = $('#<?= $uniqid ?>');
            $container.nosToolbar('create');
            $container.nosToolbar('add', <?= \Format::forge((string) \View::forge('form/layout_save', array(
                'save_field' => $saveField
            ), false))->to_json() ?>)
                .filter(':submit')
                .click(function() {
                    $container.find('form:visible').submit();
                });

            <?php foreach ($toolbar_actions as $action_key => $action) : ?>
                var action_<?= $action_key ?> = $.nosUIElement(<?= \Format::forge($action)->to_json() ?>, true);
                $container.nosToolbar('add', action_<?= $action_key ?>, true);
            action_<?= $action_key ?>.nosOnShow('show');
            <?php endforeach; ?>

            <?php
            $context_selector = (string)\View::forge('lib_options::admin/subviews/context_select', $view_params, false);
                if (!empty($context_selector)) : ?>
                var context_select = $.nosUIElement(<?= $context_selector ?>);
                $container.nosToolbar('add', context_select, true);
                context_select.nosOnShow('show');
            <?php endif; ?>

        });
    });
</script>