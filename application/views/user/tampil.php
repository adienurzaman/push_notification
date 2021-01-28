<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Push Notifications</title>

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Datatable -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">

	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

	<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

	<script src="<?= base_url('public/app.js?upd=' . date('YmdHis')); ?>"></script>

</head>

<body>
	<div id="container">
		<div class="container">
			<div id="body">
				<div class="row animated fadeInDown info_notifikasi">
					<div class="col-md-12">
						<div class="alert alert-info">
							<i class="fa fa-info-circle mr-1"></i> <b class="">Notifikasi tidak aktif</b>. Aktifkan notifikasi dengan menekan ikon <i class="fa fa-lock"></i> pada address bar diatas dan ubah status <b>Notifications</b> menjadi <b>Izinkan / Allow</b>.
						</div>
					</div>
				</div>
				<br>
				<p>
					<a class="btn btn-info btn-md" data-toggle="modal" data-target="#modal_tambah">
						<i class="glyphicon glyphicon-plus"></i> Tambah Data
					</a>
					<a class="btn btn-info btn-md" href="<?= base_url('push/send'); ?>" target="_blank">
						<i class="glyphicon glyphicon-send"></i> Single Push
					</a>
					<a class="btn btn-info btn-md" href="<?= base_url('push/send_multiple'); ?>" target="_blank">
						<i class="glyphicon glyphicon-send"></i> Multiple Push
					</a>
				</p>
				<table id="tabel_user" class="table table-bordered table-striped table-hover nowrap" width="100%">
					<thead>
						<tr>
							<th>UserID</th>
							<th>ID</th>
							<th>Title</th>
							<th>Body</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>

			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
		</div>
	</div>

	<div class="modal fade" id="modal_tambah">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Tambah Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_tambah">
					<div class="modal-body">
						<div>
							<label class="label-control">User ID</label>
							<input type="number" class="form-control" name="userId" id="userId" required>
						</div>
						<div>
							<label class="label-control">Title</label>
							<input type="text" class="form-control" name="title" id="title" required>
						</div>
						<div>
							<label class="label-control">Body</label>
							<textarea class="form-control" name="body" id="body" required></textarea>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<div class="modal fade" id="modal_edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form_edit">
					<div class="modal-body">
						<div>
							<label class="label-control">User ID</label>
							<input type="number" class="form-control" name="userId" readonly>
						</div>
						<div>
							<label class="label-control">ID</label>
							<input type="number" class="form-control" name="id" readonly>
						</div>
						<div>
							<label class="label-control">Title</label>
							<input type="text" class="form-control" name="title" required>
						</div>
						<div>
							<label class="label-control">Body</label>
							<textarea class="form-control" name="body" required></textarea>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<div class="modal inmodal animated fadeInDown" id="push_requestPermission" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<img src="https://psb.attadzkirmaja.com/assets/img/favicon.png" width="75" class="rounded-circle">
					<h4 class="modal-title">Informasi Penting</h4>
					<span class="font-bold">Pondok Pesantren At-Tadzkir Maja</span>
				</div>
				<div class="modal-body pb-3">
					<p>
						Mohon untuk mengaktifkan notifikasi website PSB Ponpes At-Tadzkir untuk mendapatkan beberapa notifikasi penting, seperti :
					</p>
					<ol class="pl-3">
						<li><b>Kode verifikasi pendaftaran</b></li>
						<li><b>Informasi konfirmasi pembayaran</b></li>
						<li><b>Pengumuman penting seputar pondok pesantren</b></li>
						<li><b>Informasi seputar pembayaran</b></li>
						<li><b>dsb.</b></li>
					</ol>
					<p>
						Mengaktifkan notifikasi dapat dilakukan dengan memilih tombol <b>Allow / Izinkan</b> setelah menekan tombol <b>Aktifkan Notifikasi</b> dibawah.
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success push_request_permission" onclick="push_request_permission()">Aktifkan Notifikasi</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		let form_tambah;
		let form_edit;
		let modal_tambah;
		let modal_edit;
		let tabel;
		$(function() {
			form_tambah = $("#form_tambah");
			form_edit = $("#form_edit");
			modal_tambah = $("#modal_tambah");
			modal_edit = $("#modal_edit");

			tabel = $("#tabel_user").DataTable({
				responsive: true,
				processing: true,
				ajax: {
					url: "https://jsonplaceholder.typicode.com/posts",
					dataSrc: ""
				},
				columns: [{
						data: "userId"
					},
					{
						data: "id"
					},
					{
						data: "title"
					},
					{
						data: "body"
					},
					{
						render: (data, type, row) => {
							return '<button class="btn btn-success" onclick=edit("' + row.id + '")>Edit Data</button> <button class="btn btn-danger" onclick=hapus("' + row.id + '")>Hapus Data</button>';
						}
					}
				]
			});

			//reset data ketika hide modal
			$(".modal").on("hide.bs.modal", () => {
				form_tambah[0].reset();
				form_tambah[0].reset();
			});

			//submit data baru
			form_tambah.on("submit", (event) => {
				event.preventDefault();
				let url = "https://jsonplaceholder.typicode.com/posts";
				let config = {
					method: "POST",
					body: JSON.stringify({
						title: form_tambah.find("[name='title']").val(),
						body: form_tambah.find("[name='body']").val(),
						userId: form_tambah.find("[name='userId']").val(),
					})
				}

				simpan('tambah', url, config);
			});

			//submit data edit
			form_edit.on("submit", (event) => {
				event.preventDefault();
				let id = form_edit.find("[name='id']").val();
				let url = "https://jsonplaceholder.typicode.com/posts/" + id;
				let config = {
					method: "PUT",
					body: JSON.stringify({
						id: form_edit.find("[name='id']").val(),
						title: form_edit.find("[name='title']").val(),
						body: form_edit.find("[name='body']").val(),
						userId: form_edit.find("[name='userId']").val(),
					})
				}

				simpan('update', url, config);
			});
		});

		const simpan = (segment, url, config) => {
			fetch(url, config)
				.then((response) => {
					if (response.ok) {
						return response.json();
					} else {
						return Promise.reject({
							status: response.status,
							statusText: response.statusText
						})
					}
				}).then((output) => {
					//response json
					console.log(output);
					if (segment == "tambah") {
						modal_tambah.modal('hide');
					} else {
						modal_edit.modal('hide');
					}
					tabel.ajax.reload(false, null)
				}).catch((error) => {
					console.error(error);
				})
		}

		const edit = (id) => {
			let url = "https://jsonplaceholder.typicode.com/posts/" + id;
			let config = {
				method: "GET",
			}
			fetch(url, config)
				.then((response) => {
					if (response.ok) {
						return response.json();
					} else {
						return Promise.reject({
							status: response.status,
							statusText: response.statusText
						})
					}
				}).then((output) => {
					//response json
					form_edit.find("[name='userId']").val(output.userId);
					form_edit.find("[name='id']").val(output.id);
					form_edit.find("[name='title']").val(output.title);
					form_edit.find("[name='body']").html(output.body);

					modal_edit.modal({
						show: true,
						backdrop: 'static'
					});
				}).catch((error) => {
					console.error(error);
				})
		}

		const hapus = (id) => {
			let url = "https://jsonplaceholder.typicode.com/posts/" + id;
			let config = {
				method: "DELETE",
			}
			fetch(url, config)
				.then((response) => {
					if (response.ok) {
						return response.text();
					} else {
						return Promise.reject({
							status: response.status,
							statusText: response.statusText
						})
					}
				}).then((output) => {
					alert('Hapus Sukses');
					tabel.ajax.reload(false, null);
				}).catch((error) => {
					console.error(error);
				})
		}
	</script>
</body>

</html>