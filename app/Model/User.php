<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $useTable = 'users';
    public $name = "User";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    var $mongoSchema = array(
        'username' => array('type' => 'string'),
        'password' => array('type' => 'string'),
        'nom' => array('type' => 'string'),
        'prenom' => array('type' => 'string'),
        'birthdate' => array('type' => 'date'),
        'phone' => array('type' => 'integer'),
        'email' => array('type' => 'string'),
        'adresse' => array('type' => 'string'),
        'sexe' => array('type' => 'string'),
        'formation' => array('type' => 'text'),
        'status' => array('type' => 'boolean'),
        'titulaire' => array('type' => 'boolean'),
        'group_id' => array('type' => 'integer'),
        'service_id' => array('type' => 'integer'),
        'poste_id' => array('type' => 'integer'),
        'created' => array('type' => 'datetime'),
        'modified' => array('type' => 'datetime')
    );
    public $validate = array(
        'email' => array(
            'rule' => 'isUnique',
            'required' => true
        ),
        'phone' => array(
            'rule' => 'isUnique',
            'required' => true
        )
    );

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if (!empty($this->data)) {
            //convert from string to int 
            $this->data[$this->alias]['phone'] = intval($this->data[$this->alias]['phone']);
        }

        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    public $hasMany = array(
        'Presence' => array(
            'className' => 'Presence',
            'foreignKey' => 'user_id'
        )
    );
    public $belongsTo = array(
        'Group',
        'Service' => array(
            'className' => 'Service',
            'foreignKey' => 'service_id'
        ),
        'Poste' => array(
            'className' => 'Poste',
            'foreignKey' => 'poste_id'
        )
    );

}
