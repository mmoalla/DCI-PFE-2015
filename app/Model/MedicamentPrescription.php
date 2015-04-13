<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class MedicamentPrescription extends AppModel {

    public $name = "MedicamentPrescription";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    public $useTable = "medicaments_prescriptions";
    var $mongoSchema = array(
        'medicament_id' => array('type' => 'integer'),
        'posologie' => array('type' => 'text'),
        'duree' => array('type' => 'integer'),
        'prescription_id' => array('type' => 'integer'),
        'created' => array('type' => 'datetime')
    );

}
