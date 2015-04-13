<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Reclamation extends AppModel {

    var $useDbConfig = 'default';
    var $primaryKey = '_id';
    var $mongoSchema = array(
        'nom' => array('type' => 'string'),
        'status' => array('type' => 'boolean', 'default' => 0),
        'user_id' => array('type' => 'integer'),
        'created' => array('type' => 'datetime'),
    );
    //many to one
    public $belongsTo = array('User');

}
