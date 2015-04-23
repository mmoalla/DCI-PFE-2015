<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class StocksController extends AppController {

    public function home_index() {
        $medocs = $this->Medicament->find('all');
        foreach ($medocs as $k => $v):
            $stocks = $this->Stock->find('all', array(
                'consitions' => array('Stock.medicament_id' => $medocs[$k]['Medicament']['_id'])
            ));
        endforeach;
        $this->set(compact('stocks', 'medocs'));
    }

    public function home_filter() {
        $listMedocs = $this->Medicament->find('all', array(
            'fields' => array('_id', 'code_pct', 'nom_commercial')
        ));
        $this->set(compact('listMedocs'));
    }

    public function home_ajouter_stock() {
        if ($this->request->is(array('put', 'post'))) {
            $med_id = $this->request->data['Stock']['medicament_id'];
            $stock = $this->Stock->find('first', array(
                'conditions' => array('medicament_id' => $med_id)
            ));
            // POST
            if (empty($stock)) {
                if ($this->Stock->save($this->request->data)) {
                    CakeLog::write('info', "L'administrateur " . $this->Auth->user("prenom") . " " . $this->Auth->user("nom") . " a ajouté des medicaments au stock");
                    $this->Session->setFlash(__('Stock Ajouté'), 'notif', array('type' => 'success'));
                    $this->redirect(array('controller' => 'stocks', 'action' => 'home_index'));
                } else {
                    $this->Session->setFlash(__('Echec de l\'opération'), 'notif', array('type' => 'error'));
                }
            }
            // PUT
            if (!empty($stock)) {
                $this->Stock->id = $stock['Stock']['_id'];
                $qte = $stock['Stock']['stock'] + $this->request->data['Stock']['stock'];
                $stock['Stock']['stock'] = $qte;
                if ($this->Stock->save($stock)) {
                    CakeLog::write('info', "L'administrateur " . $this->Auth->user("prenom") . " " . $this->Auth->user("nom") . " a ajouté des médicaments au stock ");
                    $this->Session->setFlash(__('Stock modifié'), 'notif', array('type' => 'success'));
                    $this->redirect(array('controller' => 'stocks', 'action' => 'home_index'));
                } else {
                    $this->Session->setFlash(__('Echec de l\'opération'), 'notif', array('type' => 'error'));
                }
            }
        }
    }

    /**
     * 
     * @param int $id
     */
    public function home_modifier_stock($id = null) {
        if ($this->request->is('put')) {
            if (!empty($this->request->data)) {
                if ($this->Stock->save($this->request->data)) {
                    CakeLog::write('info', "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a modifié la chambre n° " . $this->request->data['Chambre']['numero']);
                    $this->Session->setFlash(__('Stocks alimenté'), 'notif', array('type' => 'success'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Echec de l\'opération'), 'notif', array('type' => 'error'));
                }
            }
        } else {
            $this->Stock->id = $id;
            $this->request->data = $this->Stock->read();
            $medicaments = $this->Medicament->find('list', array(
                'fields' => array('nom_commercial')
            ));
            $this->set(compact('medicaments'));
        }
    }

}
