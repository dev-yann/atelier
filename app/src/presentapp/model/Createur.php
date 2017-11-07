<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 17:44
 */

namespace presentapp\model;


class Createur extends \Illuminate\Database\Eloquent\Model
{

    protected 	$table		= 'Createur';
    protected 	$primaryKey	= 'id';
    public		$timestamps	= false;

    public function listes(){

        return $this->hasMany('presentapp\model\Liste', 'createur');

    }

}