<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class ChambresController extends AppController {

    public function admin_index() {
        if ($this->Session->read('group.Group.name') === "administration") {
            CakeLog::write('info', "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté la liste des chambres.");
        }
        $chambres = $this->Chambre->find('all', array(
            'order' => array('Chambre.numero' => 'ASC')
        ));
        $this->set('chambres', $chambres);
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Chambre->set($this->request->data);
            $this->Chambre->create();
            if ($this->Chambre->save($this->request->data)) {
                CakeLog::write('info', "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a ajouté une nouvelle chambre.");
                $this->Session->setFlash("La chambre a été enregistrée", 'notif', array('type' => 'success'));
            } else {
                $this->Session->setFlash("Une erreur s'est produite. Réesayer", 'notif', array('type' => 'error'));
            }
        }
        $this->redirect($this->referer());
        die();
    }

    /**
     * 
     * @param int $id
     */
    public function admin_edit($id = null) {
        if ($this->request->is('put')) {
            if (!empty($this->request->data)) {
                if ($this->Chambre->save($this->request->data)) {
                    CakeLog::write('info', "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a modifié la chambre n° " . $this->request->data['Chambre']['numero'] . '.');
                    $this->Session->setFlash(__('Chambre modifié'), 'notif', array('type' => 'success'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Echec de l\'opération'), 'notif', array('type' => 'error'));
                }
            }
        } else {
            $this->Chambre->id = $id;
            $this->request->data = $this->Chambre->read();
        }
    }

    /**
     * 
     * @param int $id
     * @return string
     */
    public function admin_delete($id = null) {
        $this->layout = false;
        $this->Chambre->id = $id;
        if (!$this->Chambre->id) {
            $this->Session->setFlash(__('La chambre est introuvable', 'notif', array('type' => 'error')));
        }
        if ($this->Chambre->delete()) {
            CakeLog::write('info', "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a supprimé une chambre.");
            $this->Session->setFlash(__('Chambre supprimé'), 'notif', array('type' => 'success'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('La chambre n\'a pas été supprimé', 'notif', array('type' => 'error')));
        return $this->redirect(array('action' => 'index'));
    }

}
