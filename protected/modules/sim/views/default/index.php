<?php
$this->pageTitle = "SIM Jayagrosir.net";
$this->breadcrumbs = array(
    'Dashboard'
);
?>

<div class="blue-block">
    
</div>

<div class="report-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Task widget starts -->
                <div class="widget task-widget jstasks">
                    <!-- Widget head -->
                    <div class="widget-head">
                        <h5 class="pull-left"><i class="fa fa-truck"></i> Order terbaru</h5>	
                        <div class="widget-head-btns pull-right">
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- Widget body -->
                    <div class="widget-body 300-scroll">
                        <ul>
                            <?php foreach ($orders as $order): ?>
                            <li class="task-important">
                                <small class="pull-right"><?php echo date('d-M-Y H:i:s', strtotime($order->ORDER_DATE)) ?></small>
                                <h6><?php echo CHtml::link(MyFormatter::formatOrderID($order->ORDER_ID), array("order/view/id/$order->ORDER_ID")) ?></h6><hr>
                                <small class="label label-danger">Tujuan: <?php echo $order->alamatkirim->kota->KOTA_NAMA.', '.$order->alamatkirim->provinsi->PROVINSI_NAMA ?></small>
                                <small class="label label-success">Via: <?php echo $order->ekspedisi->EKSPEDISI_NAMA ?></small><br/>
                                <small class="label label-primary">"<?php echo $order->ORDER_MSG ?>"</small>
                            </li>
                            <?php endforeach ?>
                        </ul>	  
                    </div>

                    <!-- Widget foot -->
                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::link('Lihat semua order', array('order'), array('class'=>'btn btn-info btn-xs')) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <!-- Task widget starts -->
                <div class="widget task-widget jstasks">
                    <!-- Widget head -->
                    <div class="widget-head">
                        <h5 class="pull-left"><i class="fa fa-exclamation-triangle"></i> Konfirmasi terbaru</h5>	
                        <div class="widget-head-btns pull-right">
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- Widget body -->
                    <div class="widget-body 300-scroll">
                        <ul>
                            <?php foreach ($konfirmasi as $konfirm): ?>
                            <li class="task-important">
                                <small class="pull-right"><?php echo date('d-M-Y H:i:s', strtotime($konfirm->KONFIRMASI_DATE)) ?></small>
                                <h6><?php echo $konfirm->INVOICE_ORDER ?></h6><hr>
                                <small class="label label-danger"><?php echo $konfirm->NAMA_PELANGGAN ?></small>
                                <small class="label label-success"><?php echo $konfirm->rekening->REKENING_BANK . '-' . $konfirm->rekening->REKENING_NO ?></small>
                                <small class="label label-primary"><?php echo MyFormatter::formatUang($konfirm->TOTAL) ?></small>
                            </li>
                            <?php endforeach ?>
                        </ul>	  
                    </div>

                    <!-- Widget foot -->
                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::link('Lihat semua konfirmasi', array('konfirmasi'), array('class'=>'btn btn-info btn-xs')) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <!-- Task widget starts -->
                <div class="widget task-widget jstasks">
                    <!-- Widget head -->
                    <div class="widget-head">
                        <h5 class="pull-left"><i class="fa fa-cubes"></i> Supplier terbaru</h5>	
                        <div class="widget-head-btns pull-right">
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- Widget body -->
                    <div class="widget-body 300-scroll">
                        <ul>
                            <?php foreach ($supplier as $supp): ?>
                            <li class="task-important">
                                <small class="pull-right"><?php echo date('d-M-Y H:i:s', strtotime($supp->SUPPLIER_TGL)) ?></small>
                                <h6><?php echo $supp->SUPPLIER_BIDANG ?></h6><hr>
                                <small class="label label-danger">Lokasi: <?php echo $supp->kota->KOTA_NAMA.', '.$supp->kota->provinsi->PROVINSI_NAMA ?></small>
                                <small class="label label-success"><?php echo $supp->SUPPLIER_NAMA ?></small>
                                <small class="label label-primary"><?php echo $supp->NAMA_PEMILIK ?></small>
                            </li>
                            <?php endforeach ?>
                        </ul>	  
                    </div>

                    <!-- Widget foot -->
                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::link('Lihat semua supplier', array('supplier'), array('class'=>'btn btn-info btn-xs')) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">						
                <div class="widget chat-widget">
                    <!-- Widget head -->
                    <div class="widget-head">
                        <h5 class="pull-left"><i class="fa fa-comments"></i> Testimoni terbaru</h5>
                        <div class="widget-head-btns pull-right">
                            <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Widget body -->
                    <div class="widget-body 300-scroll">
                        <ul class="list-unstyled">
                            <?php foreach ($testimoni as $testi): ?>
                            <li class="by-other">
                                <div class="avatar avatar-name pull-right">
                                    <p><?php echo $testi->TESTIMONI_NAMA ?></p>
                                </div>

                                <div class="chat-content">
                                    <!-- In the chat meta, first include "time" then "name" -->
                                    <div class="chat-meta">
                                        <?php echo date('d-M-Y H:i:s', strtotime($testi->TESTIMONI_DATE)) ?>
                                        <span class="pull-right"><?php echo CHtml::link(MyFormatter::formatOrderID($testi->ORDER_ID), array('/cek-pemesanan/kode/'.$testi->ORDER_ID)) ?></span>
                                    </div>
                                    <?php echo $testi->TESTIMONI ?>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <!-- Widget foot -->
                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::link('Lihat semua testimoni', array('testimoni'), array('class'=>'btn btn-info btn-xs')) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- Chat widget ends -->
            </div>
        </div>
    </div>
</div>

<div class="container">
    
</div>