<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');
App::uses('ExamenPatient', 'Model');
App::uses('Patient', 'Model');

class Examen extends AppModel {

    public $name = "Examen";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    var $mongoSchema = array(
        'nom' => array('type' => 'string'),
        'dosage' => array('type' => 'float'),
        'date' => array('type' => 'date')
    );
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if (!empty($this->data)) {
            //convert from string to float 
            $this->data[$this->alias]['dosage'] = floatval($this->data[$this->alias]['dosage']);
        }
    }
    
    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);
        $pid = $this->data['Examen']['patient_id'];
        $ep = new ExamenPatient();
        $data = array('id' => null, 'patient_id' => $pid, 'examen_id' => $this->data['Examen']['_id']);
        $ep->save($data);
        return true;
    }

    public $hasAndBelongsToMany = array(
        'Patient' => array(
            'className' => 'Patient',
            'joinTable' => 'examens_patients',
            'foreignKey' => 'examen_id',
            'associationForeignKey' => 'patient_id'
        )
    );

}
