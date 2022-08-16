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
  <h1>Subskripsi</h1>
  <ol class="breadcrumb">
    <li class="active"><a href="#"><i class="fa fa-home"></i> Subskripsi</a></li>
  </ol>
@endsection
@section('content')
	<div class="col-md-12">
    <div id="btndiv">
      <a class="btn btn-flat btn-custom btn-app" id="btn_subskripsi">
        <i class="fa fa-diamond"></i> <b>Subskripsi Tenant</b>
      </a>
      <a class="btn btn-flat btn-custom btn-app" id="btn_top_up">
        <i class="fa fa-plus"></i> <b>Top-Up Vouchers</b>
      </a>
      <a class="btn btn-flat btn-custom btn-app" id="btn_add_subskripsi">
        <i class="fa fa-paper-plane"></i> <b>Tambah Subskripsi</b>
      </a>
    </div>
  </div>
	{{-- subskripsi --}}
  <div class="col-md-12" id="box_subskripsi" >
  </div>
	{{-- ===== --}}
  <div class="col-md-12" id="box_top_up">
    <div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Form Top-Up Voucher</h3>
			</div>
			<div class="box-body">
				<div class="col-sm-12">
					<div class="col-sm-12">
            <form id="form-top-up" action="" class="form-horizontal" enctype="multipart/form-data" method="POST" autocomplete="off">
              {{ csrf_field() }}
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Pilih Subskripsi</label>
								<div class="col-sm-9">
                  <select class="input-sm form-control select2" name="id_subskripsi" style="width: 100%;" required>
                    <option value="{{ NULL }}" selected="selected" disabled>Pilih subskripsi...</option>
										@foreach ($subskripsi_tenant as $subs)
										<option value="{{ $subs->voi_id }}" >{{ $subs->voi_nama }}</option>
										@endforeach
                  </select>
                </div>
							</div>
              <div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Jumlah Voucher</label>
								<div class="col-sm-9">
                  <input type="text" name="jumlah_voucher" class="form-control" value="" placeholder="Jumlah voucher..." required>
								</div>
							</div>
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Nomor Invoice</label>
								<div class="col-sm-9">
									<input type="text" name="nomor_invoice" class="form-control" value="" placeholder="Nomor invoice...">
								</div>
							</div>
              <div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Tanggal</label>
								<div class="col-sm-9">
									<input type="text" name="tanggal" class="form-control" value="{{ date('Y-m-d',strtotime(now())) }}" id="datepicker" autocomplete="false">
								</div>
							</div>
							<div class="form-group">
								<label for="save" class="col-sm-3 control-label">&nbsp</label>
								<input type="hidden" name="ids" value="{{ $tenant }}">
								<div class="col-sm-9">
									<div class="alert alert-danger" id="notif_box_2" style="display: none; margin: 0 auto 10px"></div>
									<button type="button" class="btn btn-flat btn-sm btn-primary" id="save_box_2">Simpan</button>
									<button type="reset" class="btn btn-flat btn-sm btn-default" id="reset">Bersihkan</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
  </div>
  <div class="col-md-12" id="box_tambah_subskripsi">
    <div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Form Tambah Subskripsi</h3>
			</div>
			<div class="box-body">
				<div class="col-sm-12">
					<div class="col-sm-12">
            <form id="form-subskripsi" action="" class="form-horizontal" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Pilih Subskripsi</label>
								<div class="col-sm-9">
                  <select class="input-sm form-control select2" name="subskripsi" id="subskripsi" style="width: 100%;" required>
                    <option value="{{ NULL }}" selected="selected" disabled>Pilih subskripsi...</option>
										@foreach ($subskripsi_system as $subs)
										<option value="{{ $subs->id_subskripsi }}" >{{ $subs->nama_subs }}</option>
										@endforeach
                  </select>
                </div>
							</div>
							<div class="form-group">
								<label for="save" class="col-sm-3 control-label">&nbsp</label>
								<input type="hidden" name="ids" value="{{ $tenant }}">
								<div class="col-sm-9">
									<div class="alert alert-danger" id="notif_box_3" style="display: none; margin: 0 auto 10px"></div>
									<button type="button" class="btn btn-flat btn-sm btn-primary" id="save_box_3">Simpan</button>
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
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/plugins/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/select2/AdminLTE-select2.2.4.18.css') }}">
	<link rel="stylesheet" href="{{URL::asset('assets/plugins/datepicker/datepicker3.css') }}">
	<style>
		.btn-custom {
			margin-left: 0px;
		}
	</style>
@endpush
@push('scripts')
  <script src="{{ url('assets/dist/js/sweetalert2.all.min.js') }}"></script>
  <script src="{{URL::asset('assets/plugins/select2/select2.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
	<script>
		$(".select2").select2({
			placeholder: "Pilih subskripsi",
			allowClear: true,
		});
		$('#datepicker').datepicker({
				autoclose: true,
				format: 'yyyy-mm-dd',
				todayHighlight: true,
		});
	</script>
	<script>
		$('#save_box_3').click(function() {
			$('#notif_box_3').hide();
			var formdata = $('#form-subskripsi').serialize();
			$.ajax({
				type: 'POST',
				url: "{{ url('crud/add-subskripsi') }}",
				data: formdata,
				success: function(data) {
					if (data == 1) {
						swal(
							'Berhasil!',
							'Jadwal ujian sudah berhasil diperbarui.',
							'success'
						)
					}else{
						$('#notif_box_3').html(data).show();
					}
				}
			})	
		});
		$('#save_box_2').click(function() {
			$('#notif_box_2').hide();
			var formdata = $('#form-top-up').serialize();
			$.ajax({
				type: 'POST',
				url: "{{ url('crud/top-up-subskripsi') }}",
				data: formdata,
				success: function(data) {
					if (data == 1) {
						swal(
							'Berhasil!',
							'Jadwal ujian sudah berhasil diperbarui.',
							'success'
						)
					}else{
						$('#notif_box_2').html(data).show();
					}
				}
			})	
		});
		function subskripsilist() {
			var id = {!! json_encode($tenant) !!};
			$.ajax({
				type: "POST",
				url: "{!! url('crud/view-subskripsi') !!}",
				data: {id:id},
				success: function(data) {
					document.getElementById("box_subskripsi").innerHTML = data;
				}
			})
		}
		setInterval(function() {
			subskripsilist();
		},1000);
	</script>
  <script>
    document.getElementById("btn_subskripsi").classList.add("bg-light-blue");
		$('#box_subskripsi').show();
		$('#box_top_up').hide();
		$('#box_tambah_subskripsi').hide();
		$('#btn_subskripsi').on('click', function() {
      $('#box_subskripsi').show();
      $('#box_top_up').hide();
      $('#box_tambah_subskripsi').hide();
		});
		$('#btn_top_up').on('click', function() {
      $('#box_subskripsi').hide();
      $('#box_top_up').show();
      $('#box_tambah_subskripsi').hide();
		});
		$('#btn_add_subskripsi').on('click', function() {
      $('#box_subskripsi').hide();
      $('#box_top_up').hide();
      $('#box_tambah_subskripsi').show();
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