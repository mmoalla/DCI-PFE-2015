<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class PrescriptionsController extends AppController {

    public function home_add() {
        if ($this->request->is(array('ajax'))) {
            $this->layout = false;
            $message = '';
            if ($this->Prescription->save($this->request->data)) {
                CakeLog::write('info', "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a préscrit des médicaments.");
                $message = 'success';
            } else {
                $message = 'error';
            }
            $this->set(compact('message'));
        }
    }

    /**
     * 
     * @param int $id
     * @param int $limit
     */
    public function home_ordonnance_patient($id = null, $limit = null) {
        $this->verifIdPatient($id);
        $query = null;
        $query = $this->Patient->find('first', array(
            'conditions' => array('id' => $id)
        ));
        $presc = array();
        if ($limit == 1) {
            $medocs = $this->Prescription->find('all', array(
                'conditions' => array('patient_id' => $query['Patient']['_id']),
                'limit' => 3
            ));
        }
        if ($limit == 0) {
            $medocs = $this->Prescription->find('all', array(
                'conditions' => array('patient_id' => $query['Patient']['_id'])
            ));
        }
        //$query['Ordonnance'] = $medocs;
        //$medocs = $this->Prescription->find('all');
        $this->set(compact('medocs'));
    }

}
