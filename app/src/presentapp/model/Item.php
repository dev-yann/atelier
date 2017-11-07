<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 07/11/17
 * Time: 14:39
 */

namespace presentapp\model;


class Item extends \Illuminate\Database\Eloquent\Model
{

    public function liste_item(){

        return $this->belongsTo('presentapp\model\ListeItem', 'id');

    }
}