<?php


class Images extends Eloquent {

    protected $table = 'image';

    public function memberAction()
    {
        return $this->hasMany('MemberActions', 'image_id', 'id');
    }

}