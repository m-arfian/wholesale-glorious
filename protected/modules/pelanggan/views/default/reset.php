<?php
$this->pageTitle = "Lupa password";
$this->breadcrumbs = array(
    'Pelanggan'=>array('/pelanggan'),
    'Lupa password'
);
?>

<div class="blocky">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
                <div class="register-login">
                    <div class="frame-block">
                        <div class="form" id="forgot-form">
                            <h3 class="text-center">
                            	Lupa Password <p class="small text-danger">Password akan direset dan dikirimkan ke email Anda.</p>
                            </h3>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'forgot-password',
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                	'validateOnChange' => false,
                                	'validateOnSubmit' => true,
                                ),
                                'htmlOptions' => array(
                                    'role' => 'form',
                                    'class' => 'form-horizontal'
                                ),
                            )) ?>
                            
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php echo $form->textField($resetform, 'username', array('class' => 'form-control input-lg', 'placeholder' => 'Username')) ?>
                                </div>
                                <?php echo $form->error($resetform, 'username') ?>
                                
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <div class="checkbox">
                                            <label>
                                                <?php echo $form->checkBox($resetform, 'resetPass') ?>
                                                <?php echo $form->label($resetform, 'resetPass') ?>
                                            </label>
                                        </div>
                                        <?php echo $form->error($resetform, 'resetPass') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?php echo CHtml::submitButton('Kirim password', array('class' => 'btn btn-warning')) ?>
                                    </div>
                                </div>
                            <?php $this->endWidget() ?>
                            
                            <div class="pull-right">
	                        	<?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Kembali ke login', array('login')) ?>
	                        </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>