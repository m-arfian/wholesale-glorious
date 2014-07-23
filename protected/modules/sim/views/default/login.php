<?php
$this->pageTitle = "Login";
$this->breadcrumbs = array(
    'SIM'=>array('index'),
    'Login'
);
?>

<div class="login-page">
    <div class="">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#login" data-toggle="tab">SIM Jayagrosir.net</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade active in" id="login">
                <div class="form">
                <!-- Login form -->
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'login-admin',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array(
                            'role' => 'form',
                        ),
                    ));
                    ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($loginform, 'username', array('class'=>'control-label')); ?>
                        <div>
                            <?php echo $form->textField($loginform, 'username', array('class'=>'form-control')); ?>
                            <?php echo $form->error($loginform, 'username'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($loginform, 'password', array('class'=>'control-label')); ?>
                        <div>
                            <?php echo $form->passwordField($loginform, 'password', array('class'=>'form-control')); ?>
                            <?php echo $form->error($loginform, 'password'); ?>
                        </div>
                    </div>

                    <div class="row rememberMe compactRadioGroup">
                        <?php echo $form->checkBox($loginform, 'rememberMe'); ?>
                        <?php echo $form->label($loginform, 'rememberMe'); ?>
                    </div>
                
                    <?php echo CHtml::submitButton('Masuk', array('class' => 'btn btn-lg btn-danger')) ?>
                    <?php echo CHtml::htmlButton('Reset', array('class' => 'btn btn-lg btn-black')) ?>
                    <div class="text-center">
                        
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>

    </div>
</div>	