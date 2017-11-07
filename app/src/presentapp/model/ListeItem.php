<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 07/11/17
 * Time: 14:40
 */

namespace presentapp\model;


class ListeItem extends \Illuminate\Database\Eloquent\Model
{

    public function items(){

        return $this->hasMany('presentapp\model\Item', 'id');

    }

}