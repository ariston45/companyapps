@extends('layouts.app')
@section('title', 'Tambah Instansi')
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
	<h1>Perbarui Data Instansi</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('instansi') }}"><i class="fa fa-home"></i> Instansi</a></li>
		<li><a href="#" class="active"> Form perbarui instansi</a></li>
	</ol>
@endsection
@section('content')
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Form Perbarui Instansi</h3>
				<div class="pull-right">
					<a href="{{ url('instansi/detail-instansi/'.$instansi->ins_tenant_id) }}">
						<button class="btn btn-flat btn-xs btn-danger"> <i class="fa fa-times-circle-o"></i> Tutup</button>
					</a>
				</div>
			</div>
			<div class="box-body">
				<div class="col-sm-12">
					<div class="col-sm-12">
            <form id="form-instansi" action="{{ route('crud.update-instansi') }}" class="form-horizontal" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Nama Instansi</label>
								<div class="col-sm-9">
                  <input type="text" name="nama_instansi" class="form-control" value="{{ $instansi->ins_nama }}" required>
								</div>
							</div>
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Alamat Instansi</label>
								<div class="col-sm-9">
									<input type="text" name="alamat_instansi" class="form-control" value="{{ $instansi->ins_alamat }}">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="text" name="email_instansi" class="form-control" value="{{ $instansi->ins_email }}">
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama" class="col-sm-3 control-label">Telepon</label>
								<div class="col-sm-9">
									<input type="text" name="telepon_instansi" class="form-control" value="{{ $instansi->ins_telepon }}">
									</select>
								</div>
							</div>
              <div class="form-group">
                <label for="nama" class="col-sm-3 control-label">Unggah Logo</label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-btn">
                      <span class="btn btn-default btn-file btn-flat">
                        Buka Berkas <input type="file" id="imgInp" name="logo" accept="image/png,image/jpg,image/jpeg" />
                      </span>
                    </span>
										<input type="text" class="form-control" readonly name="image2">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="save" class="col-sm-3 control-label">&nbsp</label>
								<input type="hidden" name="ids" value="{{ $instansi->ins_tenant_id }}">
								<div class="col-sm-9">
									<div class="alert alert-danger" id="notif" style="display: none; margin: 0 auto 10px"></div>
									<button type="submit" class="btn btn-flat btn-sm btn-primary" id="save">Simpan</button>
									<button type="reset" class="btn btn-flat btn-sm btn-default" id="reset">Bersihkan</button>
								</div>
							</div>
              <div class="form-group">
                <label for="save" class="col-sm-3 control-label">&nbsp</label>
                <div class="col-sm-9">
                  @if(count($errors) > 0)
                  <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </div>
                  @endif
                  <i>Pratinjau Logo</i>
                  <div class="well" style="min-height: 100px">
                    <img id='img-upload'/>
										<img id='img-exist' src="{{ url('storage/app/'.$instansi->ins_logo) }}" alt="Logo Instansi">
                  </div>
                </div>
              </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title" style="color: coral"><i class="fa fa-info-circle"></i> Informasi</h3>
			</div>
			<div class="box-body">
				<ul>
					<li>Berkas logo yang akan di upload dapat berformat .png, .jpg, dan .jpeg</li>
					<li>Ukuran berkas tidak boleh lebih dari 1024 kb</li>
					<li>Dimensi ukuran gambar logo maksimal tinggi 250px dan maksimal lebar 250px </li>
				</ul>
			</div>
		</div>
	</div>
@endsection
@push('css')
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/timepicker/bootstrap-timepicker.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/AdminLTE-select2.2.4.18.css') }}">
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
	<script src="{{URL::asset('assets/plugins/select2/select2.min.js')}}"></script>
	<script>
    $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });
      $('.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
        log = label;
        if( input.length ) {
          input.val(log);
        } else {
          if( log ) alert(log);
        }
      });
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#img-upload').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#imgInp").change(function(){
        readURL(this);
				$('#img-exist').hide();
				$('#img-upload').show();
      });	
    });
		$('#reset').on('click', function() {
			$('#img-upload').hide();
			$('#img-exist').show();
    });
  </script>
	<script type="text/javascript">
		$('#save').click(function() {
			$('#notif').hide();
			var formdata = $('#form-instansi').serialize();
			$.ajax({
				type: 'POST',
				url: "{{ url('crud/update-instansi') }}",
				data: formdata,
				success: function(data) {
					if (data.success == 1) {
						swal(
							'Berhasil!',
							'Jadwal ujian sudah berhasil diperbarui.',
							'success'
						),
					}else{
						$('#notif').html(data).show();
					}
				}
			})
		});
	</script>
@endpush