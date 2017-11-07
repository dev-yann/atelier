<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/11/17
 * Time: 17:44
 */

namespace presentapp\model;


class Item extends \Illuminate\Database\Eloquent\Model
{

    protected 	$table		= 'Item';
    protected 	$primaryKey	= 'id';
    public		$timestamps	= false;

    
    public function liste_item(){

        return $this->belongsTo('presentapp\model\ListeItem', 'id');

    }
}