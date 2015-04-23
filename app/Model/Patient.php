<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Patient extends AppModel {

    public $name = "Patient";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    var $mongoSchema = array(
        'reference' => array('type' => 'string'),
        'nom' => array('type' => 'string'),
        'prenom' => array('type' => 'string'),
        'birthdate' => array('type' => 'date'),
        'sexe' => array('type' => 'string'),
        'nationalite' => array('type' => 'string'),
        'job' => array('type' => 'string'),
        'adresse' => array('type' => 'string'),
        'ville' => array('type' => 'string'),
        'tel' => array('type' => 'integer'),
        'email' => array('type' => 'string'),
        'age' => array('type' => 'integer'),
        'taille' => array('type' => 'float'),
        'poids' => array('type' => 'float'),
        'blood' => array('type' => 'string'),
        'numss' => array('type' => 'integer'),
        'avatar' => array('type' => 'string'),
        'created' => array('type' => 'datetime'),
        'modified' => array('type' => 'datetime')
    );
    public $belongsTo = array('Medicament');
    public $validate = array(
        'tel' => array(
            'rule' => 'isUnique'
        ),
    );

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if (!empty($this->data[$this->alias]['tel']) && !empty($this->data[$this->alias]['age']) && !empty($this->data[$this->alias]['numss']) && !empty($this->data[$this->alias]['taille']) && !empty($this->data[$this->alias]['poids'])) {
            //convertir un string en float 
            $this->data[$this->alias]['taille'] = floatval($this->data[$this->alias]['taille']);
            $this->data[$this->alias]['poids'] = floatval($this->data[$this->alias]['poids']);

            //convertir un string en int
            $this->data[$this->alias]['tel'] = intval($this->data[$this->alias]['tel']);
            $this->data[$this->alias]['age'] = intval($this->data[$this->alias]['age']);
            $this->data[$this->alias]['numss'] = intval($this->data[$this->alias]['numss']);
        }
        return true;
    }

}
