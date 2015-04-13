<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Chambre extends AppModel {

    public $name = "Chambre";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    var $mongoSchema = array(
        'numero' => array('type' => 'integer'),
        'nbrlit' => array('type' => 'integer')
    );
    public $validate = array(
        'numero' => array(
            'rule' => 'isUnique',
            'allowEmpty' => false,
            'message' => 'Le numéro de chambre existe déja'
        )
    );

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);
        //create Gespatial Index
        $mongo = $this->getDataSource();
        $mongo->ensureIndex($this, array('numero' => "2d"));
        return true;
    }

}
