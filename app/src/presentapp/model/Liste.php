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
    public		$timestamps	= true;

    public function createur()
    {
        return $this->belongsTo('tweeterapp\model\Createur', 'createur');
    }

}