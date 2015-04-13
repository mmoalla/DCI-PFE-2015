<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');
App::uses('Medicament', 'Model');

class Stock extends AppModel {

    public $name = "Stock";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    public $displayField = 'produit';
    var $mongoSchema = array(
        'stock' => array('float'),
        'last_unit_price' => array('float'),
        'medicament_id' => array('type' => 'integer')
    );
    public $belongsTo = array(
        'Medicament' => array(
            'className' => 'Medicament',
            'foreignKey' => 'medicament_id'
    ));

    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        $medoc = new Medicament();
        $m = $medoc->find('first', array(
            'conditions' => array('Medicament.id' => $this->data['Stock']['medicament_id'])
        ));
        $this->data['Stock']['last_unit_price'] = $m['Medicament']['prix_public'];
        return $this->data;
    }

    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);
        foreach ($results as $k => $result):
            $medoc = new Medicament();
            $m = $medoc->find('first', array(
                'conditions' => array('id' => $result['Stock']['medicament_id'])
            ));
            $results[$k]['Medicament'] = $m['Medicament'];
        endforeach;
        return $results;
    }

}
