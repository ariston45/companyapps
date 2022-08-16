@php  
  use Carbon\Carbon;
  include(app_path().'/functions/myconf.php');
  $profile = ShowUserProfile();
@endphp
@extends('layouts.app')
@section('title', 'Trust CBT - Aplikasi Ujian Berbasis Komputer')
@section('logo-mobile')
<span class="mobile-display-logo">
  <a href="{{url('/')}}" class="logo">
    <img src="{{ url('/storage/app/system/image_logo/trustlogo.png') }}" alt="" style="height: 35px;">
    <text class="mobile-logo-name">{{ $profile->ins_nama }}</text>
  </a>
</span>
@endsection
@section('logo')
<span class="display-logo">
  <div class="logo-panel">
    <div class="image custom-logo" style="text-align: center">
      <img src="{{ url('/storage/app/system/image_logo/trustlogo.png') }}">
    </div>
  </div>
  <text id="logo_name" class="logo-name logo-lg" >{{ $profile->ins_nama }}</text>
</span>
@endsection
@section('user-panel')
<div class="user-panel">
  <div class="pull-left image">
    @if(Auth::user()->profil_img != "")
      <img src="{{ url('/storage/app/public/'.Auth::user()->profil_img) }}" class="img-circle" alt="User Image">
    @else
      <img src="{{ url('/storage/app/public/userimg_i.png') }}" class="img-circle" alt="User Image">
    @endif
  </div>
  <div class="pull-left info">
    <p>{{ Auth::user()->nama }}</p>
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>
@endsection
@section('breadcrumb')
  <h1>Detail Instansi</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Instansi</a></li>
    <li class="active">Detail instansi</li>
  </ol>
@endsection
@section('content')
  <div class="row">
		<div class="col-md-12">
			<div id="btndiv">
				<a class="btn btn-custom btn-app" id="btn_instansi">
					<i class="fa fa-institution"></i> <b>Profil</b>
				</a>
				<a class="btn btn-custom btn-app" id="btn_jadwal">
					<i class="fa fa-calendar"></i> <b>Jadwal</b>
				</a>
				<a class="btn btn-custom btn-app" id="btn_grup_siswa">
					<i class="fa fa-group"></i> <b>Grup Siswa</b>
				</a>
				<a class="btn btn-custom btn-app" id="btn_siswa">
					<i class="fa fa-mortar-board"></i> <b>Siswa</b>
				</a>
				<a class="btn btn-custom btn-app" id="btn_pengguna">
					<i class="fa fa-user"></i> <b>Pengguna</b>
				</a>
				<a class="btn btn-custom btn-app" id="btn_pengaturan">
					<i class="fa fa-cogs"></i> <b>Pengaturan</b>
				</a>
			</div>
		</div>
		<div class="col-md-12" id="box_1">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive" src="{{ url('storage/app/'.$instansi->ins_logo) }}" alt="User profile picture">
					<h5 class="profile-username text-center">{{ $instansi->ins_nama }}</h5>
					<p class="text-muted text-center"></p>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Alamat</b><br><a>{{ $instansi->ins_alamat }}</a>
						</li>
						<li class="list-group-item">
							<b>Email</b><br><a>{{ $instansi->ins_email }}</a>
						</li>
						<li class="list-group-item">
							<b>Telepon</b><br><a>{{ $instansi->ins_telepon }}</a>
						</li>
					</ul>
					<a href="{{ url('instansi/perbarui-instansi/'.$ids) }}" class="btn btn-sm btn-default btn-block"><b>Perbarui Data</b></a>
				</div>
			</div>
		</div>
		<div class="col-md-12" id="box_2">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#jadwal-aktif" data-toggle="tab">Jadwal Ujian Aktif</a></li>
					<li><a href="#jadwal-non-aktif" data-toggle="tab"> Histori Jadwal Ujian</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="jadwal-aktif">
						<div class="post clearfix">
							<table id="tabel_jadwal" class="table tabel_custom table-hover table-condensed">
								<thead>
									<tr>
										<th style="width:2%;">No</th>
										<th style="width:15%;">Waktu</th>
										<th style="width:25%;">Program</th>
										<th style="width:15%;">Kelas</th>
										<th style="width:15%;">Guru</th>
										<th style="width:10%;">Status</th>
										<th>Menu Opsi</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<div class="tab-pane" id="jadwal-non-aktif">
						<table id="tabel_jadwal_nonaktif" class="table tabel_custom table-hover table-condensed">
							<thead>
								<tr>
									<th style="width: 2%;padding-right: 5px;">No</th>
									<th style="width: 15%">Waktu</th>
									<th style="width: 25%">Program</th>
									<th style="width: 15%">Kelas</th>
									<th style="width: 15%">Status</th>
									<th style="width: 10%">Menu Opsi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12" id="box_3">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"> Grup Siswa</h3>
				</div>
				<div class="box-body">
					<div class="active tab-pane" id="grup-siswa">
						<div class="post clearfix">
							<table id="grup_siswa" class="table tabel_custom table-hover table-condensed">
								<thead>
									<tr>
										<th style="width: 5%;padding-right: 5px;">No</th>
										<th style="width: 25%">Nama Grup</th>
										<th style="width: 20%">Pengampu</th>
										<th style="width: 10%">Jumlah</th>
										<th style="width: 10%">Status</th>
										<th style="width: 15%">Aktif Sampai Tanggal</th>
										<th style="width: 15%">Menu Opsi</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
			{{--  --}}
		</div>
		<div class="col-md-12" id="box_4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Siswa</h3>
				</div>
				<div class="box-body">
					<div class="active tab-pane" id="grup-siswa">
						<div class="post clearfix">
							<table id="tabel_siswa" class="table tabel_custom table-hover table-condensed">
								<thead>
									<tr>
										<th style="width: 2%;padding-right: 5px;">No</th>
										<th style="width: 30%">Nama Siswa</th>
										<th style="width: 20%">Kelas</th>
										<th style="width: 10%">Ujian</th>
										<th style="width: 20%">Tanggal Terakhir Ujian</th>
										<th style="width: 15%">Menu Opsi</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
			{{--  --}}
		</div>
		<div class="col-md-12" id="box_5">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Pengguna</h3>
					<div class="pull-right">
						<a href="{{ url('instansi/tambah-user/'.$ids) }}">
							<button class="btn btn-flat btn-xs btn-primary"> <i class="fa fa-user-plus"></i> Tambah User</button>
						</a>
						<a href="#">
							<button id="generate" class="btn btn-flat btn-xs btn-primary"> <i class="fa fa-plus-square"></i> Generate User Admin</button>
						</a>
					</div>
				</div>
				<div class="box-body">
					<div class="active tab-pane" id="grup-siswa">
						<div class="post clearfix">
							<table id="tabel_pengguna" class="table tabel_custom table-hover table-condensed">
								<thead>
									<tr>
										<th style="width: 2%;padding-right: 5px;"">No</th>
										<th style="width: 30%">Nama</th>
										<th style="width: 20%">Email</th>
										<th style="width: 10%">Telepon</th>
										<th style="width: 20%">Guru/Dosen</th>
										<th style="width: 15%">Menu Opsi</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
			{{--  --}}
		</div>
		<div class="col-md-12" id="box_6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Form Perbarui Instansi</h3>
				</div>
				<div class="box-body">
					<div class="col-sm-12">
						<div class="col-sm-12">
							<form action="" id="pengaturan_tenant">
								<div id="box-body">
									<div class="form-group">
										<label>Hasil ujian atau nilai ujian akan ditampilkan ke ke peserta ujian.</label>
										<div class="radio" style="margin-top: 0px;">
											<label>
												<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
												Nilai ditampilkan.
											</label><br>
											<label>
												<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
												Nilai tidak ditampilkan.
											</label>
										</div>
									</div>
									<div class="form-group">
										<label></label>
										<div class="radio" style="margin-top: 0px;">
											<label>
												<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
												Nilai ditampilkan.
											</label><br>
											<label>
												<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
												Nilai tidak ditampilkan.
											</label>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('css')
<link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/plugins/iCheck/all.css')}}">
<style>
	.btn-custom {
		margin-left: 0px;
	}
</style>
<style>
	.profile-user-img {
		border: none;
	}
	#box-status-ujian{
		padding-top: 5px;
		padding-bottom: 5px;
	}
	.tabel_custom {
		border-collapse: collapse;
		width: 100%;
		font-size: 11px;
	}
	.tabel_custom td, .tabel_custom th {
		padding-top: 3px;
		padding-bottom: 3px;
	}
	.tabel_custom tr:nth-child(even){background-color: #f2f2f2;}
	.tabel_custom tr:hover {background-color: #ddd;}
</style>
<style>
	#tenant-name {
		font-size: 16px;
		font-size: 1.5vw;
	}
</style>
@endpush
@push('scripts')
  <script src="{{URL::asset('assets/dist/js/sweetalert2.all.min.js') }}"></script>
  <script src="{{URL::asset('assets/plugins/select2/select2.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
  {{-- Jadwal Aktif --}}
	<script>
		$(document).ready(function() {
			tabel_guru = $('#tabel_jadwal').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				lengthChange: true,
				ajax: {
					"url": "{!! route("datatables.source-jadwalaktif") !!}",
					"type" : "POST",
					"data": {"tenant":"{{ $ids }}"},
				},
				columns: [
					{data: 'DT_RowIndex',name: 'DT_RowIndex'},
					{data: 'waktu',name: 'waktu',orderable: true,searchable: true},
					{data: 'program',name: 'program',orderable: false,searchable: false},
					{data: 'kelas',name: 'kelas',orderable: false,searchable: false},
          {data: 'guru',name: 'guru',orderable: false,searchable: false},
          {data: 'status',name: 'status',orderable: false,searchable: false},
					{data: 'action',name: 'action',orderable: false,searchable: false},
				]
			});
		});
	</script>
	{{-- Jadal Non-Aktif --}}
	<script>
		$(document).ready(function() {
			tabel_guru = $('#tabel_jadwal_nonaktif').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				lengthChange: true,
				ajax: {
					"url": "{!! route("datatables.source-jadwalhistori") !!}",
					"type" : "POST",
					"data": {"tenant":"{{ $ids }}"},
				},
				columns: [
					{data: 'DT_RowIndex',name: 'DT_RowIndex'},
					{data: 'waktu',name: 'waktu',orderable: true,searchable: true},
					{data: 'program',name: 'program',orderable: false,searchable: false},
					{data: 'kelas',name: 'kelas',orderable: false,searchable: false},
          {data: 'status',name: 'status',orderable: false,searchable: false},
					{data: 'action',name: 'action',orderable: false,searchable: false},
				]
			});		
		});
	</script>
	{{-- Grup Siswa --}}
	<script>
    $(document).ready(function (){
      tabel_siswa = $('#grup_siswa').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
				ajax: {
					"url": "{!! route("datatables.source-grup-siswa") !!}",
					"type" : "POST",
					"data": {"tenant":"{{ $ids }}"},
				},
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama', orderable: true, searchable: true },
          {data: 'pengampu', name: 'pengampu', orderable: false, searchable: false },
          {data: 'jumlah_siswa', name: 'jumlah_siswa', orderable: false, searchable: false },
          {data: 'status', name: 'status', orderable: false, searchable: false },
          {data: 'batas_waktu', name: 'batas_waktu', orderable: false, searchable: false},
          {data: 'menu', name: 'menu', orderable: false, searchable: false},
        ]
      });
    });
  </script>
	{{-- Siswa --}}
	<script>
    $(document).ready(function (){
      tabel_siswa = $('#tabel_siswa').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
				ajax: {
					"url": "{!! route("datatables.source-siswa") !!}",
					"type" : "POST",
					"data": {"tenant":"{{ $ids }}"},
				},
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama', orderable: true, searchable: true },
          {data: 'kelas', name: 'kelas', orderable: false, searchable: false },
          {data: 'jumlah_ujian', name: 'jumlah_ujian', orderable: false, searchable: false },
          {data: 'terakhir_ujian', name: 'terakhir_ujian', orderable: false, searchable: false },
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    });
  </script>
	{{-- Pengguna --}}
	<script>
    $(document).ready(function (){
      tabel_pengguna = $('#tabel_pengguna').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
				ajax: {
					"url": "{!! route("datatables.source-pengguna") !!}",
					"type" : "POST",
					"data": {"tenant":"{{ $ids }}"},
				},
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama', orderable: true, searchable: true },
          {data: 'email', name: 'email', orderable: false, searchable: false },
          {data: 'telepon', name: 'telepon', orderable: false, searchable: false },
          {data: 'status', name: 'status', orderable: false, searchable: false },
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
			$("#generate").click(function() {
				$.ajax({
					type: "POST",
					url: "{{ url('crud/generate-admin-tenant') }}",
					data: {"id":"{!! $ids !!}" },
					success: function(data){
						if (data == 1) {
							swal(
								'Berhasil!',
								'Data guru berhasil disimpan.',
								'success'
							)
							tabel_pengguna.ajax.reload();
						}else{
							$('#notif').html(data).show();
						}
					}
				})
			});
    });
  </script>
	<script>
		$(document).ready(function (){
			
		});
	</script>
	{{-- Pengaturan --}}
	<script>
		//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
	</script>
	{{-- Custom & other --}}
	<script>
		document.getElementById("btn_instansi").classList.add("bg-light-blue");
		$('#box_1').show();
		$('#box_2').hide();
		$('#box_3').hide();
		$('#box_4').hide();
		$('#box_5').hide();
		$('#box_6').hide();
		$('#btn_instansi').on('click', function() {
			$('#box_1').show();
			$('#box_2').hide();
			$('#box_3').hide();
			$('#box_4').hide();
			$('#box_5').hide();
			$('#box_6').hide();
		});
		$('#btn_jadwal').on('click', function() {
			$('#box_1').hide();
			$('#box_2').show();
			$('#box_3').hide();
			$('#box_4').hide();
			$('#box_5').hide();
			$('#box_6').hide();
		});
		$('#btn_grup_siswa').on('click', function() {
			$('#box_1').hide();
			$('#box_2').hide();
			$('#box_3').show();
			$('#box_4').hide();
			$('#box_5').hide();
			$('#box_6').hide();
		});
		$('#btn_siswa').on('click', function() {
			$('#box_1').hide();
			$('#box_2').hide();
			$('#box_3').hide();
			$('#box_4').show();
			$('#box_5').hide();
			$('#box_6').hide();
		});
		$('#btn_pengguna').on('click', function() {
			$('#box_1').hide();
			$('#box_2').hide();
			$('#box_3').hide();
			$('#box_4').hide();
			$('#box_5').show();
			$('#box_6').hide();
		});
		$('#btn_pengaturan').on('click', function() {
			$('#box_1').hide();
			$('#box_2').hide();
			$('#box_3').hide();
			$('#box_4').hide();
			$('#box_5').hide();
			$('#box_6').show();
		});
	</script>
	<script>
		var header = document.getElementById("btndiv");
		var btns = header.getElementsByClassName("btn");
		for (var i = 0; i < btns.length; i++) {
			btns[i].addEventListener("click", function() {
				var current = document.getElementsByClassName("bg-light-blue");
				current[0].className = current[0].className.replace(" bg-light-blue", "");
				this.className += " bg-light-blue";
			});
		}
	</script>
@endpush