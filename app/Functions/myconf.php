<?php
	use App\User;
	// use Carbon\Carbon;
	#Action get data user dan instasi
	function ShowUserProfile()
	{
		$id = Auth::user()->id;
		$profile = User::join('instansis','users.id_tenant','=','instansis.ins_tenant_id')
			->where('users.id',$id)
			->select('ins_nama','nama','profil_img','ins_logo')
			->first();
		return $profile;
	}
	#Action timer
	function actionTimer()
	{
		$now = Carbon::now();
	}
?>