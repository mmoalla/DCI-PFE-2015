<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Presence extends AppModel {

    var $useDbConfig = 'default';
    var $primaryKey = '_id';
    var $mongoSchema = array(
        'state' => array('type' => 'boolean'),
        'created' => array('type' => 'datetime'),
        'user_id' => array('type' => 'integer')
    );
    //many to one
    public $belongsTo = array('User' =>
        array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );

}
