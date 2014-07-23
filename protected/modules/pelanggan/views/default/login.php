<?php
$this->pageTitle = "Login";
$this->breadcrumbs = array(
    'Pelanggan'=>array('/pelanggan'),
    'Login'
);
?>

<div class="blocky">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                <div class="register-login">
                    <div class="frame-block">
                        <div class="form" id="login-form">
                            <?php echo CHtml::image(Yii::app()->baseUrl.'/images/toko/favicon_s.png', '', array('height'=>35,'class'=>'pull-left')) ?>
                            <h3 class="text-center">Login Pelanggan</h3>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'login-pelanggan',
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                	'validateOnChange' => false,
                                ),
                                'htmlOptions' => array(
                                    'role' => 'form',
                                    'class' => 'form-horizontal'
                                ),
                            )) ?>
                            
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php echo $form->textField($loginform, 'username', array('class' => 'form-control input-lg', 'placeholder' => 'Username')) ?>
                                </div>
                                <?php echo $form->error($loginform, 'username') ?>
                                
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <?php echo $form->passwordField($loginform, 'password', array('class' => 'form-control input-lg', 'placeholder' => 'Password')) ?>
                                </div>
                                <?php echo $form->error($loginform, 'password') ?>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <div class="checkbox">
                                            <label>
                                                <?php echo $form->checkBox($loginform, 'rememberMe') ?>
                                                <?php echo $form->label($loginform, 'rememberMe') ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?php echo CHtml::submitButton('Masuk', array('class' => 'btn btn-primary')) ?>
                                    </div>
                                </div>
                            <?php $this->endWidget() ?>
                            
                            <div class="pull-right">
	                        	<?php echo CHtml::link('Lupa password?', array('lupapassword')) ?>
	                        </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>