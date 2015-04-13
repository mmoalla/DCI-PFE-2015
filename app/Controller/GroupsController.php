<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class GroupsController extends AppController {

    public $uses = array('Group');

    public function admin_index() {
        //Ne pas éffacer
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__("le medecin à été enregistré"), 'notif', array('type' => 'success'));
            } else {
                $this->Session->setFlash("Le medecin n'a pas été enregistrer. SVP répéter cette opération ou contacter l'aministrateur.", 'notif', array('type' => 'error'));
            }
        }
        $this->redirect($this->referer());
        die();
    }

}
