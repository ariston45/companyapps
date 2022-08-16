<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;
use Hash;
use Redirect;
use Session;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function viewDataUser()
	{
		return view('home.view_datauser');
	}
	public function sourceDataUser(Request $request)
	{
		$status = Auth::user()->status;
		$data_user = User::whereIn('status',['G','TSA'])->get();
		switch ($status) {
			case 'SA':
				$tenant = Auth::user()->id_tenant;
				// $tenant_session = Session::get('idtenantsession');
				$user = $data_user->where('id_tenant',$request->tenant);
				return Datatables::of($user)
				->addIndexColumn()
				->addColumn('empty_str', function ($user) {
					return '';
				})
				->addColumn('action', function ($user) {
					return ' <div>
					<div class="btn-group">
						<button class="btn btn-success btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Menu <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="'.url('instansi/perbarui-pengguna/').'/'.$user->id.'"><i class="fa fa-pencil" aria-hidden="true"></i> Perbarui</a></li>
							<li role="separator" class="divider" style="margin-top: 0px;margin-bottom: 0px;"></li>
							<li><a href="#" class="del-siswa" id="'.$user->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a></li>
						</ul>
					</div></div>';
				})
				->addColumn('nama', function ($user) {
					return $user->nama;
				})
				->addColumn('email', function ($user) {
					return $user->email;
				})
				->addColumn('telepon', function ($user) {
					return $user->telepon;
				})
				->addColumn('status', function ($user) {
					if ($user->status == 'TSA') {
						$res = 'Super Admin';
					}elseif ($user->status == 'G') {
						$res = 'Guru';
					}else{
						$res = 'n/a';
					}
					return $res;
				})
				->rawColumns(['action', 'nama', 'email','telepon','status'])
				->make(true);
				break;
			
			default:
				# code...
				break;
		}
	}
}
