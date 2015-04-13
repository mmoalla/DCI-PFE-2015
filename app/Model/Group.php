<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Group extends AppModel {

    public $name = 'Group';
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    var $mongoSchema = array(
        '_id' => array('type' => 'integer', 'primary' => true),
        'name' => array('type' => 'string')
    );

}
