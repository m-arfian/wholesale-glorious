<?php $models = Barang::ListRandom() ?>
<div class="recent-posts blocky">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section title -->
                <div class="section-title">
                    <h4><i class="fa fa-tags color"></i> &nbsp;<span class="freestyle">Ada sale loh!</span></h4>
                </div>    

                <div class="row">
                    <div class="col-md-12">
                        <div class="my_carousel">
                            <div class="carousel_nav pull-right">
                                <!-- Carousel navigation -->
                                <a class="prev" id="car_prev" href="#"><i class="fa fa-chevron-left"></i></a>
                                <a class="next" id="car_next" href="#"><i class="fa fa-chevron-right"></i></a>
                            </div>
                            <div id="carousel_container">
                                <?php foreach ($models as $mod): ?>
                                <div class="carousel_item">
                                    
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>