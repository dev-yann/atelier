<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 09/11/17
 * Time: 17:21
 */

namespace presentapp\model;


class Message extends \Illuminate\Database\Eloquent\Model
{

    protected 	$table		= 'message';
    protected 	$primaryKey	= 'id';
    public		$timestamps	= false;


    public function liste(){

        return $this->belongsTo('presentapp\model\Liste', 'id_list');

    }
}