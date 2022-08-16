@php  
  use Carbon\Carbon;
  include(app_path().'/functions/myconf.php');
  $profile = ShowUserProfile();
@endphp
@extends('layouts.app')
@section('title', 'Trust CBT - Aplikasi Ujian Berbasis Komputer')
@section('breadcrumb')
	<h1>Penggunaan Voucher</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li class="active">Selamat datang</li>
	</ol>
@endsection
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
@section('content')
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Info Voucher</h3>
				<div class="pull-right">
					<a href="{{ url('manajemen-instansi/detail-manajemen-instansi/'.$tenant) }}">
						<button class="btn btn-flat btn-xs btn-danger"> <i class="fa fa-times-circle-o"></i> Tutup</button>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="col-sm-12">
					<div class="col-sm-6">
						<table class="table table-condensed" id="tab-status">
							<tbody>
								<tr>
									<td style="width: 20%">Nama Tenant</td>
									<td style="width: 30%" id="program">{{ $nama_tenant->ins_nama }}</td>
								</tr>
								<tr>
									<td style="width: 20%">Subskripsi</td>
									<td style="width: 30%" id="program">{{ $voucher->voi_nama }}</td>
								</tr>
								<tr>
									<td>Value Balance</td>
									<td id="jenis">{{ $voucher->voi_jumlah_voucher }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-sm-6">
						<form id="formfilter" action="" class="form-horizontal" >
							{{ csrf_field() }}
							<div class="col-sm-5"></div>
							<div class="col-sm-7">Filter data berdasarkan tanggal</div>
							<div class="form-group">
								<label for="nama" class="col-sm-5 control-label">Awal</label>
								<div class="col-sm-7">
									<input type="text" name="awal" class="input-sm form-control" id="awal" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="nama" class="col-sm-5 control-label">Akhir</label>
								<div class="col-sm-7">
									<input type="text" name="akhir" class="input-sm form-control" id="akhir" readonly>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="save" class="col-sm-5 control-label">&nbsp</label>
								<div class="col-sm-7">
									<div class="alert alert-danger" id="notif" style="display: none; margin: 0 auto 10px"></div>
									<button type="button" class="btn btn-sm btn-primary" id="setfilter">Filter</button>
									<button type="reset" class="btn btn-sm btn-default" id="clearfilter">Clear</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Data Voucher Balance</h3>
			</div>
			<div class="box-body">
				<table class="table table-custom table-hover table-striped" id="tabel_penggunaan">
					<thead>
						<tr>
							<th style="width: 5%">No.</th>
							<th style="width: 15%">Tanggal</th>
							<th style="width: 10%">Status</th>
							<th style="width: 30%">Catatan</th>
							<th style="width: 10%">Value Out</th>
							<th style="width: 10%">Value In</th>
							<th>Value Balance</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title" style="color: coral"><i class="fa fa-info-circle"></i> Informasi</h3>
			</div>
			<div class="box-body">
				<p>Terimakasih telah menggunakan aplikasi ujian.</p>
			</div>
		</div>
	</div>
@endsection
@push('css')
	<link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datepicker/datepicker3.css') }}">
	<style>
		#box-status-ujian{
			padding-top: 5px;
			padding-bottom: 5px;
		}
		.table-custom {
			border-collapse: collapse;
			width: 100%;
			font-size: 11px;
		}
		.table-custom td, .table-custom th {
			padding-top: 3px;
			padding-bottom: 3px;
		}
		.table-custom tr:nth-child(even) {background-color: #f2f2f2;}
		.table-custom table-custom tr:hover {background-color: #ddd;}
	</style>
	<style>
		#tab-status {
			border-collapse: collapse;
			width: 100%;
			background-color: #f2f2f2;
		}
		#tab-status td, #tab-status th {
			border: 0px solid #ddd;
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 10px;
			padding-right: 10px;
		}
		/* #tab-status tr:nth-child(even){background-color: #f2f2f2;} */
		/* #tab-status tr:hover {background-color: #ddd;} */
		#tab-status th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			color: white;
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
	<script>
		$('#awal').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			todayHighlight: true,
		});
		$('#akhir').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			todayHighlight: true,
		});
	</script>
	<script>
		load_datatables();
		function load_datatables(awal='',akhir='') {
			tabel_balance = $('#tabel_penggunaan').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				lengthChange: true,
				paging: false,
				ajax: {
					"url" : "{!! route("datatables.source-subskripsi-tenant") !!}",
					"type" : "POST",
					"data" : {
						"id": "{!! $id !!}",
						"tenant" : "{!! $tenant !!}",
						"awal" : awal,
						"akhir" : akhir,
					}
				},
				columns: [
					{data: 'DT_RowIndex',name: 'DT_RowIndex'},
					{data: 'tanggal',name: 'tanggal',orderable: true,searchable: true},
					{data: 'status',name: 'status',orderable: false,searchable: false},
					{data: 'catatan',name: 'catatan',orderable: false,searchable: false},
					{data: 'value_out',name: 'value_out',orderable: false,searchable: false},
					{data: 'value_in',name: 'value_in',orderable: false,searchable: false},
					{data: 'value_balance',name: 'value_balance',orderable: false,searchable: false}
				],
			});
		}
		$(document).ready(function() {
			$('#setfilter').on('click', function() {
				var awal = $('#awal').val();
				var akhir = $('#akhir').val();
				$('#tabel_penggunaan').DataTable().destroy();
				load_datatables(awal,akhir);
			});
			$('#clearfilter').on('click', function() {
				document.getElementById("formfilter").reset();
				$('#tabel_penggunaan').DataTable().destroy();
				load_datatables(); 
			});
		});
	</script>
@endpush