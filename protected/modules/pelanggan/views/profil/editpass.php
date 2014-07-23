<?php
$this->pageTitle = "Edit Password";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Profil' => array('profil/'),
    'Edit Password',
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-user color"></i> Edit password <small></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="pelanggan">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="form">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'editpribadi-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true
                        ),
                        'htmlOptions' => array(
                            'class' => 'form-horizontal',
                        )
                    ))
                    ?>

                    <p class="note">Isian dengan tanda <span class="required">*</span> wajib diisi.</p>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?php echo $form->labelEx($registered, 'OLDPASS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->passwordField($registered, 'OLDPASS', array('class' => 'form-control')) ?>
                                    <?php echo $form->error($registered, 'OLDPASS') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?php echo $form->labelEx($registered, 'PASS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->passwordField($registered, 'PASS', array('class' => 'form-control')) ?>
                                    <?php echo $form->error($registered, 'PASS') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($registered, 'REPEATPASS', array('class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-5 control-label')) ?>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <?php echo $form->passwordField($registered, 'REPEATPASS', array('class' => 'form-control')) ?>
                                    <?php echo $form->error($registered, 'REPEATPASS') ?>
                                </div>
                            </div>
                        </div>
                    </div><hr>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
                            <?php echo CHtml::htmlButton('<i class="fa fa-check"></i> Simpan', array('class' => 'btn btn-block btn-primary', 'type' => 'submit')) ?>
                        </div>
                    </div>
                    <?php $this->endWidget() ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $this->renderPartial('/layouts/_rightside', array('registered' => $registered)) ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>