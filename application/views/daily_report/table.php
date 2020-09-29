<div class="card mb-3" id="table">
	<div class="card-header">
		<button class="btn btn-success btn-sm" id="btn_create" data-toggle="modal" data-target="#modal-create-daily">
			<i class="far fa-comments"></i> Tulis Activity
		</button>
	</div>

	<div class="card-body">
		<div class="pesan"></div>
			<form class="mb-2" action="" method="post">
				<label>
					Cari berdasarkan bulan dan tahun
				</label>
				<div class="row">
					<div class="col-md-3">
						<select name="m" class="form-control">
							<?php
								$m = $this->input->post('m');
								$y = $this->input->post('y');

								if(empty($m && $y)) {
									$m = date('m');
									$y = date('Y');
								}

								function getMonth($month) {
									if($month=='01'):
										$mm = 'Januari';
									elseif($month=='02'):
										$mm = 'Februari';
									elseif($month=='03'):
										$mm = 'Maret';
									elseif($month=='04'):
										$mm = 'April';
									elseif($month=='05'):
										$mm = 'Mei';
									elseif($month=='06'):
										$mm = 'Juni';
									elseif($month=='07'):
										$mm = 'Juli';
									elseif($month=='08'):
										$mm = 'Agustus';
									elseif($month=='09'):
										$mm = 'September';
									elseif($month=='10'):
										$mm = 'Oktober';
									elseif($month=='11'):
										$mm = 'November';
									elseif($month=='12'):
										$mm = 'Desember';
									endif;

									return $mm;
								}

								$thisMonth = getMonth($m);

								if($m):
									echo "<option value='$m'>$thisMonth</option>";
								endif;
							?>

							<?php for ($x = 1; $x <= 12; $x++) { ?>
								<?php if ($x != $m) { ?>
									
									<?php $thisMonth = getMonth($x); ?>

									<option value=<?php echo $x ?>>
										<?php echo $thisMonth ?>
									</option>

								<?php } ?>
							<?php } ?>

						</select>
					</div>

					<div class="col-md-2">
						<select name="y" class="form-control">
							<?php
								if($y):
									echo "<option value='$y'>$y</option>";
								endif;
							?>
						</select>
					</div>

					<div class="col-md-1">
						<input type="submit" name="" value="Cari" class="btn btn-block btn-outline-secondary">
					</div>
				</div>
			</form>

			<table style ="margin-top: 15px !important" class="colapse-table res3" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th style="text-align: center">#</th>
						<th>HARI</th>
						<th>TANGGAL</th>
						<th>WAKTU</th>
						<th>PROJECT</th>
						<th>TASK</th>
						<th>No. RFM</th>
						<th>STATUS</th>
						<th>KETERANGAN</th>
						<th>PIC</th>
					</tr>
				</thead>

				<tbody>				
					<?php 
						$this->db->where("MONTH(date_activity)", $m);
						$this->db->where("YEAR(date_activity)", $y);
						$this->db->order_by('last_update DESC');
						$allDailyActivity = $this->db->get(TB_DAILY_ACTIVITY)->result();
					?>
					<?php foreach($ITList as $r): ?>

						<?php 
							$specificDailyActivity = array();
							foreach($allDailyActivity as $dailyActivity):
								if ($dailyActivity->user_id == $r->user_id) {
									array_push($specificDailyActivity, $dailyActivity);
								}
							endforeach
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
													foreach($projectList->result() as $rowProject):
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
													foreach($DataTaskList->result() as $rowTask):
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
													foreach($rfmList->result() as $rowRfm):
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
								<td colspan="11">
									<p>
										<table class="tb_detail_dr" style="width: 100%">
											<thead>
												<tr>
													<th>HARI</th>
													<th>TANGGAL</th>
													<th>WAKTU</th>
													<th>PROJECT</th>
													<th>TASK</th>
													<th>No. RFM</th>
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
																	// $projectList = $this->db->get(TB_PROJECT)->result();
																	$tableDataProjectName = null;
																	if (!empty($row->project_id))
																	{
																		foreach($projectList->result() as $rowProject):
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
																<?php 
																	$tableTaskName = null;
																	if (!empty($row->task_id))
																	{
																		
																		foreach($DataTaskList as $rowTask):
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
																		foreach($rfmList->result() as $rowRfm):
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

</div>

<div class="modal fade" id="modal-create-daily">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="view-create-daily"></div>
	</div>
</div>

