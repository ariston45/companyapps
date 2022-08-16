@extends('layouts.app')
@section('title', 'Trust CBT - Aplikasi Ujian Berbasis Komputer')
@section('breadcrumb')
  <h1>Dashboard</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Selamat datang</li>
  </ol>
@endsection
@section('logo-mobile')
<span class="mobile-display-logo">
  <a href="{{url('/')}}" class="logo">
    <img src="{{ url('/storage/app/system/image_logo/trustlogo.png') }}" alt="" style="height: 65px;">
  </a>
</span>
@endsection
@section('user-profile')
<img src="{{ url('storage/app/public/userimg.png') }}" class="user-image" alt="User Image">
<span class="hidden-xs">{{ user()->nama_user }}</span>
@endsection
@section('logo')
<span class="display-logo">
  <div class="logo-panel">
    <div class="image custom-logo" style="text-align: center">
      <img src="{{ url('/storage/app/public/company.png') }}">
    </div>
  </div>
</span>
@endsection
@section('sidebar-menu')
<ul class="sidebar-menu">
  <li class="header">Daftar Menu</li>
  @if (user()->id_jenis_user == 'SU')
    @include('menus.su')
  @endif
</ul>
@endsection
@section('content')
<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title aaaa"><i class="fa fa-address-card" aria-hidden="true"></i> Data Kelas</h3>
      <div class="pull-right">
        <button type="button" class="btn btn-flat btn-xs btn-primary" id="btn-create"><i class="fa fa-plus-circle"></i> Buat User</button>
      </div>
    </div>
    <div class="box-body">
      <form class="form-horizontal" id="form-guru">
        <div class="box-body">
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <img src="{{ media('user.png') }}" id="wrap-img" class="img img-thumbnail" style="width: 120px"><br>
            </div>
          </div>
          <div class="form-group">
            <label for="nama" class="col-sm-3 control-label">Unggah Foto</label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-btn">
                  <span id="btn-file-logo" class="btn btn-default btn-file btn-flat">
                    Buka Berkas <input type="file" id="imgInp" name="fotoprofile" accept="image/png,image/jpg,image/jpeg" />
                  </span>
                </span>
                <input type="text" class="form-control" readonly name="image2">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nama" class="col-sm-3 control-label">Nama</label>
            <div class="col-sm-9">
              <input type="hidden" name="id" value="">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="nama" class="col-sm-3 control-label">Username</label>
            <div class="col-sm-9">
              <input type="hidden" name="id" value="">
              <input type="text" class="form-control" id="username" name="username" placeholder="Nama" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Telepon (HP)</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="telepon" name="telepon" placeholder="Nomor telepon" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Whatsapps (WA)</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="telepon" name="telepon" placeholder="Nomor whatsapps" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">PIN</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="pin" name="pin" placeholder="Pin" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Jenis User</label>
            <div class="col-sm-9">
              <select class="form-control" name="jenis_user" id="jenis_user">
                <option value="SU">SUPERUSER</option>
                <option value="DU">DIREKTUR UTAMA</option>
                <option value="DK">DIREKTUR KEUANGAN</option>
                <option value="DP">DIREKTUR PERSONALIA</option>
                <option value="D">DIREKTUR</option>
                <option value="MG">MANAGER</option>
                <option value="ST">STAF</option>
                <option value="AD">ADMIN</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="new-password" required>
                <span class="input-group-btn toggle-password">
                  <button type="button" id="btn-switch-view" class="btn btn-default btn-flat"><i class="fa fa-eye-slash"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Confirm Password</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm Password" autocomplete="new-password" required>
                <span class="input-group-btn toggle-password">
                  <button type="button" id="btn-switch-view" class="btn btn-default btn-flat"><i class="fa fa-eye-slash"></i></button>
                </span>
              </div>
            </div>
          </div>
          
          <div class="form-group" style="margin-top: 15px">
            <div class="col-sm-offset-3 col-sm-9">
              <div class="alert alert-danger" id="notif" style="display: none; margin: 0 auto 5px"></div>
              {{-- <img src="{{ url('/assets/images/facebook.gif') }}" style="display: none;" id="loading"> --}}
              <div id="wrap-btn">
                <button type="button" class="btn btn-flat btn-sm btn-success" id="save">Simpan</button>
                <button type="reset" class="btn btn-flat btn-sm btn-default" >Batal</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="clearfix"></div>
      <table id="tabel_kelas" class="table tabel_custom table-hover table-condensed">
        <thead>
          <tr>
            <th style="width: 10%;">No</th>
            <th style="width: 30%;">kode Kelas</th>
            <th style="width: 30%;">Nama Kelas</th>
            <th style="width: 30%;">Menu Opsi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
@endsection
@push('css')
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css')}}">
  <style>
    .well{
      border-radius: 0px;
    }
		#box-status-ujian{
			padding-top: 5px;
			padding-bottom: 5px;
		}
		#tabel_jadwal {
			border-collapse: collapse;
			width: 100%;
			font-size: 11px;
		}
		#tabel_jadwal td, #tabel_jadwal th {
			padding-top: 3px;
			padding-bottom: 3px;
		}
		#tabel_jadwal tr:nth-child(even){background-color: #f2f2f2;}
		#tabel_jadwal tr:hover {background-color: #ddd;}
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
    $('#btn-create').click(function() {
      $('#form-kelas').slideToggle();
    });
  </script>
  <script>
    $(document).ready( function() {
      $(document).on('change', '#btn-file-logo :file', function() {
        var input = $(this),
          label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
      });
      $('#btn-file-logo :file').on('fileselect', function(event, label) {
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
            $('#wrap-img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#imgInp").change(function(){
        readURL(this);
				$('#img-logo').hide();
				$('#wrap-img').show();
      });	
    });
  </script>
@endpush