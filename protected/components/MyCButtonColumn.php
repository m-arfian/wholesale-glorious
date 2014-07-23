<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyCButtonColumn
 *
 * @author andy
 */
class MyCButtonColumn extends CButtonColumn {
    public $viewIcon;
    public $updateIcon;
    public $deleteIcon;
    //public $viewButtonOptions = array('class' => 'btn mini green');
    //public $deleteButtonOptions = array('class' => 'btn mini red');
    //public $updateButtonOptions = array('class' => 'btn mini purple');
    public $template = '{view} {update} {delete}';

    protected function initDefaultButtons() {
        if ($this->viewButtonLabel === null)
            $this->viewButtonLabel = Yii::t('zii', 'View');
        if ($this->updateButtonLabel === null)
            $this->updateButtonLabel = Yii::t('zii', 'Update');
        if ($this->deleteButtonLabel === null)
            $this->deleteButtonLabel = Yii::t('zii', 'Delete');
        if ($this->viewButtonImageUrl === null)
            $this->viewButtonImageUrl = $this->grid->baseScriptUrl . '/view.png';
        if ($this->updateButtonImageUrl === null)
            $this->updateButtonImageUrl = $this->grid->baseScriptUrl . '/update.png';
        if ($this->deleteButtonImageUrl === null)
            $this->deleteButtonImageUrl = $this->grid->baseScriptUrl . '/delete.png';
        if ($this->viewIcon === null)
            $this->viewIcon = '<button class="btn btn-xs btn-default"><i class="fa fa-search-plus" title="Detail"></i></button>';
        if ($this->updateIcon === null)
            $this->updateIcon = '<button class="btn btn-xs btn-success"><i class="fa fa-pencil" title="Ubah"></i></button>';
        if ($this->deleteIcon === null)
            $this->deleteIcon = '<button class="btn btn-xs btn-danger"><i class="fa fa-trash-o" title="Hapus"></i></button>';
        if ($this->deleteConfirmation === null)
            $this->deleteConfirmation = Yii::t('zii', 'Apakah Anda yakin untuk menghapus data ini?');

        foreach (array('view', 'update', 'delete') as $id) {
            $button = array(
                'label' => $this->{$id . 'ButtonLabel'},
                'url' => $this->{$id . 'ButtonUrl'},
                'imageUrl' => $this->{$id . 'ButtonImageUrl'},
                'icon'=> $this->{$id . 'Icon'},
                'options' => $this->{$id . 'ButtonOptions'},
            );
            if (isset($this->buttons[$id]))
                $this->buttons[$id] = array_merge($button, $this->buttons[$id]);
            else
                $this->buttons[$id] = $button;
        }

        if (!isset($this->buttons['delete']['click'])) {
            if (is_string($this->deleteConfirmation))
                $confirmation = "if(!confirm(" . CJavaScript::encode($this->deleteConfirmation) . ")) return false;";
            else
                $confirmation = '';

            if (Yii::app()->request->enableCsrfValidation) {
                $csrfTokenName = Yii::app()->request->csrfTokenName;
                $csrfToken = Yii::app()->request->csrfToken;
                $csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
            }
            else
                $csrf = '';

            if ($this->afterDelete === null)
                $this->afterDelete = 'function(){}';

            $this->buttons['delete']['click'] = <<<EOD
function() {
	$confirmation
	var th=this;
	var afterDelete=$this->afterDelete;
	$.fn.yiiGridView.update('{$this->grid->id}', {
		type:'POST',
		url:$(this).attr('href'),$csrf
		success:function(data) {
			$.fn.yiiGridView.update('{$this->grid->id}');
			afterDelete(th,true,data);
		},
		error:function(XHR) {
			return afterDelete(th,false,XHR);
		}
	});
	return false;
}
EOD;
        }
    }

    protected function renderButton($id, $button, $row, $data) {
        if (isset($button['visible']) && !$this->evaluateExpression($button['visible'], array('row' => $row, 'data' => $data)))
            return;
        $label = isset($button['label']) ? $button['label'] : $id;
        $url = isset($button['url']) ? $this->evaluateExpression($button['url'], array('data' => $data, 'row' => $row)) : '#';
        $options = isset($button['options']) ? $button['options'] : array();

        if (!isset($options['title']))
            $options['title'] = $label;
        if (isset($button['icon']) && is_string($button['icon']))
            echo CHtml::link($button['icon'], $url, $options);
        else
            echo CHtml::link($label, $url, $options);
    }

    //put your code here
}

?>
