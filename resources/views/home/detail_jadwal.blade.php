@php  
  use Carbon\Carbon;
  include(app_path().'/functions/myconf.php');
  $profile = ShowUserProfile();
@endphp
@extends('layouts.app')
@section('title', 'Trust CBT - Aplikasi Ujian Berbasis Komputer')
@section('logo')
	<span class="logo-mini">
		<img src="{{ url('/storage/image/trustlogo.svg') }}" alt="" style="height: 40px; padding-bottom:1%;">
	</span>
	<span class="logo-lg" style="text-align: left">
		<img src="{{ url('/storage/image/trustlogo.svg') }}" alt="" style="height: 40px; padding-bottom:1%;">
		<text style="padding-bottom: 1%">TRUST</text>
	</span>
@endsection
@section('breadcrumb')
	<h1>Kelola Jadwal Ujian</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Kelola jadwal ujian</a></li>
		<li><a href="{{ route('jadwal.aktif') }}">Jadwal aktif</a></li>
		<li class="active">Detail jadwal</li>
	</ol>
@endsection
@section('content')
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header" id="box-status-ujian">
				<h5 class="box-title">Status Ujian</h5>
				<div class="pull-right">{{ $result['timer_header'] }}</div>
			</div>
			<div class="box-body no-padding">
				<table class="table table-condensed" id="tab-status">
					<tbody>
						<tr>
							<td style="width: 20%">Program ujian</td>
							<td style="width: 30%" id="program">-</td>
							<td style="width: 25%">Token ujian</td>
							<td style="width: 25%" id="token">-</td>
						</tr>
						<tr>
							<td>Jenis ujian</td>
							<td id="jenis">0</td>
							<td>Peserta ujian</td>
							<td id="login">0</td>
						</tr>
						<tr>
							<td>Status jadwal</td>
							<td id="status">-</td>
							<td id="timer_note">Waktu mundur jadwal dimulai</td>
							<td id="timer_countdown">0</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="clearfix"></div>
				<table id="tabel_partisipan" class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:2%;">No</th>
							<th style="width:48%;">Nama</th>
							<th style="width:15%;text-align:center;">Waktu Mulai Ujian</th>
              <th style="width:15%;text-align:center;">Waktu Selesai</th>
							<th style="width:10%;text-align:center;">Status</th>
							<th style="width:10%;text-align:center;">Menu Opsi</th>
						</tr>
					</thead>
					<tbody id="userlogin"></tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
@push('css')
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css') }}">
	<style>
		#box-status-ujian{
			padding-top: 5px;
			padding-bottom: 5px;
		}
		#tabel_partisipan {
			border-collapse: collapse;
			width: 100%;
			font-size: 12px;
		}
		#tabel_partisipan td, #tabel_partisipan th {
			padding-top: 3px;
			padding-bottom: 3px;
		}
		#tabel_partisipan tr:nth-child(even){background-color: #f2f2f2;}
		#tabel_partisipan tr:hover {background-color: #ddd;}
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
<script src="{{ url('assets/dist/js/sweetalert2.all.min.js') }}"></script>
<script src="{{URL::asset('assets/plugins/select2/select2.min.js')}}"></script>
<script>
	$(document).ready(function() {
		tabel_guru = $('#tabel_jadwal').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			lengthChange: true,
			ajax: {
				"url": "{!! route("datatables.source-jadwalhistori") !!}",
				"type" : "POST",
			},
			columns: [
				{data: 'DT_RowIndex',name: 'DT_RowIndex'},
				{data: 'waktu',name: 'waktu',orderable: true,searchable: true},
				{data: 'tenant',name: 'tenant',orderable: false,searchable: false},
				{data: 'program',name: 'program',orderable: false,searchable: false},
				{data: 'tipe',name: 'tipe',orderable: false,searchable: false},
				{data: 'status',name: 'status',orderable: false,searchable: false},
				{data: 'action',	name: 'action',orderable: false,searchable: false},
			],
			"drawCallback": function(setting) {
				$('.del-guru').on('click', function() {
					var id_user = $(this).attr('id');
					var $this = $(this);
					swal({
						title: 'Yakin akan dihapus?',
						text: "Data yang telah dihapus tidak bisa dikembalikan.",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Iya, hapus.'
					}).then((result) => {
						if (result.value) {
							$.ajax({
								type: 'POST',
								url: "{{ url('/crud/delete-guru') }}",
								data: {
									id_user: id_user
								},
								success: function(data) {
									swal(
										'Berhasil!',
										'Data guru berhasil dihapus.',
										'success'
									)
									tabel_kelas.ajax.reload();
								}
							})
						}
					})
				});
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		var id = {{ $id }};
		setInterval(function() {
			$.ajax({
				url: "{{ url('ajax/login-peserta') }}",
				type: "POST",
				cache: false,
				data:{id:id},
				success: function(data){
					document.getElementById('userlogin').innerHTML = data;
				}	
			});
		},1000);
	});
</script>
<script>
	$(document).ready(function() {
		var id = {{ $id }};
		setInterval(function() {
			$.ajax({
				url: "{{ url('ajax/status-ujian') }}",
				type: "POST",
				cache: false,
				data:{id:id},
				success: function(data){
					document.getElementById('program').innerHTML = data.program;
					document.getElementById('jenis').innerHTML = data.jenis;
					document.getElementById('status').innerHTML = data.status;
					document.getElementById('token').innerHTML = data.token;
					document.getElementById('login').innerHTML = data.login;
				}	
			});
		},1000);
	});
</script>
<script>
	function release(id) {
		$.ajax({
			url: "{{ url('ajax/release-peserta') }}",
			type: "POST",
			cache: false,
			data:{id:id},
			success: function(data){
				document.getElementById('release_button').disable = true;
			}	
		});
	}
</script>
<script>
	var timerStart = new Date('{{ $result['timer_start'] }}');
	var timerLock = new Date('{{ $result['timer_lock'] }}');
	var x = setInterval(function() {
		var now = new Date();
		var distance_start = timerStart - now;
		var hours = Math.floor((distance_start % (1000 * 60 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance_start % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance_start % (1000 * 60)) / 1000);
		document.getElementById("timer_countdown").innerHTML = hours+" : "+minutes+" : "+seconds+"s";
		if (distance_start < 0) {
			document.getElementById("timer_note").innerHTML = "Waktu mundur jadwal terkunci";
			var distance_lock = timerLock - now;
			var hours_i = Math.floor((distance_lock % (1000 * 60 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes_i = Math.floor((distance_lock % (1000 * 60 * 60)) / (1000 * 60));
			var seconds_i = Math.floor((distance_lock % (1000 * 60)) / 1000);
			document.getElementById("timer_countdown").innerHTML = hours_i+" : "+minutes_i+" : "+seconds_i+"s";
			if (distance_lock < 0) {
				clearInterval(x);
				document.getElementById("timer_countdown").innerHTML = "Berakhir";
			}
		}
	}, 1000);
</script>
@endpush
