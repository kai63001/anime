<?php
	
	require('condb.php');
	session_start();
	error_reporting(0);
	$anime_index = "SELECT * FROM anime ORDER BY a_date DESC";
	$res_anime_index = mysqli_query($condb,$anime_index);
	$page = mysqli_real_escape_string($condb,$_GET['page']);
	$a_username = mysqli_real_escape_string($condb,$_POST['a_username']);
	$a_password = mysqli_real_escape_string($condb,$_POST['a_password']);
	$login_admin = mysqli_real_escape_string($condb,$_POST['login_admin']);
	$a_name = mysqli_real_escape_string($condb,$_POST['a_name']);
	$uploadanime = mysqli_real_escape_string($condb,$_POST['uploadanime']);
	$detail = mysqli_real_escape_string($condb,$_GET['detail']);
	$a_detail = mysqli_real_escape_string($condb,$_POST['a_detail']);
	$a_fansub = mysqli_real_escape_string($condb,$_POST['a_fansub']);
	$a_tag = mysqli_real_escape_string($condb,$_POST['a_tag']);
	$a_lg = mysqli_real_escape_string($condb,$_POST['a_lg']);
	$video = mysqli_real_escape_string($condb,$_GET['video']);
	$name = mysqli_real_escape_string($condb,$_GET['name']);
	$ep = mysqli_real_escape_string($condb,$_GET['ep']);
	$v_name = mysqli_real_escape_string($condb,$_GET['v_name']);
	$a_f = mysqli_real_escape_string($condb,$_POST['a_f']);
	$addanime = mysqli_real_escape_string($condb,$_GET['addanime']);
	$v_ep = mysqli_real_escape_string($condb,$_POST['v_ep']);
	$v_iframe = mysqli_real_escape_string($condb,$_POST['v_iframe']);
	$v_iframe2 = mysqli_real_escape_string($condb,$_POST['v_iframe2']);
	$v_iframe3 = mysqli_real_escape_string($condb,$_POST['v_iframe3']);
	$addepanime = mysqli_real_escape_string($condb,$_POST['addepanime']);
	$v_name = mysqli_real_escape_string($condb,$_POST['v_name']);
	$backup = mysqli_real_escape_string($condb,$_GET['backup']);
	$r_id = mysqli_real_escape_string($condb,$_GET['r_id']);
	$errorfilereport = mysqli_real_escape_string($condb,$_GET['errorfilereport']);
	$detailupimg = mysqli_real_escape_string($condb,$_POST['detailupimg']);
	if ($uploadanime) {
		$img = pathinfo(basename($_FILES['a_img_upload']['name']),PATHINFO_EXTENSION);
		$new_name = 'kuro_'.uniqid().'.'.$img;
		$img_path = 'img/';
		$upload_img = move_uploaded_file($_FILES['a_img_upload']['tmp_name'], $img_path.$new_name);
		$upload_anime = "INSERT INTO anime(a_name,a_tag,a_detail,a_lg,a_f,a_fansub,a_img,a_date) VALUES ('$a_name','$a_tag','$a_detail','$a_lg','$a_f','$a_fansub','$new_name',now())";
		$res_upload_anime = mysqli_query($condb,$upload_anime);
		$_SESSION['addanime_success'] = 'success';
		?>
		<script type="text/javascript">window.location='?';</script>
		<?php
	}
	if ($login_admin) {
		$login = "SELECT * FROM admin WHERE a_username = '$a_username' AND a_password = '$a_password'";
		$res_login = mysqli_query($condb,$login);
		$num = mysqli_num_rows($res_login);
		if ($num == 1) {
			$row_login = mysqli_fetch_array($res_login);
			$_SESSION['a_id'] = $row_login['a_id'];
			$_SESSION['success_login'] = 'success_login';
			echo "<script>window.location='?';</script>";
	}else{
	echo "fail";
	}
	}

	if ($_SESSION['report_success']) {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<script type="text/javascript" src="js/jquery.js"></script>
			<link rel="stylesheet" href="css/sweetalert2.min.css">
			<script src="js/sweetalert2.all.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

			<title></title>

		</head>
		<body>
			<script type="text/javascript">swal(
			  'Reported!',
			  'แจ้งไฟล์เสียสำเร็จแล้ว!!',
			  'success'
			)</script>
		</body>
		</html>
		<?php
		unset($_SESSION['report_success']);
	}
	if ($_SESSION['report_error']) {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<script type="text/javascript" src="js/jquery.js"></script>
			<link rel="stylesheet" href="css/sweetalert2.min.css">
			<script src="js/sweetalert2.all.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

			<title></title>

		</head>
		<body>
			<script type="text/javascript">swal(
			  'Reported!',
			  'ไฟล์ได้ถูกแจ้งไปแล้ว กรุณารอสักครู่!!',
			  'error'
			)</script>
		</body>
		</html>
		<?php
		unset($_SESSION['report_error']);
	}
	

?>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);</style>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Kuro Anime - ดูฟรี ตลอดกาล</title>
		<meta name="keywords" content="การ์ตูน,อนิเมะ,Anime,ดูการ์ตูน,ดูอนิเมะ,ดูAnime,ดูการ์ตูนออนไลน์,อนิเมะพากย์ไทย,อนิเมะซับไทย">
		<meta name="description" content="Anime-Kuro | การ์ตูน อนิเมะ Anime ดูการ์ตูน ดูอนิเมะ ดูAnime ดูการ์ตูนออนไลน์ อนิเมะพากย์ไทย อนิเมะซับไทย">
		<script type="text/javascript" src="js/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="css/romeo.css">
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/hover.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/anime.css">
		<link rel="stylesheet" href="css/sweetalert2.min.css">

		<script src="js/sweetalert2.all.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
		<style type="text/css">
			html,body {
				background: url('img/maxresdefault.jpg');
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center;
				background-attachment: fixed;
				font-family: 'Kanit', sans-serif;
			}
		</style>
	</head>
	<body>
		<?php include('include/navbar.php'); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<?php
							
							if ($page == 'des') {
								# code...
							}elseif ($page == 'addanime') {
								if (!$_SESSION['a_id']) {
									header('location:?');
									exit();
						}else{ ?>
						<img src="img/69563e0b7628941.jpg" width="100%" alt="" style="margin-top: -5px;">
						<div class="box" style="border-radius: 2px;">
							<form method="POST" enctype="multipart/form-data">
								<h2>Add Anime</h2>
								Anime Name :
								<input type="text" class="form-control" required="" placeholder="ชื่อเรื่อง.." name='a_name'><br>
								จบยัง :
								<select name="a_f" id="" required="" class="form-control" style="width: 230px;">
									<option value="ยังไม่จบ">ยังไม่จบ</option>
									<option value="จบแล้ว">จบแล้ว</option>
								</select><br>
								Picture :
								<input type="file" required="" name='a_img_upload'>
								<br><br>ประเภท :
								<select name="a_lg" id="" required="" class="form-control" style="width: 230px;">
									<option value="1">ซับไทย</option>
									<option value="2">พากย์ไทย</option>
								</select>
								<br>แนว :
								<select name="a_tag" id="" required="" class="form-control" style="width: 230px;">
									<option value="1"> Action - ต่อสู้</option>
									<option value="2"> Adventure - ผจญภัย</option>
									<option value="3"> Card - การ์ด</option>
									<option value="4"> Comedy - ตลก</option>
									<option value="5"> Competition - แข่งขัน</option>
									<option value="6"> Demons - ปีศาจ</option>
									<option value="7"> Detective - นักสืบ</option>
									<option value="8"> Drama - ดราม่า</option>
									<option value="9"> Fantasy - แฟนตาซี</option>
									<option value="10"> Games - เกมส์</option>
									<option value="11"> Harem - ฮาเร็ม</option>
									<option value="12"> Hentai - เฮ็นไต</option>
									<option value="13"> Historical - ประวัติศาสตร์</option>
									<option value="14"> Horror - สยองขวัญ</option>
									<option value="15"> Magic - เวทมนต์</option>
									<option value="16"> Mecha - เครื่องจักร</option>
									<option value="17"> Music - ดนตรี</option>
									<option value="18"> Mystery - ลึกลับ</option>
									<option value="19"> Psychological - จิตวิทยา</option>
									<option value="20"> Romance - โรแมนติก</option>
									<option value="21"> School - โรงเรียน</option>
									<option value="22"> SCI-FI - ไซไฟ</option>
									<option value="23"> Slice of Life - เรื่องราวชีวิต</option>
									<option value="24"> Sport - กีฬา</option>
									<option value="25"> Thriller - ตื่นเต้น</option>
									<option value="26"> Other - อื่นๆ</option>
								</select>
								<br>
								แฟนซับ :
								<input type="text" name="a_fansub" class="form-control">
								<br>
								เรื่องย่อ :
								<textarea class="form-control" name="a_detail"></textarea>
								<br>
								<input type="submit" class="btn btn-info" value="เพิ่ม.. | Add Anime.." name='uploadanime'>
							</form>
						</div>
						<?php
						}
						}elseif ($page == 'adminfix') {
							$animefixdump = "SELECT * FROM anime WHERE a_name = '$name'";
							$res_animefixdump = mysqli_query($condb,$animefixdump);
							$row_animefixdump = mysqli_fetch_array($res_animefixdump);
							

							$videofix = "SELECT * FROM video WHERE v_name = '$name' and v_ep = '$ep'";
							$res_videofix = mysqli_query($condb,$videofix);
							$row_videofix = mysqli_fetch_array($res_videofix);
							$tags = $row_animefixdump['a_tag'];
							$tag_detail = "SELECT * FROM catalog WHERE c_id = '$tags'";
							$res_tag_detail = mysqli_query($condb,$tag_detail);
							$row_tag_detail = mysqli_fetch_array($res_tag_detail);

							if ($addepanime) {
								$fixedupdate = "UPDATE video SET v_ep = '$v_ep', v_iframe = '$v_iframe', v_iframe2 = '$v_iframe2', v_iframe3 = '$v_iframe3' WHERE v_name = '$name' and v_ep = '$ep'";
								$res_fixedupdate = mysqli_query($condb,$fixedupdate);
								$deletefixed = "DELETE FROM report WHERE r_id = '$r_id'";
								$res_deletefixed = mysqli_query($condb,$deletefixed);
								$_SESSION['deletefixed_success'] = 'successs';
								?>
									<script type="text/javascript">window.location='?page=adminpanel';</script>
									
								<?php
								exit();
							}

							?>
							<div class="boxblack"><h5><center>แก้ไข <?php echo $name ?> ตอนที่ <?php echo $ep ?></center></h5></div>
							<div class="boxblack">
								<div class="row">
									<div class="col-md-4">
										<img src="img/<?php echo $row_animefixdump['a_img']; ?>" width="100%">
									</div>
									<div class="col-md-8" style="padding: 0px;">
									<div class="merlin_widget" style="background: rgba(225,225,225,0);">
										<p><span style="font-weight: bold;"><i class="fa fa-microphone"></i> เสียงพากย์ : <a class="badge badge-primary" href=""><?php if ($row_animefixdump['a_lg'] == 1){
												echo "ซับไทย";
											}else{
												echo "พากย์ไทย";
										} ?></a></span></p>
										<p><span style="font-weight: bold;"><i class="fa fa-tags"></i> หมวดหมู่ :
											<a class="badge badge-success" href=""><?php echo $row_tag_detail['c_name']; ?></a>
										</span>
									</p>
									<p><span style="font-weight: bold;"><i class="fa fa-leaf"></i> แฟนซับ : <a class="badge badge-info" href="javascript:void(0);"><?php echo $row_animefixdump['a_fansub']; ?></a></span></p>
									<p>
										<span style="font-weight: bold;"><i class="fa fa-eye"></i> ยอดเข้าดู : <a class="badge badge-danger" href="javascript:void(0);"> <?php echo $row_animefixdump['a_view']; ?> ครั้ง</a>
									</span>
								</p>
							</div>
							<div class="merlin_widget" style="text-align: justify; background: rgba(225,225,225,0);"><h4 style="font-weight: bold;">เนื้อเรื่องย่อ</h4><?php echo $row_animefixdump['a_detail']; ?></div>
						</div>
								</div>	
							</div>
							<div class="boxblack">
								<form method="POST">
									ตอนที่ :
									<input type="text" name="v_ep" class="form-control" value="<?php echo $ep; ?>" required="">
									iframe : (แนะนำ <a href="https://www.fembed.com" target="_blank">fembed.com</a>)
									<textarea name="v_iframe" class="form-control" required=""><?php echo $row_videofix['v_iframe']; ?></textarea>
									iframe2 :
									<textarea name="v_iframe2" class="form-control" placeholder="ไม่มีก็ไม่ต้องลง"><?php echo $row_videofix['v_iframe2']; ?></textarea>
									iframe3 :
									<textarea name="v_iframe3" class="form-control" placeholder="ไม่มีก็ไม่ต้องลง"><?php echo $row_videofix['v_iframe3']; ?></textarea>
									<br>
									<input type="submit" name="addepanime" value="แก้ไง" class="btn btn-info">
								</form>
							</div>
							<?php
						}elseif ($page == 'adminpanel') {
						if (!$_SESSION['a_id']) {
							echo "<script>window.location='?';</script>";
								exit();
						}
						$errorfile = "SELECT * FROM report LIMIT 12";
						$res_errorfile = mysqli_query($condb,$errorfile);

						?>
						<div class="boxblack" style="margin-top: -5px;">
							<h5>ไฟล์เสีย</h5>
							<div class="row">
							<?php 

							while ($row_errorfile = mysqli_fetch_array($res_errorfile)) {
								$erroranimeimg = $row_errorfile['r_name'];
								$error1 = "SELECT * FROM anime WHERE a_name = '$erroranimeimg'";
								$res_error1 = mysqli_query($condb,$error1);
								$row_error1 = mysqli_fetch_array($res_error1);
								?>
									
										<div class="col-md-3">
											<a href="?page=adminfix&r_id=<?php echo $row_errorfile['r_id'] ?>&name=<?php echo $row_errorfile['r_name']; ?>&ep=<?php echo $row_errorfile['r_ep']; ?>" class="hvr-grow">
												<div class="card " style="color: black;border-radius: 0;border: 0px;">
													<img src="img/<?php echo $row_error1['a_img']; ?>" height="250">
													<span style="position: absolute;bottom: 0;color: white;background: rgba(0,0,0,0.75);"><?php echo $row_errorfile['r_name']; ?></span>
													<span style="position: absolute;color: white;bottom: 50px;right: 0px;background: #367EF6;padding: 5px 15px;">ตอนที่ <?php echo $row_errorfile['r_ep']; ?></span>
												</div>
											</a>
										</div>
									
								<?php
							}

							 ?>
							 </div><br><br>
							<a href="?page=adminsetting" class="btn btn-success">Setting</a> <a href="logout.php" class="btn btn-danger">Logout</a>
						</div>
						<?php
						}elseif ($page == 'adminsetting') {
							if (!$_SESSION['a_id']) {
								echo "<script>window.location='?';</script>";
								exit();
							}
							?>
							<div class="boxblack"></div>
							<?php
						}elseif ($page == 'admin') {
						?>
						<div class="box" style="margin-top: -5px;">
							<center><img src="img/twinbee_da___logo__japan__by_ringostarr39-d6t1q7r.png" alt="" width="350"></center>
							<form method="POST">
								Username :
								<input type="text" class="form-control" name='a_username' required="" placeholder="ชื่อผู้ใช้งาน">
								Password :
								<input type="password" class="form-control" name='a_password' required="" placeholder="รหัสเข้าสู่ระบบ">
								<br>
								<input type="submit" value="เข้าสู่ระบบ" class="btn btn-success" name="login_admin">
							</form>
							<hr>
							<p><i class="fas fa-paper-plane" style="font-size: 14px;"></i> Powered By KuroDev</p>
						</div>
						<?php
						}elseif ($detail) {
						$details = "SELECT * FROM anime WHERE a_id = '$detail'";
						$res_detail = mysqli_query($condb,$details);
						$row_detail = mysqli_fetch_array($res_detail);
						$tags = $row_detail['a_tag'];
						$tag_detail = "SELECT * FROM catalog WHERE c_id = '$tags'";
						$res_tag_detail = mysqli_query($condb,$tag_detail);
						$row_tag_detail = mysqli_fetch_array($res_tag_detail);
						$fview = $row_detail['a_view'];
						$view = $fview + 1;
						$upview = "UPDATE anime SET a_view = '$view' WHERE a_id = '$detail'";
						$res_upview = mysqli_query($condb,$upview);
						?>
						<?php if ($_SESSION['imgupdatesuccess']) {
							?>
								<!DOCTYPE html>
									<html>
									<head>
										<script type="text/javascript" src="js/jquery.js"></script>
										<link rel="stylesheet" href="css/sweetalert2.min.css">
										<script src="js/sweetalert2.all.min.js"></script>
										<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

										<title></title>

									</head>
									<body>
										<script type="text/javascript">swal(
										  'Update IMG Success!',
										  'เปลียนรูป สำเร็จแล้ว!!',
										  'success'
										)</script>
									</body>
									</html>
							<?php
							unset($_SESSION['imgupdatesuccess']);
						} ?>
						<div class="boxblack">
							<center><h5><?php echo $row_detail['a_name']; ?></h5></center>
						</div>
						<div class="boxblack" style="padding: 20px;">
							<div class="row">
								<div class="col-md-4 text-center widget_b" style="padding-left: 0px;">
									<div class="merlin_widget" style="background: rgba(225,225,225,0);">
										<img class="anime_img_b hvr-push" src="img/<?php echo $row_detail['a_img']; ?>">
										<?php if ($_SESSION['a_id']) {
											if ($detailupimg) {
												$godetailimgupdate = pathinfo(basename($_FILES['a_img']['name']), PATHINFO_EXTENSION);
												$newnameimgupdate = 'kuro_'.uniqid().'.'.$godetailimgupdate;
												$detailpath = 'img/';
												$resmove = move_uploaded_file($_FILES['a_img']['tmp_name'], $detailpath.$newnameimgupdate);

												$gogoupdate = "UPDATE anime SET a_img = '$newnameimgupdate' WHERE a_id = '$detail'";
												$res_gogoupdate = mysqli_query($condb,$gogoupdate);
												$_SESSION['imgupdatesuccess'] = 'success';
												?>
													<meta http-equiv="refresh" content="0">
												<?php
												exit();

											}
											?>

											<form method="POST" enctype="multipart/form-data">
												<input type="file" name="a_img" required="" style="background: #3D4EF2;width: 100.5%;">
												<input type="submit" name="detailupimg" class="btn btn-success" value="Update Img" style="width: 100.5%;border-radius: 0;">
											</form>
											<?php
										} ?>
									</div>
								</div>
								<div class="col-md-8" style="padding: 0px;">
									<div class="merlin_widget" style="background: rgba(225,225,225,0);">
										<p><span style="font-weight: bold;"><i class="fa fa-microphone"></i> เสียงพากย์ : <a class="badge badge-primary" href=""><?php if ($row_detail['a_lg'] == 1){
												echo "ซับไทย";
											}else{
												echo "พากย์ไทย";
										} ?></a></span></p>
										<p><span style="font-weight: bold;"><i class="fa fa-tags"></i> หมวดหมู่ :
											<a class="badge badge-success" href=""><?php echo $row_tag_detail['c_name']; ?></a>
										</span>
									</p>
									<p><span style="font-weight: bold;"><i class="fa fa-leaf"></i> แฟนซับ : <a class="badge badge-info" href="javascript:void(0);"><?php echo $row_detail['a_fansub']; ?></a></span></p>
									<p>
										<span style="font-weight: bold;"><i class="fa fa-eye"></i> ยอดเข้าดู : <a class="badge badge-danger" href="javascript:void(0);"> <?php echo $row_detail['a_view']; ?> ครั้ง</a>
									</span>
								</p>
							</div>
							<div class="merlin_widget" style="text-align: justify; background: rgba(225,225,225,0);"><h4 style="font-weight: bold;">เนื้อเรื่องย่อ</h4><?php echo $row_detail['a_detail']; ?><a href="" style="text-decoration: none;color: red;">edit</a></div>

						</div>
					</div>
				</div>
				<div class="boxblack">
					<?php
						$video_list = "SELECT * FROM video WHERE v_animeid ='$detail'";
						$res_video_list = mysqli_query($condb,$video_list);
						while ($row_video_list = mysqli_fetch_array($res_video_list)) {
					?>
					<a href="?video=<?php echo $row_video_list['v_name']; ?>&name=<?php echo $detail ?>&ep=<?php echo $row_video_list['v_ep']; ?>" style="text-decoration: none;">
						<div class="ep_anime hvr-bounce-to-right">
							<i class="fa fa-film"></i> <?php echo $row_video_list['v_name']; ?> ตอนที่ <?php echo $row_video_list['v_ep']; ?>
						</div>
					</a>
					<?php
					}
					?>
					<?php if ($_SESSION['a_id']) {
					?>
					<a href="?addanime=<?php echo $detail; ?>" style="text-decoration: none;">
						<div class="ep_anime hvr-bounce-to-left" style="background: #3CE32B;">
							<i class="fas fa-plus-square"></i> เพิ่มตอนใหม่
						</div>
					</a>
					<?php
					} ?>
					
				</div>
				<div class="boxblack">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.2&appId=153313228407799&autoLogAppEvents=1';
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="row">
						<div class="fb-comments" data-href="https://www.youtube.com/<?php echo $detail; ?>" data-width="100%" data-numposts="5"></div>
					</div>
				</div>
				<?php
				}elseif ($addanime) {
				if (!$_SESSION['a_id']) {
					header('location:?');
					exit();
				}
				$add_anime = "SELECT * FROM anime WHERE a_id = '$addanime'";
				$res_add_anime = mysqli_query($condb,$add_anime);
				$row_add_anime = mysqli_fetch_array($res_add_anime);
				$name_anime = $row_add_anime['a_name'];
				$ep_anime = "SELECT * FROM video WHERE v_name = '$name_anime'";
				$res_ep_anime = mysqli_query($condb,$ep_anime);
				$num_ep_anime = mysqli_num_rows($res_ep_anime);
				$row_ep_anime = mysqli_fetch_array($res_ep_anime);
				$ep = $num_ep_anime + 1;
				if ($addepanime) {
					$epadd = "INSERT INTO video(v_name,v_ep,v_iframe,v_iframe2,v_iframe3,v_animeid) VALUES ('$v_name','$v_ep','$v_iframe','$v_iframe2','$v_iframe3','$addanime')";
					$res_epadd = mysqli_query($condb,$epadd);
				}
				?>
				<div class="boxblack">
					<center><h5><?php echo $row_add_anime['a_name']; ?></h5></center>
				</div>
				<div class="boxblack">
					<form method="POST">
						Anime Name :
						<input type="text" name="v_name" class="form-control" value="<?php echo $row_add_anime['a_name']; ?>" required="" >
						ตอนที่ :
						<input type="text" name="v_ep" class="form-control" value="<?php echo $ep; ?>" required="">
						iframe : (แนะนำ <a href="https://www.fembed.com" target="_blank">fembed.com</a>)
						<textarea name="v_iframe" class="form-control" required=""></textarea>
						iframe2 :
						<textarea name="v_iframe2" class="form-control" placeholder="ไม่มีก็ไม่ต้องลง"></textarea>
						iframe3 :
						<textarea name="v_iframe3" class="form-control" placeholder="ไม่มีก็ไม่ต้องลง"></textarea>
						<br>
						<input type="submit" name="addepanime" value="เพิ่มตอนใหม่" class="btn btn-info">
					</form>
				</div>
				<?php
				}elseif ($video) {
				$videodetail = "SELECT * FROM video WHERE v_name = '$video' and v_ep = '$ep'";
				$res_videodetail = mysqli_query($condb,$videodetail);
				$row_videodetail = mysqli_fetch_array($res_videodetail);
				$num_video = mysqli_num_rows($res_videodetail);
				$videoanime = "SELECT * FROM video WHERE v_animeid = '$name'";
				$res_videoanime = mysqli_query($condb,$videoanime);
				$nextep = $ep + 1;
				?>
				<div style="width: 100%;">
					<?php if ($num_video == 0) {
					?>
					<img style="width: 100%" src="https://merlin-anime.com/assets/img/wait_next_ep.png">
					<?php
					}else {
					if ($backup == '1') {
						echo $row_videodetail['v_iframe2'];
					}elseif($backup == '2'){
						echo $row_videodetail['v_iframe3'];
					}else{
						echo $row_videodetail['v_iframe'];
					}
					?>
					
					<?php
						}
					?>
				</div>
				<div class="boxblack" style="margin-top: 10px;">
					<i class="fa fa-film"></i> <?php echo $row_videodetail['v_name']; ?> ตอนที่ <?php echo $row_videodetail['v_ep']; ?>
				</div>
				<div class="boxblack">
					<?php
						$rome = $row_videodetail['v_name'];
						$goto_detail = "SELECT * FROM anime WHERE a_name = '$rome'";
						$res_goto_detail = mysqli_query($condb,$goto_detail);
						$row_goto_detail = mysqli_fetch_array($res_goto_detail);
					?>
					<a href="?detail=<?php echo $row_goto_detail['a_id']; ?>" class="btn hvr-bounce-to-bottom" style="width: 100%;border-radius: 0;background:#EF4242;color: white;border:0px;">ดู <?php echo $row_goto_detail['a_name']; ?> ตอนทั้งหมด</a>
				</div>
				<div class="boxblack">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.2&appId=153313228407799&autoLogAppEvents=1';
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="row">
						<div class="fb-comments" data-href="https://www.youtube.com/<?php echo $row_goto_detail['a_name']; ?>&<?php echo $row_videodetail['v_ep']; ?>" data-width="100%" data-numposts="5"></div>
					</div>
				</div>
				<?php
					
				}else{
					if ($_SESSION['success_login']) {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<script type="text/javascript" src="js/jquery.js"></script>
			<link rel="stylesheet" href="css/sweetalert2.min.css">
			<script src="js/sweetalert2.all.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

			<title></title>

		</head>
		<body>
			<script type="text/javascript">swal(
			  'Login Success!',
			  'เข้าสู่ระบบ สำเร็จแล้ว!!',
			  'success'
			)</script>
		</body>
		</html>
		<?php
		unset($_SESSION['success_login']);
	}
					if ($_SESSION['addanime_success']) {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<script type="text/javascript" src="js/jquery.js"></script>
			<link rel="stylesheet" href="css/sweetalert2.min.css">
			<script src="js/sweetalert2.all.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

			<title></title>

		</head>
		<body>
			<script type="text/javascript">swal(
			  'AddAnimeSuccess!',
			  'เพิ่ม Anime สำเร็จแล้ว!!',
			  'success'
			)</script>
		</body>
		</html>
		<?php
		unset($_SESSION['addanime_success']);
	}

					if ($_SESSION['a_id']) {
				?>
				<div class="col-xs-6 col-sm-4 col-md-3 anime_grid hvr-grow">
					<div class="anime_grid_x">
						<a href="?page=adminpanel">
							<div class="anime_img" style="background: url(img/neo_tokyo_ii_by_anthonypresley_dcnog2k-pre.jpg) center center; background-size: cover;"></div>
							<span style="position: absolute;top: 0;margin-left: 14%;margin-top: 55%;background: rgba(0,0,0);color: white;padding: 10px 25px;">Admin Panel</span>
						</a>
						
					</div>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-3 anime_grid hvr-grow">
					<div class="anime_grid_x">
						<a href="?page=addanime">
							<div class="anime_img" style="background: url(img/animeadd.jpg) center center; background-size: cover;"></div>
							<span style="position: absolute;top: 0;margin-left: 10%;margin-top: 55%;background: #5d3ee8;color: white;padding: 10px 25px;"><i class="fas fa-plus-circle"></i> Add Anime</span>
						</a>
						
					</div>
				</div>
				<?php
				}
				while ($row_anime_index = mysqli_fetch_array($res_anime_index)) {
					$anime_index_name = $row_anime_index['a_name'];
					$index_name = "SELECT * FROM video WHERE v_name = '$anime_index_name'";
					$res_index_name = mysqli_query($condb,$index_name);
					$num_index_name = mysqli_num_rows($res_index_name);
				?>
				<div class="col-xs-6 col-sm-4 col-md-3 anime_grid hvr-grow">
					<div class="anime_grid_x">
						<a href="?detail=<?php echo $row_anime_index['a_id'];?>">
							<div class="anime_img" style="background: url(img/<?php echo $row_anime_index['a_img'];?>); background-size: cover;background-repeat: no-repeat;"></div>
							<div class="anime_title"><?php echo $row_anime_index['a_name'];?> ตอนที่ 1-<?php echo $num_index_name;?></div>
						</a>
						<span class="anime_view"><i class="fa fa-microphone"></i> <?php if ($row_anime_index['a_lg'] == 1){
							echo "ซับไทย";
							}else{
							echo "พากย์ไทย";
						} ?></span>
						<span class="anime_view2"><i class="fas fa-list-alt"></i> <?php echo $row_anime_index['a_f'];?></span>
						<span class="anime_view3"><i class="fas fa-video"></i> ตอนที่ 1-<?php echo $num_index_name;?></span>
					</div>
				</div>
				<?php
				}
				}
				
				?>
				
			</div>
			
		</div>
		<div class="col-md-3" style="margin-top: -5px;">
			<?php if ($video) {
			?>
			<div class="boxblack" style="margin-top: 0;">
				<div>
					<h4 class="text-center" style="font-weight: bold;">เครื่องเล่นสำรอง</h4>
					<?php
						$backupep = "SELECT * FROM video WHERE v_ep = '$ep'";
						$res_backupep = mysqli_query($condb,$backupep);
						$row_backupep = mysqli_fetch_array($res_backupep);
						if ($row_backupep['v_iframe2'] != '') {
					?>
					<a href="?video=<?php echo $row_videodetail['v_name']; ?>&name=<?php echo $detail ?>&ep=<?php echo $row_videodetail['v_ep']; ?>&backup=1" class="btn hvr-icon-bounce" style="width: 100%; margin-bottom: 5px;background: #F2552C;color:white;"><i class="fas fa-film hvr-icon"></i> สำรอง1</a>
					<?php
					}
					if ($row_backupep['v_iframe3'] != '') {
					?>
					<a href="?video=<?php echo $row_videodetail['v_name']; ?>&name=<?php echo $detail ?>&ep=<?php echo $row_videodetail['v_ep']; ?>&backup=2" class="btn hvr-icon-bounce" style="width: 100%; margin-bottom: 5px;background: #00539C;color:white;"><i class="fas fa-film hvr-icon"></i> สำรอง2</a>
					<?php
					}
					?>
					
				</div>
				<div>
					<?php 

						if ($errorfilereport) {
							$v_name = $row_videodetail['v_name'];
							$checkfile = "SELECT * FROM report WHERE r_name = '$v_name' and r_ep = '$ep'";
							$res_check = mysqli_query($condb,$checkfile);
							$num_checkfile = mysqli_num_rows($res_check);
							if ($num_checkfile == 1) {
								$_SESSION['report_error'] = 'error';
								?>
								<script type="text/javascript">window.location='?video=<?php echo $row_videodetail['v_name']; ?>&name=<?php echo $name ?>&ep=<?php echo $ep; ?>';</script>
								<?php
							}else{
								$upfileerror = "INSERT INTO report(r_name,r_ep) VALUES ('$v_name','$ep')";
								$res_upfileerror = mysqli_query($condb,$upfileerror);
								$_SESSION['report_success'] = 'success';
								?>
								<script type="text/javascript">window.location='?video=<?php echo $row_videodetail['v_name']; ?>&name=<?php echo $name ?>&ep=<?php echo $ep; ?>';</script>
								<?php
							}
						}
					 ?>
					<h4 class="text-center" style="font-weight: bold; margin-top: 20px;">อื่นๆ</h4>
					<a href="?video=<?php echo $row_videodetail['v_name']; ?>&name=<?php echo $name ?>&ep=<?php echo $ep; ?>&errorfilereport=reported" class="btn btn-info hvr-underline-from-center" style="width: 100%; margin-bottom: 5px;" id="report"><i class="fa fa-flag"></i> แจ้งไฟล์เสีย</a>
					<a href="javascript:vold(0);"  onclick="window.location.reload(true);" class="btn btn-danger hvr-icon-spin" style="width: 100%; margin-bottom: 5px;" id="reload"><i class="fas fa-sync-alt hvr-icon"></i> โหลดใหม่</a>
					<?php if ($num_video == 0) {
					?>
					<a href="?video=<?php echo $row_videodetail['v_name']; ?>&name=<?php echo $detail ?>&ep=<?php echo $nextep; ?>" class="btn btn-warning disabled hvr-icon-forward" disabled='' style="width: 100%; margin-bottom: 5px;" id="next-video">ยังไม่มา <i class="fa fa-arrow-circle-right"></i></a>
					<?php
					}else { ?>
					<a href="?video=<?php echo $row_videodetail['v_name']; ?>&name=<?php echo $detail ?>&ep=<?php echo $nextep; ?>" class="btn btn-warning hvr-icon-forward" style="width: 100%; margin-bottom: 5px;" id="next-video">ตอนถัดไป <i class="fa fa-arrow-circle-right hvr-icon"></i></a>
					<?php } ?>
				</div>
			</div>
			<?php
			} ?>
			<div class="anime_card">
				<div class="anime_titles"><i class="fab fa-facebook"></i> Fanpage</div>
				<div class="anime_body">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.2&appId=153313228407799&autoLogAppEvents=1';
					fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-page" data-href="https://www.facebook.com/AnimeHQ05/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/AnimeHQ05/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/AnimeHQ05/">Anime-HQ</a></blockquote></div>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h2 style="text-align: left;">Kuro Anime</h2>
				<p></p>
				
				<p>GOOGLE DRIVE | OPENLOAD | STREAMANGO | RAPIDVIDEO</p>
				<p>หน้านี้ประมวลผล 0.003247 วินาที                </p>
			</div>
			<div class="col-md-3">
				<h2 style="text-align: left;">ติดต่อโฆษณา</h2>
				<p><i class="fab fa-facebook"></i> <a href="https://www.facebook.com/AnimeHQ05" style="color: #fff" target="_blank">Anime Kuro</a></p>
				<p><i class="fas fa-paper-plane" style="font-size: 14px;"></i> Powered By KuroDev</p>
			</div>
		</div>
	</div>
</footer>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>