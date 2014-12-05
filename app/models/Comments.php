<?php


class Comments extends Eloquent {

    protected $table = 'comment';

    public function memberAccount()
	{
		return $this->belongsTo('MemberAccounts', "user_id", "id");
	}

	public function memberAction()
    {
        return $this->hasMany('MemberActions', 'comment_id', 'id');
    }
}