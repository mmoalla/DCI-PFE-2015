<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class DCI_Session extends AppModel {

    var $useDbConfig = 'default';
    public $name = "DCI_Session";
    var $primaryKey = '_id';
    var $mongoSchema = array(
        'user_id' => array('type' => 'string'),
        'created' => array('type' => 'datetime')
    );

}
