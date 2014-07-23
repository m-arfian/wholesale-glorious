<div class="cool-block">
    <div class="cool-block-bor">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                <?php echo CHtml::image(URL::Gambar(Gambar::URL_PELANGGAN) . $registered->gambar->GAMBAR_NAMA, '', array('class' => 'img-rounded img-responsive profilpic')) ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                <h6 class="text-center"><span class="font3"><?php echo $registered->pelanggan->NAMA ?></span></h6>
                <hr class="inner-separator">
                <div class="panel-group" id="user-menu">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <?php echo CHtml::link('<i class="fa fa-dashboard"></i> Menu utama', array('/pelanggan'), array('class' => 'parent')) ?>
                                <?php
                                echo CHtml::link('<i class="fa fa-caret-down"></i>', array('#utama'), array(
                                    'data-toggle' => 'collapse',
                                    'data-parent' => '#user-menu',
                                    'class' => 'pull-right'
                                ))
                                ?>
                            </h4>
                        </div>
                        <div id="utama" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="fa-ul">
                                    <li><i class="fa fa-li fa-power-off"></i><?php echo CHtml::link('Logout', array('default/logout')) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <?php echo CHtml::link('<i class="fa fa-truck"></i> Manajemen Order', array('order/'), array('class' => 'parent')) ?>
                                <?php
                                echo CHtml::link('<i class="fa fa-caret-down"></i>', array('#order'), array(
                                    'data-toggle' => 'collapse',
                                    'data-parent' => '#user-menu',
                                    'class' => 'pull-right'
                                ))
                                ?>
                            </h4>
                        </div>
                        <div id="order" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="fa-ul">
                                    <li><i class="fa fa-li fa-calendar"></i><?php echo CHtml::link('Order Periodik', '#') ?> <span class="label label-danger">Coming soon</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <?php echo CHtml::link('<i class="fa fa-user"></i> Manajemen Akun', array('profil/'), array('class' => 'parent')) ?>
                                <?php
                                echo CHtml::link('<i class="fa fa-caret-down"></i>', array('#akun'), array(
                                    'data-toggle' => 'collapse',
                                    'data-parent' => '#user-menu',
                                    'class' => 'pull-right'
                                ))
                                ?>
                            </h4>
                        </div>
                        <div id="akun" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="fa-ul">
                                    <li><i class="fa fa-li fa-edit"></i><?php echo CHtml::link('Edit profil', array('profil/editprofil')) ?></li>
                                    <li><i class="fa fa-li fa-lock"></i><?php echo CHtml::link('Ubah password', array('profil/editpass')) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <?php echo CHtml::link('<i class="fa fa-flag"></i> Manajemen Alamat', array('alamat/'), array('class' => 'parent')) ?>
                                <?php
                                echo CHtml::link('<i class="fa fa-caret-down"></i>', array('#alamat'), array(
                                    'data-toggle' => 'collapse',
                                    'data-parent' => '#user-menu',
                                    'class' => 'pull-right'
                                ))
                                ?>
                            </h4>
                        </div>
                        <div id="alamat" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="fa-ul">
                                    <li><i class="fa fa-li fa-plus"></i><?php echo CHtml::link('Tambah alamat', array('alamat/tambah')) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>