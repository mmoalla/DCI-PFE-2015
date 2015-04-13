<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Service extends AppModel {

    public $name = 'Service';
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    public $displayField = 'nom';
    var $mongoSchema = array(
        'nom' => array('type' => 'string')
    );

}
