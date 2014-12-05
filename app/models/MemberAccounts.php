<?php


class MemberAccounts extends Eloquent {

    protected $table = 'member_account';

    public static function signin($userid,$password)
    {
    	$check = MemberAccounts::where('user_name',$userid)
			    				->where('password',$password)
			    				->get();
		if(count($check)) return $check;
		$check = MemberAccounts::where('email',$userid)
			    				->where('password',$password)
			    				->get();   	
		return $check;			
    }
}