<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

use App\User;
use App\Models\Program;
use App\Http\Controllers\SiswaController;
use App\Models\Grup_siswa;
use App\Models\Jadwal_ujian;
use App\Models\Subjek_studi;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	#
	public function index()
	{
		return redirect('/home');
	}
	#
	public function home()
	{
		return view('home.home');
	}
}
