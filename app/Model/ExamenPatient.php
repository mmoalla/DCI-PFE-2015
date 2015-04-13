<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class ExamenPatient extends AppModel {

    public $name = "ExamenPatient";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    public $useTable = "examens_patients";
    var $mongoSchema = array(
        'examen_id' => array('type' => 'integer'),
        'patient_id' => array('type' => 'integer'),
    );

}
