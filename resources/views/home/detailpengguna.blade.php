@php  
  use Carbon\Carbon;
  include(app_path().'/functions/myconf.php');
  $profile = ShowUserProfile();
@endphp
@extends('layouts.app')
@section('title', 'Trust CBT - Aplikasi Ujian Berbasis Komputer')
@section('logo')
<!-- mini logo for sidebar mini 50x50 pixels -->
<span class="logo-mini">
  <img src="{{ url('/storage/image/trustlogo.svg') }}" alt="" style="height: 40px; padding-bottom:1%;">
</span>
<!-- logo for regular state and mobile devices -->
<span class="logo-lg" style="text-align: left">
  <img src="{{ url('/storage/image/trustlogo.svg') }}" alt="" style="height: 40px; padding-bottom:1%;">
  <text style="padding-bottom: 1%">TRUST</text>
</span>
@endsection
@section('breadcrumb')
  <h1>Profil</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Profil</a></li>
    <li class="active">Selamat datang</li>
  </ol>
@endsection
@section('content')
  <div class="row">
		<div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img class="profile-user-img img-responsive img-circle" src="{{ url('/img-user/default-user.png') }}" alt="User profile picture">
					<h5 class="profile-username text-center"></h5>
					<p class="text-muted text-center"></p>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>Email</b><br><a></a>
						</li>
						<li class="list-group-item">
							<b>Telepon</b><br><a></a>
						</li>
					</ul>
					<a href="#" class="btn btn-sm btn-default btn-block"><b>Perbarui Data</b></a>
				</div>
			</div>
		</div>
		<div class="col-md-9">
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
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/timepicker/bootstrap-timepicker.css') }}">
  <style>
    .table-condensed > tbody > tr > td {
      padding: 3px;
    }
    .table-striped > tbody > tr > td {
      padding: 3px;
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
    .tabel_custom tr:nth-child(even){background-color: #f2f2f2;}
    .tabel_custom tr:hover {background-color: #f2f2f2;}
  </style>
@endpush
@push('scripts')
  <script src="{{ url('assets/dist/js/sweetalert2.all.min.js') }}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
  <script type="text/javascript">
    $(function () {
      $(".select2").select2();
      $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true
      });
    });
  </script>
  <script>
    $(".select2").select2();
    $(document).ready(function (){
      $('#btn-tambah-kelas').click(function() {
        $('#box-form-subjek').hide();
        $('#box-form-kelas').slideToggle();
      });
      $('#btn-tambah-grup').click(function() {
        $('#box-form-kelas').hide();
        $('#box-form-grup').slideToggle();
      });
      $('#batal-form-kelas').click(function() {
        $('#box-form-kelas').hide();
      });
    });
    $(document).ready(function (){
      var tabel_kelas = $('#tabel_kelas').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
        ajax: {
					"url" : "{!! route("datatables.source-kelas-pengampu") !!}",
					"type" : "POST",
          "data" : {
            "id" : "{!! $ids !!}"
          }
				},
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama', orderable: true, searchable: true },
          {data: 'kode', name: 'kode', orderable: true, searchable: true },
          
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "drawCallback": function (setting) {
          $('.del-kelas').on('click', function(e) {
            var id = $(this).attr('id');
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
                  url: "{{ url('crud/delete-kelas-pengampu') }}",
                  data: {id:id},
                  success: function(data) {                                                                                                                                                                                                                    
                    swal(
                      'Berhasil!',
                      'Data kelas guru berhasil dihapus.',
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
      $('#save-kelas').click(function() {
        $('#notif').hide();
        var formData = $('#form-kelas').serialize();
        $.ajax({
          type: 'POST',
          url: "{{ url('crud/tambah-kelas-pengampu') }}",
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
  <script>
    $(document).ready(function (){
      grup_siswa = $('#grup_siswa').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
        ajax: {
					"url": "{!! route("datatables.source-grup-siswa") !!}",
					"type" : "POST",
          "data" : {"id":{{ $ids }}}
				},
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama', orderable: true, searchable: true },
          {data: 'jumlah_siswa', name: 'jumlah_siswa', orderable: false, searchable: false },
          {data: 'status', name: 'status', orderable: false, searchable: false },
          {data: 'batas_waktu', name: 'batas_waktu', orderable: false, searchable: false},
          {data: 'menu', name: 'menu', orderable: false, searchable: false},
        ],
        "drawCallback": function (setting) {
          $('.del-siswa').on('click', function() {
            var id = $(this).attr('id');
            var $this = $(this);
            swal({
              title: 'Yakin akan dihapus?',
              text: "Data yang telah dihapus tidak bisa dikembalikan. "+id,
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Iya, hapus.'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  type: 'POST',
                  url: "{{ url('crud/delete-siswa') }}",
                  data: {id:id},
                  success: function(data) {
                    swal(
                        'Berhasil!',
                        'Data siswa berhasil delete.',
                        'success'
                    )
                    grup_siswa.ajax.reload();
                  }
                })
              }
            })
          });
        }
      });
      $('#btn-upload').click(function() {
        $('#form-upload').slideToggle();
      });
    });
  </script>
@endpush