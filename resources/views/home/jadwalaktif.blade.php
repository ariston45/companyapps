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
@section('content')
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title aaaa"><i class="fa fa-address-card" aria-hidden="true"></i> Data Jadwal Aktif</h3>
			</div>
			<div class="box-body">
				<div class="clearfix"></div>
				<table id="tabel_jadwal" class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:2%;">No</th>
							<th style="width:11%;">Waktu</th>
              <th style="width:25%;">Tenant</th>
							<th style="width:20%;">Program</th>
							<th style="width:15%;">Tipe Ujian</th>
              <th style="width:10%;">Status</th>
							<th>Menu Opsi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title" style="color: darkorange"><i class="fa fa-info-circle"></i> Informasi</h3>
			</div>
			<div class="box-body">
				<p>Daftarkan seluruh kelas malalui halaman ini. Data kelas diperlukan untuk mengelompokan siswa dan untuk
					mendistribusian paket soal.</p>
				<p>Jika terdapat data kelas yang belum valid atau kelas yang belum terdaftar, hubungi operator sekolah untuk
					merubah atau mendaftarkan kelas tersebut.</p>
			</div>
		</div>
	</div>
@endsection
@push('css')
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css') }}">
@endpush
@push('scripts')
<script src="{{ url('assets/dist/js/sweetalert2.all.min.js') }}"></script>
<script src="{{URL::asset('assets/plugins/select2/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>>
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
				},
				columns: [
					{data: 'DT_RowIndex',name: 'DT_RowIndex'},
					{data: 'waktu',name: 'waktu',orderable: true,searchable: true},
					{data: 'tenant',name: 'tenant',orderable: false,searchable: false},
					{data: 'program',name: 'program',orderable: false,searchable: false},
          {data: 'tipe',name: 'tipe',orderable: false,searchable: false},
          {data: 'status',name: 'status',orderable: false,searchable: false},
					{data: 'action',name: 'action',orderable: false,searchable: false},
				]
			});
			// get form create guru
			$('#btn-create').click(function() {
				$('#form-guru').slideToggle();
			});
			// action simpan guru
			$('#save').click(function() {
				$('#notif').hide();
				var formData = $('#form-guru').serialize();
				$.ajax({
					type: 'POST',
					url: "{{ url('crud/create-guru') }}",
					data: formData,
					success: function(data) {
						if (data == 1) {
              swal(
                'Berhasil!',
                'Data guru berhasil disimpan.',
                'success'
              )
              tabel_guru.ajax.reload();
            }else{
              $('#notif').html(data).show();
            }
					}
				})
			});
		});
	</script>
@endpush
