@extends('layouts.app')
@section('title', 'Data guru')
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
  <h1>Update Data User</h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="{{ url('/home') }}">Guru</a></li>
    <li class="active">Ubah data guru</li>
  </ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-edit" aria-hidden="true"></i> Update Data User</h3>
      <div class="pull-right">
        <a href="{{ url('instansi/detail-instansi/'.$user->id_tenant) }}">
          <button type="button" class="btn btn-xs btn-flat btn-danger" id="btn-create"><i class="fa fa-times"></i> Tutup</button>
        </a>
      </div>
    </div>
    <div class="box-body">
      <form class="form-horizontal" id="form-user" autocomplete="off">
        <div class="box-body">
          <div class="form-group">
            <label for="nama" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="hidden" name="id" value="{{ $user->id }}">
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ $user->nama }}">
            </div>
          </div>
          <div class="form-group">
            <label for="no_induk" class="col-sm-2 control-label">NIP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="no_induk" name="no_induk" placeholder="NIP" value="{{ $user->no_induk }}">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Telepon (HP)</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="telepon" name="telepon" placeholder="Nomor telepon" value="{{ $user->telepon }}">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" autocomplete="new-password">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password Baru</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password1" placeholder="Password" autocomplete="new-password">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Konfirmasi Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password2" placeholder="Password" autocomplete="new-password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Jenis kelamin</label>
            <div class="col-sm-10">
              <div class="radio">
                <label>
                  <input type="radio" name="jk" id="l" value="L" @if ($user->gender == 'L')
                    checked
                  @endif > Laki-laki
                </label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="jk" id="p" value="P" @if ($user->gender == 'P')
                    checked
                  @endif> Perempuan
                </label>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-top: 15px">
            <label for="kelas" class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">
              <div class="alert alert-danger" id="notif" style="display: none; margin: 0 auto 5px"></div>
              {{-- <img src="{{ url('/assets/images/facebook.gif') }}" style="display: none;" id="loading"> --}}
              <div id="wrap-btn">
                <button type="button" class="btn btn-sm btn-flat btn-success" id="save">Simpan</button>
                <button type="reset" class="btn btn-sm btn-flat btn-default" >Batal</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="{{ url('assets/dist/js/sweetalert2.all.min.js') }}"></script>
<script>
  $(document).ready(function (){
    $("#save").click(function() {
      $("#wrap-btn").show();
      $("#loading").hide();
      var formData = $("#form-user").serialize();
      $.ajax({
        type: "POST",
        url: "{{ url('crud/update-user-tenant') }}",
        data: formData,
        success: function(data){
          $("#loading").hide();
          $("#wrap-btn").show();
          if (data == 1) {
            swal(
              'Berhasil!',
              'Data guru berhasil disimpan.',
              'success'
            )
          }else{
            $('#notif').html(data).show();
          }
        }
      })
    });
  });
</script>
@endpush