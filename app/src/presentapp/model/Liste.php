<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 17:50
 */

namespace presentapp\model;


class Liste extends \Illuminate\Database\Eloquent\Model
{

    protected 	$table		= 'Liste';
    protected 	$primaryKey	= 'id';
    public		$timestamps	= false;

    public function createur()
    {
        return $this->belongsTo('tweeterapp\model\Createur', 'createur');
    }

    public function items(){

        return $this->hasMany('presentapp\model\Item', 'id_list');
    }

    public function messages(){

        return $this->hasMany('presentapp\model\Message','id_list');
    }

}