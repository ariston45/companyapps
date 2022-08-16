@php  
  use Carbon\Carbon;
  include(app_path().'/functions/myconf.php');
  $profile = ShowUserProfile();
@endphp
@extends('layouts.app')
@section('title', 'Trust CBT - Aplikasi Ujian Berbasis Komputer')
@section('breadcrumb')
  <h1>Manajemen Instansi</h1>
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
  @if(Auth::user()->status == 'SA' || Auth::user()->status == 'A' || Auth::user()->status == 'M' )
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Manajemen Instansi</h3>
        </div>
        <div class="box-body">
          <table class="table table-hover table-striped" id="tabel_instansi">
            <thead>
              <tr>
                <th style="width: 5%">No.</th>
                <th style="width: 25%">Nama Instansi</th>
                <th style="width: 25%">Telephone</th>
                <th style="width: 25%">Email</th>
                <th style="width: 20%">Menu</th>
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
  @endif
@endsection
@push('css')
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css')}}">
  <style>
		#box-status-ujian{
			padding-top: 5px;
			padding-bottom: 5px;
		}
		#tabel_instansi {
			border-collapse: collapse;
			width: 100%;
			font-size: 11px;
		}
		#tabel_instansi td, #tabel_instansi th {
			padding-top: 3px;
			padding-bottom: 3px;
		}
		#tabel_instansi tr:nth-child(even) {background-color: #f2f2f2;}
		#tabel_instansi tr:hover {background-color: #ddd;}
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
    $(document).ready(function() {
			tabel_jadwal = $('#tabel_instansi').DataTable({
				processing: true,
				serverSide: true,
				responsive: true,
				lengthChange: true,
				ajax: {
					"url" : "{!! route("datatables.source-instansi-manajemen") !!}",
					"type" : "POST",
				},
				columns: [
          {data: 'DT_RowIndex',name: 'DT_RowIndex'},
					{data: 'nama',name: 'nama',orderable: true,searchable: true},
          {data: 'telepon',name: 'telepon',orderable: false,searchable: false},
					{data: 'email',name: 'email',orderable: false,searchable: false},
          {data: 'menu',name: 'menu',orderable: false,searchable: false}
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
										tabel_jadwal.ajax.reload();
									}
								})
							}
						})
					});
				}
			});
		});
  </script>
@endpush