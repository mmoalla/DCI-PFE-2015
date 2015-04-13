<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Poste extends AppModel {

    public $name = "Poste";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    public $displayField = 'nom';
    var $mongoSchema = array(
        'nom' => array('type' => 'string'),
        'salaire' => array('type' => 'float'),
        'etat' => array('type' => 'boolean')
    );

}
