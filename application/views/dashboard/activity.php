<style>

.card-text {

  font-size: 14px;

}

.card-rating {

    font-size: 14px;

    margin-bottom: -15px;

}

</style>



<div class="card mb-3" style="margin-top: 15px">

    <div class="card-header" >

        <b>PROFILE DEPARTMENT IT</b>

    </div>



    <div class="card-body">

        <div class ="row justify-content-center">



            <div class="col-2 text-center">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Darwhin.png" style="width:100%">

                    <div class="card-body">

                        <h10 class="card-title"><b>DARWHIN SINARTA</b></h10>

                        <p class="card-text">DIREKSI</p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Darwhin_Sinarta') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-2 text-center">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Hamsudi.png" style="width:100%">

                    <div class="card-body">

                        <h10 class="card-title"><b>HAMSUDI</b></h10>

                        <p class="card-text">HEAD IT</p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Hamsudi') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-2 text-center">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Indra.jpg" style="width:100%">

                    <div class="card-body">

                        <h10 class="card-title"><b>INDRA MAULANA</b></h10>

                        <p class="card-text">SUPERVISOR IT</p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Indra_Maulana') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



        </div>



        <div class ="row" style="margin-top: 30px">

            <div class="col-sm-2">

                <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Alan.png" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1464');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1464');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>ALAN GENTINA</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: 25px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Alan_Gentina') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-sm-2">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Bonar.jpg" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '663');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '663');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }

                            

                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>BONAR PURBA</b></h10>

                        <p class="card-text">IT INFRASTRUCTURE SPECIALIST</p>

                        <p class="card-rating" style="margin-top: -12px">Rating : <?php echo $rating?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Bonar_Purba') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-sm-2">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Elvia.jpg" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1470');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1470');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>ELVIA NUR ANGGRAINI</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: -15px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Elvia_Nur_Anggraini') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-sm-2">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Irvan.jpg" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1453');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1453');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>IRVAN MUHAMMAD SINDY</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: -15px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Irvan_Muhammad_Sindy') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-sm-2">

                <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Nanang.png" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1198');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1198');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star'></i> <i class='fa fa-star '></i> <i class='fa fa-star '></i> <i class='fas fa-star-half-alt'></i> <i class='fa fa-star text-muted'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>NANANG ANDRIANI</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: 25px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Nanang_Andriani') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-sm-2">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Reynaldi.png" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1037');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1037');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>REYNALDI</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: 25px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Reynaldi') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



        </div>  



        <div class ="row" style="margin-top: 15px">

            <div class="col-sm-2">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Rudy.jpg" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1019');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1019');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>RUDY NOVRIANTO</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: 25px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Rudy_Novrianto') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-sm-2">

                 <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Suluh.png" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1473');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1473');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>SULUH DAMAR GRAHITA</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: -15px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Suluh_Damar_Grahita') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



            <div class="col-sm-2">

                <div class="card text-center">

                    <img class="card-img-top" src="assets/img/Yosef.png" style="width:100%">

                    <div class="card-body">

                        <?php

                            $this->db->select("COUNT(*) AS rfm_done");

                            $this->db->where('assign_to', '1333');

                            $this->db->where('request_status', STT_DONE); 

                            $rfm_done = $this->db->get(TB_DETAIL)->row()->rfm_done;



                            $this->db->select("SUM(rates) AS totalrates");

                            $this->db->where('assign_to', '1333');

                            $totalrates = $this->db->get(TB_DETAIL)->row()->totalrates;



                            if ($totalrates == 0){

                                $rating = '5';         

                            } else {

                                if ($rfm_done != '0') {

                                    $rating = $totalrates / $rfm_done;

                                } else {

                                    $rating = '0';

                                }

                            }



                            if ($rating > '0' && $rating < '1' )

                            { 

                                $rating = "<i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '1') {

                                $rating = "<i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '1' && $rating < '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            }elseif($rating == '2') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '2' && $rating < '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '3') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif ($rating > '3' && $rating < '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '4') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } elseif($rating > '4' && $rating < '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fas fa-star-half-alt text-warning'></i>";

                            } elseif($rating == '5') {

                                $rating = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";

                            } else {

                                $rating = "-";

                            }

                        ?>

                        <h10 class="card-title"><b>YOSEP HERYANA</b></h10>

                        <p class="card-text">IT STAFF</p>

                        <p class="card-rating" style="margin-top: 25px">Rating : <?php echo $rating ?></p>

                    </div>

                    <div class="card-footer">

                        <a href="<?php echo base_url('Yosep_Heryana') ?>" class="btn btn-primary stretched-link">See Profile</a>

                    </div>

                </div>

            </div>



        </div>



    </div>

</div>



<div class="card mb-3" id="table" style="margin-top: 15px">

    <div class="card-header" >

        <b>DAILY ACTIVITY DEPARTMENT IT</b>

    </div>

    <div class="card-body">

        <table class="colapse-table res3"  width="100%" cellspacing="0">

            <thead>

                <tr>

                    <th style="text-align: center">#</th>

                    <th>HARI</th>

                    <th>TANGGAL</th>

					<th>WAKTU</th>

					<th>PROJECT</th>

					<th>TASK</th>

					<th>RFM</th>

                    <th>STATUS</th>

                    <th>KETERANGAN</th>

                    <th>PIC</th>

                </tr>

            </thead>

            <tbody>

                <?php 

                    $ITList = $this->db->get(TB_USER)->result();

                    $projectList = $this->db->get(TB_PROJECT)->result();

                    $taskList = $this->db->get(TB_TASK)->result();

                    $rfmList = $this->db->get(TB_DETAIL)->result();

                ?>



                <?php foreach($ITList as $r): ?>

                    

                    <?php 

                        $this->db->where('user_id', $r->user_id);

                        $this->db->where('date_activity', date('Y-m-d'));

                        $this->db->order_by('last_update DESC');

                        $specificDailyActivity = $this->db->get(TB_DAILY_ACTIVITY)->result();

                    ?>

                    

                    <?php if (count($specificDailyActivity) > 0) { ?>

                        <?php foreach($specificDailyActivity as $row): ?>

                            <?php if (array_search($row, $specificDailyActivity) == 0) {?>

                                <tr>

                                    <td style="text-align: center"><i data-toggle="collapse" data-target=<?php echo "#".$r->user_id?> style=" color: #28a745; background-color: #f4fbff" class="fa fa-plus-circle" aria-hidden="true"></i></td>

                                    <td>

                                        <?php

                                            $hari = date('l',strtotime($row->date_activity));

                                            switch($hari){

                                                case 'Sunday':

                                                    $hari = "Minggu";

                                                break;

                                        

                                                case 'Monday':			

                                                    $hari = "Senin";

                                                break;

                                        

                                                case 'Tuesday':

                                                    $hari = "Selasa";

                                                break;

                                        

                                                case 'Wednesday':

                                                    $hari = "Rabu";

                                                break;

                                        

                                                case 'Thursday':

                                                    $hari = "Kamis";

                                                break;

                                        

                                                case 'Friday':

                                                    $hari = "Jumat";

                                                break;

                                        

                                                case 'Saturday':

                                                    $hari = "Sabtu";

                                                break;

                                                

                                                default:

                                                    $hari= "Tidak di ketahui";		

                                                break;

                                            }

                                            echo $hari;

                                        ?>

                                    </td>

                                    <td><?php echo date("d-m-Y",strtotime( $row->date_activity)) ?></td>

                                    <td><?php echo date("H:i",strtotime( $row->last_update)) ?></td>

                                    <td>

                                        <?php 

                                            $tableDataProjectName = null;

                                            if (!empty($row->project_id))

                                            {

                                                foreach($projectList as $rowProject):

                                                    if ($row->project_id == $rowProject->id) {

                                                        $tableDataProjectName = $rowProject->project_name;

                                                        break;

                                                    }

                                                endforeach;

                                            }

                                            else {

                                                $tableDataProjectName = "-";

                                            }

                                            echo $tableDataProjectName;

                                        ?>

                                    </td>

                                    <td>

                                        <?php $tableTaskName = null;

                                            if (!empty($row->task_id))

                                            {

                                                foreach($taskList as $rowTask):

                                                    if ($row->task_id == $rowTask->id) {

                                                        $tableTaskName = $rowTask->task_name;

                                                        break;

                                                    }

                                                endforeach;

                                            }

                                            else {

                                                $tableTaskName = "-";

                                            }

                                            echo $tableTaskName;

                                        ?>

                                    </td>            

                                    <td>

                                        <?php $tableDataNoRFM = null;

                                            if (!empty($row->rfm_id))

                                            {

                                                foreach($rfmList as $rowRfm):

                                                    if ($row->rfm_id == $rowRfm->id) {

                                                        $tableDataNoRFM = $rowRfm->no_rfm;

                                                        break;

                                                    }

                                                endforeach;

                                            }

                                            else {

                                                $tableDataNoRFM = "-";

                                            }

                                            echo $tableDataNoRFM;

                                        ?>

                                    </td>

                                    <td><?php echo $row->status ?></td>

                                    <td><?php echo $row->keterangan ?></td>

                                    <td><?php echo $r->nama ?></td>

                                </tr>

                            <?php } ?>

                        <?php endforeach ?>

                        <tr id=<?php echo $r->user_id?> class="collapse">

                            <td colspan="10">

                                <p>

                                    <table style="width: 100%">

                                    <thead>

                                        <tr>

                                            <th>HARI</th>

                                            <th>TANGGAL</th>

                                            <th>WAKTU</th>

                                            <th>PROJECT</th>

                                            <th>TASK</th>

                                            <th>RFM</th>

                                            <th>STATUS</th>

                                            <th>KETERANGAN</th>

                                        </tr>

                                    </thead>

                                        <?php foreach($specificDailyActivity as $row): ?>

                                            <?php if (array_search($row, $specificDailyActivity) !== 0) {?>

                                                

                                                <tr>

                                                    <td>

                                                        <?php

                                                            $hari = date('l',strtotime($row->date_activity));

                                                            switch($hari){

                                                                case 'Sunday':

                                                                    $hari = "Minggu";

                                                                break;

                                                        

                                                                case 'Monday':			

                                                                    $hari = "Senin";

                                                                break;

                                                        

                                                                case 'Tuesday':

                                                                    $hari = "Selasa";

                                                                break;

                                                        

                                                                case 'Wednesday':

                                                                    $hari = "Rabu";

                                                                break;

                                                        

                                                                case 'Thursday':

                                                                    $hari = "Kamis";

                                                                break;

                                                        

                                                                case 'Friday':

                                                                    $hari = "Jumat";

                                                                break;

                                                        

                                                                case 'Saturday':

                                                                    $hari = "Sabtu";

                                                                break;

                                                                

                                                                default:

                                                                    $hari= "Tidak di ketahui";		

                                                                break;

                                                            }

                                                            echo $hari;

                                                        ?>

                                                    </td>

                                                    <td><?php echo date("d-m-Y",strtotime( $row->date_activity)) ?></td>

                                                    <td><?php echo date("H:i",strtotime( $row->last_update)) ?></td>

                                                    <td>

                                                        <?php 

                                                            $tableDataProjectName = null;

                                                            if (!empty($row->project_id))

                                                            {

                                                                foreach($projectList as $rowProject):

                                                                    if ($row->project_id == $rowProject->id) {

                                                                        $tableDataProjectName = $rowProject->project_name;

                                                                        break;

                                                                    }

                                                                endforeach;

                                                            }

                                                            else {

                                                                $tableDataProjectName = "-";

                                                            }

                                                            echo $tableDataProjectName;

                                                        ?>

                                                    </td>

                                                    <td>

                                                        <?php $tableTaskName = null;

                                                            if (!empty($row->task_id))

                                                            {

                                                                foreach($taskList as $rowTask):

                                                                    if ($row->task_id == $rowTask->id) {

                                                                        $tableTaskName = $rowTask->task_name;

                                                                        break;

                                                                    }

                                                                endforeach;

                                                            }

                                                            else {

                                                                $tableTaskName = "-";

                                                            }

                                                            echo $tableTaskName;

                                                        ?>

                                                    </td>

                                                    

                                                    <td>

                                                        <?php $tableDataNoRFM = null;

                                                            if (!empty($row->rfm_id))

                                                            {   

                                                                foreach($rfmList as $rowRfm):

                                                                    if ($row->rfm_id == $rowRfm->id) {

                                                                        $tableDataNoRFM = $rowRfm->no_rfm;

                                                                        break;

                                                                    }

                                                                endforeach;

                                                            }

                                                            else {

                                                                $tableDataNoRFM = "-";

                                                            }

                                                            echo $tableDataNoRFM;

                                                        ?>

                                                    </td>

                                                    <td><?php echo $row->status ?></td>

                                                    <td><?php echo $row->keterangan ?></td>

                                                </tr>

                                            <?php } ?>

                                        <?php endforeach ?>

                                    </table>

                                </p>

                            </td>

                        </tr>

                    <?php } ?>

                <?php endforeach ?>

            </tbody>        

        </table>

    </div>

</div>



<div class="card mb-3" id="table" style="margin-top: 15px">

    <div class="card-header" >

        <b>PROGRESS PROJECT</b>

    </div>

    <div class="card-body">

    <!-- table table-bordered table-hover -->

        <table class="colapse-table res3"  width="100%" cellspacing="0">

            <thead>

                <tr>

                    <th style="text-align: center">#</th>

                    <th>PROJECT</th>

                    <th>STATUS</th>

                    <th>PROGRESS</th>

                    <th>LAST UPDATE</th>

                </tr>

            </thead>



            <tbody>

                <?php foreach($filteredProjectList as $r): ?>

                    

                    <?php 

                        $this->db->where('project_id', $r->id);

                        $this->db->order_by('last_update DESC');

                        $specificTask = $this->db->get(TB_TASK)->result();



                        $this->db->where('project_id', $r->id);

                        $this->db->where('status', STT_DONE);

                        $this->db->order_by('last_update DESC');

                        $taskList_done = $this->db->get(TB_TASK)->result();



                        $progressValue = count($taskList_done)/count($specificTask) * 100;

                    ?>

                    

                    <tr>

                        <td style="text-align: center"><i data-toggle="collapse" data-target=<?php echo "#".$r->id?> style=" color: #28a745; background-color: #f4fbff" class="fa fa-plus-circle" aria-hidden="true"></i></td>

                        <td><?php echo $r->project_name?></td>

                        <td>

                            <?php

                                $progressStatus = null;

                                if (count($taskList_done) == count($specificTask)) {

                                    $progressStatus = STT_DONE;    

                                } else {

                                    $progressStatus = STT_ON_PROGRESS;

                                }

                                echo $progressStatus;

                            ?>

                        </td>

                            

                        <td>

                            <div class="progress">

                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $progressValue?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progressValue?>%">

                                    <?php echo (round($progressValue))?>%

                                </div>

                            </div>

                        </td>

                        <td><?php echo date("d-m-Y | H:i:s",strtotime( $r->last_update))?></td>

                    </tr>



                    <tr id=<?php echo $r->id?> class="collapse">                     

                        <td colspan="5">

                            <p>

                                <table style="width: 100%">

                                    <thead>

                                        <tr>

                                            <th>No. RFP</th>

                                            <th>NAMA TASK</th>

                                            <th>TARGET DATE</th>

                                            <th>STATUS</th>

                                            <th>LAST UPDATE</th>

                                            <th>PIC</th>

                                            <th>KETERANGAN</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php foreach($specificTask as $row): ?>

                                            <tr>

                                                <td>

                                                    <?php 

                                                        if (!empty($row->rfp_id)) {

                                                            $rfp_id = $row->rfp_id;

                                                            $thisRfp = $this->db->where('id', $rfp_id)->get(TB_RFP)->row();

                                                            $no_rfp = $thisRfp->no_rfp;

                                                            echo $no_rfp;

                                                        } else {

                                                            echo "-";

                                                        }

                                                        ?>

                                                </td>

                                                <td><?php echo $row->task_name?></td>

                                                <td><?php echo date("d-m-Y",strtotime( $row->target_date))?></td>

                                                <td><?php echo $row->status?></td>

                                                <td><?php echo date("d-m-Y | H:i:s",strtotime( $row->last_update))?></td>

                                                <td>

                                                    <?php 

                                                        $this->db->where('user_id', $row->assign_to);

                                                        echo $this->db->get(TB_USER)->row()->nama;

                                                    ?>

                                                </td>

                                                <td>

                                                    <?php 

                                                        if (date("d-m-Y",strtotime($row->last_update)) > date("d-m-Y",strtotime($row->target_date))) {

                                                            echo'Task telah melewati target date';

                                                        }

                                                    ?>

                                                </td>

                                            </tr>

                                        <?php endforeach ?>

                                    </tbody>

                                </table>

                            </p>

                        </td>

                    </tr>

                <?php endforeach ?>

            </tbody>



        </table>

    </div>

</div>



