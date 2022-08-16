@php  
  use Carbon\Carbon;
  include(app_path().'/functions/myconf.php');
  $profile = ShowUserProfile();
@endphp
@extends('layouts.app')
@section('title', 'Tambah Instansi')
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
	<h1>Kelola Jadwal Ujian</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('instansi') }}"><i class="fa fa-home"></i> Instansi</a></li>
		<li><a href="#" class="active"> Form tambah instansi</a></li>
	</ol>
@endsection
@section('content')
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> buat Jadwal</h3>
        <div class="pull-right">
          <a href="{{ route('subskripsi') }}">
            <button type="button" class="btn btn-xs btn-flat btn-danger" id="btn-create"><i class="fa fa-times-circle"></i> Tutup</button>
          </a>
        </div>
			</div>
			<div class="box-body">
				<div class="col-sm-12">
					<div class="col-sm-12">
            <form id="form-subskripsi" action="{{ route('crud.create-instansi') }}" class="form-horizontal" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Nama Subskripsi</label>
								<div class="col-sm-9">
                  <input type="text" name="nama" class="form-control"  required>
								</div>
							</div>
              <div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Pilih Metode Pembayaran</label>
								<div class="col-sm-9">
                  <select class="input-sm form-control select2" name="pembayaran" style="width: 100%;" required>
                    <option value="{{ NULL }}" selected="selected" disabled> </option>
                    <option value="PRABAYAR">Prabayar</option>
                    <option value="PASCABAYAR">Pascabayar</option>
                  </select>
                </div>
							</div>
							<div class="form-group">
								<label for="save" class="col-sm-3 control-label">&nbsp</label>
								<div class="col-sm-9">
									<div class="alert alert-danger" id="notif" style="display: none; margin: 0 auto 10px"></div>
									<button type="button" class="btn btn-sm btn-flat btn-primary" id="save">Simpan</button>
									<button type="reset" class="btn btn-sm btn-flat btn-default" id="reset">Bersihkan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('css')
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/AdminLTE-select2.2.4.18.css') }}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/select2/AdminLTE-select2.2.4.18.css') }}">
	<style>
		#tab-status {
			border-collapse: collapse;
			width: 100%;
		}
		#tab-status td, #tab-status th {
			border: 0px solid #ddd;
			padding-top: 4px;
			padding-bottom: 4px;
			padding-left: 8px;
			padding-right: 8px;
		}
		#tab-status tr:nth-child(even){background-color: #f2f2f2;}
		#tab-status tr:hover {background-color: #ddd;}
		#tab-status th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			color: white;
		}
		#alokasi {
			pointer-events: none;
		}
	</style>
  <style>
    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
      max-width: 250px;
      max-height: 250px;
    }
  </style>
@endpush
@push('scripts')
  <script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
	<script>
		$(".select2").select2();
	</script>
	<script type="text/javascript">
		$('#save').click(function() {
			$('#notif').hide();
			var formdata = $('#form-subskripsi').serialize();
			$.ajax({
				type: 'POST',
				url: "{{ url('crud/create-subskripsi') }}",
				data: formdata,
				success: function(data) {
					if (data == 1) {
						swal(
							'Berhasil!',
							'Jadwal ujian sudah berhasil diperbarui.',
							'success'
						)
					}else{
						$('#notif').html(data).show();
					}
				}
			})
		});
	</script>
@endpush