<?php
    $tb_detail = TB_DETAIL;
    $Q = "SELECT DISTINCT MONTH(`request_date`) AS bulan FROM `rfm_new_detail` WHERE YEAR(`request_date`) BETWEEN '2019' AND YEAR(CURDATE()) ORDER BY MONTH(`request_date`) ASC";
    $query = $this->db->query($Q)->result();
    
    $Q = "SELECT DISTINCT YEAR(`request_date`) AS tahun 
            FROM $tb_detail";
    $queryyear = $this->db->query($Q)->result();
    
    $post_month = $this->input->post('month');
    $post_monthAwal = $this->input->post('monthAwal');
    $post_monthAkhir = $this->input->post('monthAkhir');
    $post_year = $this->input->post('year');

    if($post_month==1) {
        $bulan = "Januari";
    } elseif($post_month==2) {
        $bulan = "Februari";
    } elseif($post_month==3) {
        $bulan = "Maret";
    } elseif($post_month==4) {
        $bulan = "April";
    } elseif($post_month==5) {
        $bulan = "Mei";
    } elseif($post_month==6) {
        $bulan = "Juni";
    } elseif($post_month==7) {
        $bulan = "Juli";
    } elseif($post_month==8) {
        $bulan = "Agustus";
    } elseif($post_month==9) {
        $bulan = "September";
    } elseif($post_month==10) {
        $bulan = "Oktober";
    } elseif($post_month==11) {
        $bulan = "November";
    } elseif($post_month==12) {
        $bulan = "Desember";
    }

    if(empty($post_month)) {
        $text_bulan = "Bulan";
        $val_bulan = "";
    } else {
        $text_bulan = $bulan;
        $val_bulan = $post_month;
    }

    if(empty($post_year)) {
        $text_tahun = "Tahun";
        $val_tahun = date('Y');
    } else {
        $text_tahun = $post_year;
        $val_tahun = $post_year;
    }

    //CHART==================================
    echo "
        <div class='row mt-3'>
            <div class='col-md-12'>
                <form action=" . $_SERVER['PHP_SELF'] . " method='POST'>
                    <div class='row'>
                        <div class='col-md-3'>
                            <select name='monthAwal' id='monthAwal' class='form-control'>
                                <option value='$val_bulan'>$text_bulan</option>
    ";
                            foreach($query as $row):
                                if($row->bulan==01) {
                                    $bulan = "Januari";
                                } elseif($row->bulan==02) {
                                    $bulan = "Februari";
                                } elseif($row->bulan==03) {
                                    $bulan = "Maret";
                                } elseif($row->bulan==04) {
                                    $bulan = "April";
                                } elseif($row->bulan==05) {
                                    $bulan = "Mei";
                                } elseif($row->bulan==06) {
                                    $bulan = "Juni";
                                } elseif($row->bulan==07) {
                                    $bulan = "Juli";
                                } elseif($row->bulan=='08') {
                                    $bulan = "Agustus";
                                } elseif($row->bulan=='09') {
                                    $bulan = "September";
                                } elseif($row->bulan==10) {
                                    $bulan = "Oktober";
                                } elseif($row->bulan==11) {
                                    $bulan = "November";
                                } elseif($row->bulan==12) {
                                    $bulan = "Desember";
                                }
    echo "
                                <option value='$row->bulan'>$bulan</option>
    ";
                            endforeach;
    echo "
                            </select>
                        </div>
                        <div class='col-md-1'>
                            <h6 style = 'margin-top: 8px; margin-left: 30px'> s/d </h6>
                        </div>
                        <div class='col-md-3'>
                            <select name='monthAkhir' id='monthAkhir' class='form-control'>
                            </select>
                        </div>
                        <div class='col-md-3'>
                            <select name='year' id='year' class='form-control'>
                                <option value='$val_tahun'>$text_tahun</option>
                                ";
                            foreach($queryyear as $row):
    echo "
                                <option value='$row->tahun'>$row->tahun</option>
    ";
                            endforeach;
    echo "
                            </select>
                        </div>
                        <div class='col-md-2'>
                        <button name='btnSearch' type='submit' id='btnSearch' class='btn btn-primary btn-block' >CARI</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    ";
?>

<script>
    document.getElementById("monthAwal").addEventListener("change", function(){
        var e = document.getElementById("monthAwal");
        document.getElementById("monthAkhir").innerHTML = "";

        function getBulan(angka) {
            var monthText;
            switch (angka) {
                case 1:
                    monthText = 'Januari' 
                    break;
                case 2:
                    monthText = 'Februari' 
                    break;
                case 3:
                    monthText = 'Maret' 
                    break;
                case 4:
                    monthText = 'April' 
                    break;
                case 5:
                    monthText = 'Mei' 
                    break;
                case 6:
                    monthText = 'Juni' 
                    break;
                case 7:
                    monthText = 'Juli' 
                    break;
                case 8:
                    monthText = 'Agustus' 
                    break;
                case 9:
                    monthText = 'September' 
                    break;
                case 10:
                    monthText = 'Oktober' 
                    break;
                case 11:
                    monthText = 'November' 
                    break;
                case 12:
                    monthText = 'Desember' 
                    break;
            }
            return monthText;
        }

        for (var i= Number(e.options[e.selectedIndex].value); i<=12; i++) {
            if (i > 0) {
                document.getElementById("monthAkhir").innerHTML = document.getElementById("monthAkhir").innerHTML + `<option value='${i}'>${getBulan(i)}</option>`;
            }
        }
        
    });
</script>

<script src="<?php echo base_url('assets/js/chart/Chart.bundle.js') ?>"></script>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <b>PERSENTASE RFM BERDASARKAN KANTOR</b>
            </div>
            <div class="card-body">
                <canvas id="myChart5"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <b>PERSENTASE RFM BERDASARKAN AREA</b>
            </div>
            <div class="card-body">
                <canvas id="myChart6"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <b>PERSENTASE RFM BERDASARKAN DIVISI</b>
            </div>
            <div class="card-body">
                <canvas id="myChart7"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <b>PERSENTASE RFP BERDASARKAN DIVISI</b>
            </div>
            <div class="card-body">
                <canvas id="myChart8"></canvas>
            </div>
        </div>
    </div>
</div>

<script>

    <?php
        if(!empty($post_monthAwal && $post_monthAkhir)) {
            $this->db->where("MONTH(request_date) >=", $post_monthAwal);
            $this->db->where("MONTH(request_date) <=", $post_monthAkhir);
            $this->db->where("YEAR(request_date)", $val_tahun);
        }
        $rfmList = $this->db->join(TB_KODE_KANTOR, TB_KODE_KANTOR.".kode_kantor=".TB_DETAIL.".kode_kantor")->where('request_status !=', STT_ON_QUEUE)->where('request_status !=', STT_REJECT)->get(TB_DETAIL)->result();

        $this->db->select("COUNT(rfm_new_detail.kode_kantor) AS total_by_kk, view_app_kode_kantor.nama_kantor AS nama_kantor");
        $this->db->join(TB_KODE_KANTOR." as view_app_kode_kantor", "view_app_kode_kantor.kode_kantor = rfm_new_detail.kode_kantor");
        $this->db->where('request_status !=', STT_ON_QUEUE);
        $this->db->where('request_status !=', STT_REJECT);
        if(!empty($post_monthAwal && $post_monthAkhir)) {
            $this->db->where("MONTH(request_date) >=", $post_monthAwal);
            $this->db->where("MONTH(request_date) <=", $post_monthAkhir);
            $this->db->where("YEAR(request_date)", $val_tahun);
        }
        $this->db->group_by('rfm_new_detail.kode_kantor');
        $rfmGrouped = $this->db->get(TB_DETAIL)->result();
    ?>

    var ctx_ = document.getElementById("myChart5").getContext("2d");
    var data_ = {
        labels: [
            <?php 
                foreach($rfmGrouped as $r):
                    $data = array();
                    $data = $r->nama_kantor;
                    echo json_encode($data).",";
                endforeach;
            ?>
        ],
        datasets:
        [{
            data: [
                <?php
                    foreach($rfmGrouped as $r):
                        $data = array();
                        $data = $r->total_by_kk;
                        echo json_encode($data).",";
                    endforeach;
                ?>
            ],
            backgroundColor: [
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                "rgb(247, 201, 89)",
                "rgb(68, 124, 158)",
                "rgb(78, 245, 197)",
                "rgb(158, 143, 186)",
                "rgb(250, 187, 135)",
                "rgb(247, 227, 126)",
                "rgb(247, 197, 188)",
                "rgb(166, 88, 86)",
                "rgb(247, 205, 181)",
                "rgb(255, 203, 134)",
                "rgb(201, 197, 143)",
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                ],
                hoverBackgroundColor: 'rgb(187,185,190)',
                hoverBorderColor: 'rgb(0, 0, 0, 1)',
        }]
    };
    var myBarChartApplication = new Chart(ctx_, {
        type: 'pie',
        data: data_,
        options: {
            legend: {
                display: false
            },
            'onClick' : function (evt, item) {
                $('#table_kode_kantor').empty();
                
                var label = this.data.labels[item[0]["_index"]];
                var rfmList = <?php echo json_encode($rfmList); ?>;
                var userList = <?php echo json_encode($userList); ?>;

                rfmList.forEach( (rfm) => {
                    if (rfm.nama_kantor == label) {
                        var nama_requestor;
                        var jabatan_requestor;
                        var nama_pic = "-";
                        var date = new Date(rfm.request_date);
                        var formattedDate = `${String(date.getDate()).length == 1 ? "0"+date.getDate() : date.getDate()}-${String(date.getMonth()+1).length == 1 ? "0"+ (date.getMonth()+1) : date.getMonth()+1}-${date.getFullYear()}`;

                        userList.forEach( (user) => {
                            if (rfm.request_by == user.user_id) {
                                nama_requestor = user.nama;
                                jabatan_requestor = user.jabatan;
                            }

                            if (rfm.assign_to == user.user_id) {
                                nama_pic = user.nama;
                            }
                        })

                        $('#table_kode_kantor').append(`
                            <tr>
                                <td>
                                    ${nama_requestor}
                                </td>
                                <td>
                                    ${jabatan_requestor}
                                </td>
                                <td>
                                    ${rfm.no_rfm}
                                </td>
                                <td>
                                    ${formattedDate}
                                </td>
                                <td>
                                    ${rfm.request_status}
                                </td>
                                <td>
                                    ${rfm.result_status}
                                </td>
                                <td>
                                    ${nama_pic}
                                </td>
                            </tr>
                        `);

                    }
                })

                $('#modal-Chart5').modal('show');
            },
            responsive: true,
            title:{
                display:true,
                text:'RFM Chart'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                    var dataLabel = data.labels[tooltipItem.index];
                    var value = `: ${data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]} | ` + (data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] / <?php echo count($rfmList)?> * 100).toLocaleString()+'%';
                    if (Chart.helpers.isArray(dataLabel)) {
                        dataLabel = dataLabel.slice();
                        dataLabel[0] += value;
                    } else {
                        dataLabel += value;
                    }
                    return dataLabel;
                    }
                }
            }
        }
    });

</script>

<div class="modal fade" id="modal-Chart5" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-left: 180px">
        <div class="modal-content" style="width:1000px;">
            <div class="modal-header">
                <h3 class="modal-title">Detail RFM Berdasarkan Kantor</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table style="margin-left: auto; margin-right: auto">
                    <thead class ="table">
                        <tr>
                            <th>REQUEST BY</th>
                            <th>JABATAN</th>
                            <th>NO.RFM</th>
                            <th>DATE</th>
                            <th>REQUEST STATUS</th>
                            <th>RESULT STATUS</th>
                            <th>PIC</th>
                        </tr>
                    </thead>
                    
                    <tbody class ="table" id="table_kode_kantor">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    <?php   
        $this->db->select("COUNT(rfm_new_detail.kode_kantor) AS total_by_area, view_app_kode_kantor.kode_area AS kode_area");
        $this->db->join(TB_KODE_KANTOR." as view_app_kode_kantor", "view_app_kode_kantor.kode_kantor = rfm_new_detail.kode_kantor");
        $this->db->where('request_status !=', STT_ON_QUEUE);
        $this->db->where('request_status !=', STT_REJECT);
        if(!empty($post_monthAwal && $post_monthAkhir)) {
            $this->db->where("MONTH(request_date) >=", $post_monthAwal);
            $this->db->where("MONTH(request_date) <=", $post_monthAkhir);
            $this->db->where("YEAR(request_date)", $val_tahun);
        }
        $this->db->group_by('view_app_kode_kantor.kode_area');
        $rfmGrouped = $this->db->get(TB_DETAIL)->result();
    ?>

    var ctx_ = document.getElementById("myChart6").getContext("2d");
    var data_ = {
        labels: [
            <?php 
                foreach($rfmGrouped as $r):
                    $data = array();
                    $data = $r->kode_area;
                    echo json_encode($data).",";
                endforeach;
            ?>
        ],
        datasets:
        [{
            data: [
                <?php
                    foreach($rfmGrouped as $r):
                        $data = array();
                        $data = $r->total_by_area;
                        echo json_encode($data).",";
                    endforeach;
                ?>
            ],
            backgroundColor: [
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                "rgb(247, 201, 89)",
                "rgb(68, 124, 158)",
                "rgb(78, 245, 197)",
                "rgb(158, 143, 186)",
                "rgb(250, 187, 135)",
                "rgb(247, 227, 126)",
                "rgb(247, 197, 188)",
                "rgb(166, 88, 86)",
                "rgb(247, 205, 181)",
                "rgb(255, 203, 134)",
                "rgb(201, 197, 143)",
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                ],
                hoverBackgroundColor: 'rgb(187,185,190)',
                hoverBorderColor: 'rgb(0, 0, 0, 1)',
        }]
    };
    var myBarChartApplication = new Chart(ctx_, {
        type: 'pie',
        data: data_,
        options: {
            legend: {
                display: false
            },
            'onClick' : function (evt, item) {
                $('#table_kode_area').empty();
                
                var label = this.data.labels[item[0]["_index"]];
                var rfmList = <?php echo json_encode($rfmList); ?>;
                var userList = <?php echo json_encode($userList); ?>;

                rfmList.forEach( (rfm) => {
                    if (rfm.kode_area == label) {
                        var nama_requestor;
                        var jabatan_requestor;
                        var nama_pic = "-";
                        var date = new Date(rfm.request_date);
                        var formattedDate = `${String(date.getDate()).length == 1 ? "0"+date.getDate() : date.getDate()}-${String(date.getMonth()+1).length == 1 ? "0"+ (date.getMonth()+1) : date.getMonth()+1}-${date.getFullYear()}`;

                        userList.forEach( (user) => {
                            if (rfm.request_by == user.user_id) {
                                nama_requestor = user.nama;
                                jabatan_requestor = user.jabatan;
                            }

                            if (rfm.assign_to == user.user_id) {
                                nama_pic = user.nama;
                            }
                        })

                        $('#table_kode_area').append(`
                            <tr>
                                <td>
                                    ${nama_requestor}
                                </td>
                                <td>
                                    ${jabatan_requestor}
                                </td>
                                <td>
                                    ${rfm.no_rfm}
                                </td>
                                <td>
                                    ${formattedDate}
                                </td>
                                <td>
                                    ${rfm.request_status}
                                </td>
                                <td>
                                    ${rfm.result_status}
                                </td>
                                <td>
                                    ${nama_pic}
                                </td>
                            </tr>
                        `);

                    }
                })

                $('#modal-Chart6').modal('show');
            },
            responsive: true,
            title:{
                display:true,
                text:'RFM Chart'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                    var dataLabel = data.labels[tooltipItem.index];
                    var value = `: ${data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]} | ` + (data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] / <?php echo count($rfmList)?> * 100).toLocaleString()+'%';
                    if (Chart.helpers.isArray(dataLabel)) {
                        dataLabel = dataLabel.slice();
                        dataLabel[0] += value;
                    } else {
                        dataLabel += value;
                    }
                    return dataLabel;
                    }
                }
            }
        }
    });

</script>

<div class="modal fade" id="modal-Chart6" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-left: 180px">
        <div class="modal-content" style="width:1000px;">
            <div class="modal-header">
                <h3 class="modal-title">Detail RFM Berdasarkan Area</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table style="margin-left: auto; margin-right: auto">
                    <thead class ="table">
                        <tr>
                            <th>REQUEST BY</th>
                            <th>JABATAN</th>
                            <th>NO.RFM</th>
                            <th>DATE</th>
                            <th>REQUEST STATUS</th>
                            <th>RESULT STATUS</th>
                            <th>PIC</th>
                        </tr>
                    </thead>
                    
                    <tbody class ="table" id="table_kode_area">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    <?php 
        if(!empty($post_monthAwal && $post_monthAkhir)) {
            $this->db->where("MONTH(request_date) >=", $post_monthAwal);
            $this->db->where("MONTH(request_date) <=", $post_monthAkhir);
            $this->db->where("YEAR(request_date)", $val_tahun);
        }
        $rfmList = $this->db->join(TB_USER, TB_USER.".user_id=".TB_DETAIL.".request_by")->where('request_status !=', STT_ON_QUEUE)->where('request_status !=', STT_REJECT)->get(TB_DETAIL)->result();

        $this->db->select("COUNT(view_user.divisi_id) AS total_by_div, view_user.divisi_id AS divisi");
        $this->db->join('view_user', 'view_user.user_id = ticket_support.rfm_new_detail.request_by');
        $this->db->where('ticket_support.rfm_new_detail.request_status !=', STT_ON_QUEUE);
        $this->db->where('ticket_support.rfm_new_detail.request_status !=', STT_REJECT);
        if(!empty($post_monthAwal && $post_monthAkhir)) {
            $this->db->where("MONTH(ticket_support.rfm_new_detail.request_date) >=", $post_monthAwal);
            $this->db->where("MONTH(ticket_support.rfm_new_detail.request_date) <=", $post_monthAkhir);
            $this->db->where("YEAR(ticket_support.rfm_new_detail.request_date)", $val_tahun);
        }
        $this->db->group_by('view_user.divisi_id');
        $this->db->order_by('view_user.divisi_id', 'asc');
        $groupedByDivision = $this->db->get(TB_DETAIL)->result();
    ?>

    var ctx_ = document.getElementById("myChart7").getContext("2d");
    var data_ = {
        labels: [
            <?php 
                foreach($groupedByDivision as $r):
                    $data = array();
                    $data = $r->divisi;
                    echo json_encode($data).",";
                endforeach;
            ?>
        ],
        datasets:
        [{
            data: [
                <?php
                    foreach($groupedByDivision as $r):
                        $data = array();
                        
                        $data = $r->total_by_div;
                        echo json_encode($data).",";
                    endforeach;
                ?>
            ],
            backgroundColor: [
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                "rgb(247, 201, 89)",
                "rgb(68, 124, 158)",
                "rgb(78, 245, 197)",
                "rgb(158, 143, 186)",
                "rgb(250, 187, 135)",
                "rgb(247, 227, 126)",
                "rgb(247, 197, 188)",
                "rgb(166, 88, 86)",
                "rgb(247, 205, 181)",
                "rgb(255, 203, 134)",
                "rgb(201, 197, 143)",
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                ],
                hoverBackgroundColor: 'rgb(187,185,190)',
                hoverBorderColor: 'rgb(0, 0, 0, 1)',
        }]
    };
    var myBarChartApplication = new Chart(ctx_, {
        type: 'pie',
        data: data_,
        options: {
            legend: {
                display: false
            },
            'onClick' : function (evt, item) {
                $('#tablerfm_divisi').empty();
                
                var label = this.data.labels[item[0]["_index"]];
                var rfmList = <?php echo json_encode($rfmList); ?>;
                var userList = <?php echo json_encode($userList); ?>;

                rfmList.forEach( (rfm) => {
                    if (rfm.divisi_id == label) {
                        var nama_requestor;
                        var jabatan_requestor;
                        var nama_pic = "-";
                        var date = new Date(rfm.request_date);
                        var formattedDate = `${String(date.getDate()).length == 1 ? "0"+date.getDate() : date.getDate()}-${String(date.getMonth()+1).length == 1 ? "0"+ (date.getMonth()+1) : date.getMonth()+1}-${date.getFullYear()}`;

                        userList.forEach( (user) => {
                            if (rfm.request_by == user.user_id) {
                                nama_requestor = user.nama;
                                jabatan_requestor = user.jabatan;
                            }

                            if (rfm.assign_to == user.user_id) {
                                nama_pic = user.nama;
                            }
                        })

                        $('#tablerfm_divisi').append(`
                            <tr>
                                <td>
                                    ${nama_requestor}
                                </td>
                                <td>
                                    ${jabatan_requestor}
                                </td>
                                <td>
                                    ${rfm.no_rfm}
                                </td>
                                <td>
                                    ${formattedDate}
                                </td>
                                <td>
                                    ${rfm.request_status}
                                </td>
                                <td>
                                    ${rfm.result_status}
                                </td>
                                <td>
                                    ${nama_pic}
                                </td>
                            </tr>
                        `);

                    }
                })

                $('#modal-Chart7').modal('show');
            },
            responsive: true,
            title:{
                display:true,
                text:'RFM Chart'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                    var dataLabel = data.labels[tooltipItem.index];
                    var value = `: ${data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]} | ` + (data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] / <?php echo count($rfmList)?> * 100).toLocaleString()+'%';
                    if (Chart.helpers.isArray(dataLabel)) {
                        dataLabel = dataLabel.slice();
                        dataLabel[0] += value;
                    } else {
                        dataLabel += value;
                    }
                    return dataLabel;
                    }
                }
            }
        }
    });

</script>

<div class="modal fade" id="modal-Chart7" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-left: 180px">
        <div class="modal-content" style="width:1000px;">
            <div class="modal-header">
                <h3 class="modal-title">Detail RFM Berdasarkan Divisi</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table style="margin-left: auto; margin-right: auto">
                    <thead class ="table">
                        <tr>
                            <th>REQUEST BY</th>
                            <th>JABATAN</th>
                            <th>NO.RFM</th>
                            <th>DATE</th>
                            <th>REQUEST STATUS</th>
                            <th>RESULT STATUS</th>
                            <th>PIC</th>
                        </tr>
                    </thead>
                    
                    <tbody class ="table" id="tablerfm_divisi">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    <?php 
        if(!empty($post_monthAwal && $post_monthAkhir)) {
            $this->db->where("MONTH(request_date) >=", $post_monthAwal);
            $this->db->where("MONTH(request_date) <=", $post_monthAkhir);
            $this->db->where("YEAR(request_date)", $val_tahun);
        }
        $rfpList = $this->db->join(TB_USER, TB_USER.".user_id=".TB_RFP.".request_by")->where('request_status !=', STT_ON_QUEUE)->where('request_status !=', STT_REJECT)->get(TB_RFP)->result();

        $this->db->select("COUNT(view_user.divisi_id) AS total_by_div, view_user.divisi_id AS divisi");
        $this->db->join('view_user', 'view_user.user_id = ticket_support.rfp_new_detail.request_by');
        $this->db->where('ticket_support.rfp_new_detail.request_status !=', STT_ON_QUEUE);
        $this->db->where('ticket_support.rfp_new_detail.request_status !=', STT_REJECT);

        if(!empty($post_monthAwal && $post_monthAkhir)) {
            $this->db->where("MONTH(ticket_support.rfp_new_detail.request_date) >=", $post_monthAwal);
            $this->db->where("MONTH(ticket_support.rfp_new_detail.request_date) <=", $post_monthAkhir);
            $this->db->where("YEAR(ticket_support.rfp_new_detail.request_date)", $val_tahun);
        }
        $this->db->group_by('view_user.divisi_id');
        $this->db->order_by('view_user.divisi_id', 'asc');

        $groupedByDivision = $this->db->get(TB_RFP)->result();
    ?>

    var ctx_ = document.getElementById("myChart8").getContext("2d");
    var data_ = {
        labels: [
            <?php 
                foreach($groupedByDivision as $r):
                    $data = array();
                    $data = $r->divisi;
                    echo json_encode($data).",";
                endforeach;
            ?>
        ],
        datasets:
        [{
            data: [
                <?php
                    foreach($groupedByDivision as $r):
                        $data = array();
                        
                        $data = $r->total_by_div;
                        echo json_encode($data).",";
                    endforeach;
                ?>
            ],
            backgroundColor: [
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                "rgb(247, 201, 89)",
                "rgb(68, 124, 158)",
                "rgb(78, 245, 197)",
                "rgb(158, 143, 186)",
                "rgb(250, 187, 135)",
                "rgb(247, 227, 126)",
                "rgb(247, 197, 188)",
                "rgb(166, 88, 86)",
                "rgb(247, 205, 181)",
                "rgb(255, 203, 134)",
                "rgb(201, 197, 143)",
                "rgb(240, 185, 185)",
                "rgb(192, 209, 157)",
                "rgb(247, 217, 121)",
                "rgb(147, 230, 218)",
                "rgb(240, 203, 161)",
                "rgb(247, 183, 166)",
                "rgb(219, 162, 199)",
                "rgb(141, 207, 136)",
                "rgb(209, 118, 88)",
                "rgb(163, 163, 163)",
                ],
                hoverBackgroundColor: 'rgb(187,185,190)',
                hoverBorderColor: 'rgb(0, 0, 0, 1)',
        }]
    };
    var myBarChartApplication = new Chart(ctx_, {
        type: 'pie',
        data: data_,
        options: {
            legend: {
                display: false
            },
            'onClick' : function (evt, item) {
                $('#tablerfp_divisi').empty();
                
                var label = this.data.labels[item[0]["_index"]];
                var rfpList = <?php echo json_encode($rfpList); ?>;
                var userList = <?php echo json_encode($userList); ?>;

                rfpList.forEach( (rfp) => {
                    if (rfp.divisi_id == label) {
                        var nama_requestor;
                        var jabatan_requestor;
                        var nama_pic = "-";
                        var date = new Date(rfp.request_date);
                        var formattedDate = `${String(date.getDate()).length == 1 ? "0"+date.getDate() : date.getDate()}-${String(date.getMonth()+1).length == 1 ? "0"+ (date.getMonth()+1) : date.getMonth()+1}-${date.getFullYear()}`;

                        userList.forEach( (user) => {
                            if (rfp.request_by == user.user_id) {
                                nama_requestor = user.nama;
                                jabatan_requestor = user.jabatan;
                            }

                            if (rfp.assign_to == user.user_id) {
                                nama_pic = user.nama;
                            }
                        })


                        $('#tablerfp_divisi').append(`
                            <tr>
                                <td>
                                    ${nama_requestor}
                                </td>
                                <td>
                                    ${jabatan_requestor}
                                </td>
                                <td>
                                    ${rfp.no_rfp}
                                </td>
                                <td>
                                    ${formattedDate}
                                </td>
                                <td>
                                    ${rfp.request_status}
                                </td>
                                <td>
                                    ${rfp.result_status}
                                </td>
                                <td>
                                    ${nama_pic}
                                </td>
                            </tr>
                        `);

                    }
                })

                $('#modal-Chart8').modal('show');
            },
            responsive: true,
            title:{
                display:true,
                text:'RFP Chart'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                    var dataLabel = data.labels[tooltipItem.index];
                    var value = `: ${data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]} | ` + (data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] / <?php echo count($rfmList)?> * 100).toLocaleString()+'%';
                    if (Chart.helpers.isArray(dataLabel)) {
                        dataLabel = dataLabel.slice();
                        dataLabel[0] += value;
                    } else {
                        dataLabel += value;
                    }
                    return dataLabel;
                    }
                }
            }
        }
    });
</script>

<div class="modal fade" id="modal-Chart8" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-left: 180px">
        <div class="modal-content" style="width:1000px;">
            <div class="modal-header">
                <h3 class="modal-title">Detail RFP Berdasarkan Divisi</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table style="margin-left: auto; margin-right: auto">
                    <thead class ="table">
                        <tr>
                            <th>REQUEST BY</th>
                            <th>JABATAN</th>
                            <th>NO.RFP</th>
                            <th>DATE</th>
                            <th>REQUEST STATUS</th>
                            <th>RESULT STATUS</th>
                            <th>PIC</th>
                        </tr>
                    </thead>
                    
                    <tbody class ="table" id="tablerfp_divisi">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>