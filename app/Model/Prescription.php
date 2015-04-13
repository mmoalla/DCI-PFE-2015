<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');
App::uses('MedicamentPrescription', 'Model');
App::uses('Medicament', 'Model');
App::uses('Patient', 'Model');
App::uses('Stock', 'Model');

class Prescription extends AppModel {

    public $actsAs = array('Containable');
    public $name = "Prescription";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    var $mongoSchema = array(
        'patient_id' => array('type' => 'integer'),
        'user_id' => array('type' => 'integer'),
        'created' => array('type' => 'datetime')
    );
    //many to one
    public $belongsTo = array('Patient', 'User');
    //many to many
    public $hasAndBelongsToMany = array(
        'Medicament' => array(
            'className' => 'Medicament',
            'joinTable' => 'medicaments_prescriptions',
            'foreignKey' => 'prescription_id',
            'associationForeignKey' => 'medicament_id')
    );

    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);
        //remplace containable 
        $mp = new MedicamentPrescription();
        $md = new Medicament();
        $pt = new Patient();
        $pids = $pt->find('all', array(
            'fields' => array('_id')
        ));
        foreach ($results as $k => $result):
            $allMedoc = $mp->find('all', array(
                'conditions' => array('prescription_id' => $result['Prescription']['_id']),
                'group' => array('created')
            ));
            $result['Medicament'] = $allMedoc;
            foreach ($result['Medicament'] as $kk => $vv):
                $mid = $vv['MedicamentPrescription']['medicament_id'];
                $md->id = $mid;
                $mname = $md->field('nom_commercial');
                $vv['nom_commercial'] = $mname;
                $result['Medicament'][$kk] = $vv;
            endforeach;
            $results[$k] = $result;
        endforeach;
        return $results;
    }

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);
        $mp = new MedicamentPrescription();
        $stk = new Stock();
        $pid = $this->data['Prescription']['_id'];
        $medocs = $this->data['MedicamentPrescription'];
        foreach ($medocs as $k => $m):
            $m['prescription_id'] = $pid;
            $mp->create();
            $mp->save($m);
            $stock = $stk->find('first', array(
                'conditions' => array('Stock.medicament_id' => $m['medicament_id'])
            ));
            $stk->id = $stock['Stock']['_id'];
            $stock_count = $stock['Stock']['stock'] - 1;
            $stk->saveField('stock', $stock_count);
        endforeach;
        return $this->data;
    }

}
