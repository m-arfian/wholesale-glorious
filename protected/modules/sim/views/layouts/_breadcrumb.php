<?php
if (!empty($this->breadcrumbs)) {
    if (Yii::app()->controller->route !== 'site/index')
        $this->breadcrumbs = array_merge(array('<i class="fa fa-desktop"></i>' => array('/sim')), $this->breadcrumbs);

    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
        'homeLink' => false,
        'encodeLabel' => false,
        'tagName' => 'ul',
        'separator' => ' <i class="fa fa-chevron-right"></i> ',
        'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
        'inactiveLinkTemplate' => '<li>{label}</li>',
        'htmlOptions' => array('class' => 'breads pull-right')
    ));
}
?>