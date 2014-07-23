<?php
$this->pageTitle = "Profil pelanggan";
$this->breadcrumbs = array(
    'Pelanggan' => array('/pelanggan'),
    'Profil',
);
?>

<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2><i class="fa fa-user color"></i> Manajemen Akun & Profil <small></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<div class="pelanggan">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div>
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'data' => $pelanggan,
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-bordered table-view',
                        ),
                        'attributes' => array(
                            'NAMA',
                            'EMAIL',
                            'HP',
                            array(
                                'name' => 'KELAMIN',
                                'type' => 'Kelamin',
                                'value' => $pelanggan->KELAMIN,
                            ),
                            array(
                                'name' => 'ALAMAT',
                                'value' => $alamat->ALAMAT,
                            ),
                            array(
                                'name' => 'KODEPOS',
                                'value' => $alamat->KODEPOS,
                            ),
                            array(
                                'name' => 'KOTA',
                                'value' => Kota::KabOrKota($alamat->KOTA_ID),
                            ),
                            array(
                                'name' => 'PROVINSI',
                                'value' => $alamat->provinsi->PROVINSI_NAMA,
                            ),
                        ),
                    ));
                    ?>
                </div>
                <br>
                <div>
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'data' => $registered,
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-bordered table-view',
                        ),
                        'attributes' => array(
                            'USERNAME',
                            array(
                                'name' => 'MEMBER_SINCE',
                                'type' => 'Tanggal',
                                'value' => $registered->MEMBER_SINCE,
                            ),
                            array(
                                'name' => 'STATUS',
                                'type' => 'RegisteredStatus',
                                'value' => $registered->STATUS,
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?php $this->renderPartial('/layouts/_rightside', array('registered' => $registered)) ?>
            </div>
        </div>
        <hr class="colorgraph">
    </div>
</div>