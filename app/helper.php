<?php

use Illuminate\Support\Facades\Auth;

#source media
function media($filename)
{
	$url = url('storage/app/public/'.$filename);
	return $url;
}
#status user
function user()
{
	$user = Auth::user();
	return $user;
}
