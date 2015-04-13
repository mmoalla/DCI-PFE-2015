<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Consultation extends AppModel {

    var $useDbConfig = 'default';
    public $name = "Consultation";
    var $primaryKey = '_id';
    var $mongoSchema = array(
        'motif' => array('type' => 'string'),
        'detail' => array('type' => 'text'),
        'datedebut' => array('type' => 'date'),
        'datefin' => array('type' => 'date'),
        'heure' => array('type' => 'time'),
        'remarque' => array('type' => 'string'),
        'user_id' => array('type' => 'integer'),
        'chambre_id' => array('type' => 'integer'),
        'patient_id' => array('type' => 'integer'),
        'created' => array('type' => 'datetime'),
        'modified' => array('type' => 'datetime')
    );
    //one to many
    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
    //many to one
    public $belongsTo = array('Patient');
    //one to one
    public $hasOne = array(
        'Chambre' => array(
            'className' => 'Chambre',
            'foreignKey' => 'chambre_id'
        )
    );

}
