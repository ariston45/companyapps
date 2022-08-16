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
@endpush