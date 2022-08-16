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
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subskripsi Sistem</h3>
        <div class="pull-right">
          <a href="{{ route('subskripsi.tambah-subskripsi-sistem') }}">
            <button type="button" class="btn btn-xs btn-flat btn-primary" id="btn-create"><i class="fa fa-plus-circle"></i> Tambah Subskrisi</button>
          </a>
        </div>
      </div>
      <div class="box-body">
        <table class="table tabel_custom table-hover table-striped" id="tabel_subskripsi">
          <thead>
            <tr>
              <th style="width: 5%">No.</th>
              <th style="width: 25%">Nama Subkripsi</th>
              <th style="width: 25%">Jenis Pemabayaran</th>
              <th style="width: 20%">Menu</th>
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
		.tabel_custom tr:nth-child(even) {background-color: #f2f2f2;}
		.tabel_custom tr:hover {background-color: #ddd;}
	</style>
@endpush
@push('scripts')
  <script src="{{ url('assets/dist/js/sweetalert2.all.min.js') }}"></script>
  <script src="{{URL::asset('assets/plugins/select2/select2.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>
  <script>
    $(document).ready(function (){
      // datatables kelas
      var tabel_subskripsi = $('#tabel_subskripsi').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
        ajax: {
					"url" : "{!! route('datatables.source-subskripsi-sistem') !!}",
					"type" : "POST",
				},
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'kls_kode', orderable: true, searchable: true },
          {data: 'jenis_pembayaran', name: 'jenis_pembayaran', orderable: true, searchable: true },
          {data: 'menu', name: 'menu', orderable: false, searchable: false},
        ],
        "drawCallback": function (setting) {
          $('.del-kelas').on('click', function(e) {
            var id = $(this).data('id');
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
                  type: "POST",
                  url: "{{ url('crud/delete-subskripsi') }}",
                  data: {id:id},
                  success: function(data) {                                                                                                                                                                                                                     
                    swal(
                      'Berhasil!',
                      'Data subskripsi berhasil dihapus.',
                      'success'
                    )
                    tabel_subskripsi.ajax.reload();
                  }
                })
              }
            })
        });
      }
    });
      // get form membuat kelas
      $('#btn-create').click(function() {
        $('#form-kelas').slideToggle();
      });
      // action simpan kelas
      $('#save').click(function() {
        $('#notif').hide();
        var formData = $('#form-kelas').serialize();
        $.ajax({
          type: 'POST',
          url: "{{ url('crud/create-kelas') }}",
          data: formData,
          success: function(data) {
            if (data == 1) {
              swal(
                'Berhasil!',
                'Data kelas berhasil disimpan.',
                'success'
              )
              tabel_kelas.ajax.reload();
            }else{
              $('#notif').html(data).show();
            }
          }
        })
      });
    });
  </script>
@endpush