<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public function admin_index() {
        if ($this->Session->read('group.Group.name') === "administration") {
            CakeLog::write('info', "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté la liste des employés");
        }
        //tout les utilisateurs limité a 1 enregistrement
        $users = $this->User->find("all");
        $this->set('users', $users);

        //liste des groupes dans le select
        $groups = $this->Group->find('list');
        $this->set('groups', $groups);
        //liste des services dans le select
        $services = $this->Service->find('list', array(
            'fields' => array('nom')
        ));
        $this->set('services', $services);
        //liste des postes dans le select
        $postes = $this->Poste->find('list', array(
            'fields' => array('nom')
        ));
        $this->set('postes', $postes);
    }

    public function admin_add() {
        if ($this->request->is('ajax')) {
            //init Var
            $message = '';
            $data = $this->request->data;
            $this->User->Behaviors->attach('mongodb.SqlCompatible');
            if ($this->User->save($data)) {
                CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a ajouté un nouvel employé");
                $message = 'success';
            } else {
                $message = 'error';
            }
        }
        $this->set(compact('message'));
    }

    /**
     * 
     * @param int $id
     */
    public function admin_edit($id = null) {
        if ($this->request->is('put')) {
            if (!empty($this->request->data)) {
                if ($this->User->save($this->request->data)) {
                    CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a modifié l'employé " . $this->request->data['User']['prenom'] . " " . $this->request->data['User']['nom']);
                    $message = 'Saved';
                    $this->Session->setFlash(__('Employé modifié'), 'notif', array('type' => 'success'));
                    $this->redirect("http://localhost/DCI/admin/grh");
                } else {
                    $message = 'Error';
                    $this->Session->setFlash(__('Echec de l\'opération'), 'notif', array('type' => 'error'));
                }
                $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                ));
            }
        } else {
            $this->User->id = $id;
            $this->request->data = $this->User->read();
            $services = $this->Service->find('list');
            $groups = $this->Group->find('list');
            $postes = $this->Poste->find('list');
            $this->set(compact('services', 'groups', 'postes'));
        }
    }

    /**
     * 
     * @param int $id
     * @throws NotFoundException
     */
    public function admin_view($id = null) {
        $user = $this->User->findById($id);
        CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté les informations de l'emplyé " . $user['User']['prenom'] . " " . $user['User']['nom']);
        $service = $this->Service->find('first', array(
            'conditions' => array('id' => $user['User']['service_id'])
        ));
        $poste = $this->Poste->find('first', array(
            'conditions' => array('id' => $user['User']['poste_id'])
        ));
        $group = $this->Group->find('first', array(
            'conditions' => array('id' => $user['User']['group_id'])
        ));
        if (!$user) {
            throw new NotFoundException('Employé inexistant');
        }
        $this->set(compact('user', 'service', 'poste', 'group'));
    }

    /**
     * 
     * @param int $id
     * @return string
     */
    public function admin_delete($id = null) {
        $this->layout = false;
        $this->User->id = $id;
        if (!$this->User->id) {
            $this->Session->setFlash(__('L\'employé est introuvable', 'notif', array('type' => 'error')));
        }
        if ($this->User->delete()) {
            CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a supprimé un employé");
            $this->Session->setFlash(__('Employé supprimé'), 'notif', array('type' => 'success'));
            return $this->redirect(array('action' => 'admin_index'));
        }
        $this->Session->setFlash(__('L\'employé n\'a pas été supprimé', 'notif', array('type' => 'error')));
        return $this->redirect(array('action' => 'admin_index'));
    }

    /**
     * 
     * @param int $id
     */
    public function admin_fiche_paie($id = null) {
        $user = $this->User->findById($id);
        CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté la fiche de paie de l'employé " . $user['User']['prenom'] . " " . $user['User']['nom'] . '.');
        $group = $this->Group->find('first', array(
            'conditions' => array('id' => $user['User']['group_id'])
        ));
        $poste = $this->Poste->find('first', array(
            'conditions' => array('id' => $user['User']['poste_id'])
        ));
        $this->set(compact('user', 'group', 'poste'));
    }

    public function admin_paie() {
        CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté les salaires des employés.");
        $userpaie = $this->User->find('all', array(
            'fields' => array('prenom', 'nom', 'poste_id'),
            'conditions' => array('User.poste_id' => array('$ne' => ''))
        ));
        $this->set(compact('userpaie'));
        //debug($userpaie);
        foreach ($userpaie as $key => $value) {
            $postepaie = $this->Poste->find('all', array(
                'conditions' => array('Poste.id' => $userpaie[$key]['User']['poste_id'])
            ));
            $this->set(compact('postepaie'));
        }
    }

    public function nbr_connecter() {
        echo json_encode($this->DCI_Session->find('count'));
        die();
    }

    public function admin_list_connecter() {
        $dci_session = $this->DCI_Session->find('all');
        $listConnecter = array();
        foreach ($dci_session as $k => $v):
            $user = $this->User->find('first', array(
                'conditions' => array('id' => $dci_session[$k]['DCI_Session']['user_id']),
                'fields' => array('nom', 'prenom')
            ));
            $user['User']['time_login'] = $dci_session[$k]['DCI_Session']['created'];
            $listConnecter[$k] = $user;
        endforeach;
        $session['dciSession'] = $listConnecter;
        $this->set(compact('session'));
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $prefix = $this->isAuthorized(current($this->request->data));
                $this->Session->write('prefix', $prefix);
                $this->Session->write('group', $this->grp);
                //$this->DCI_Session->save(array('user_id' => $this->Auth->user('_id')));
                if ($this->Session->read('group.Group.name') === "administration") {
                    CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est connecté.");
                } elseif ($this->Session->read('group.Group.name') === "technique") {
                    CakeLog::write("info", "Le Technicien " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est connecté.");
                } elseif ($this->Session->read('group.Group.name') === "docteur") {
                    CakeLog::write("info", "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est connecté.");
                } elseif ($this->Session->read('group.Group.name') === "bureau admission") {
                    CakeLog::write("info", "Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est connecté.");
                }
                $this->Session->setFlash(__("Vous êtes connecté"), 'notif', array('type' => 'success'));
                $this->redirect(array('controller' => 'pages', 'action' => 'home', $prefix => true));
            } else {
                $this->Session->setFlash(__("Oupps ! nom d'utilisateur ou mot de passe invalide, réessayer"), 'notif', array('type' => 'error'));
            }
        }
    }

    public function logout() {
        if ($this->Session->read('group.Group.name') === "administration") {
            CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est déconnecté.");
        } elseif ($this->Session->read('group.Group.name') === "technique") {
            CakeLog::write("info", "Le Technicien " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est déconnecté.");
        } elseif ($this->Session->read('group.Group.name') === "docteur") {
            CakeLog::write("info", "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est déconnecté.");
        } elseif ($this->Session->read('group.Group.name') === "bureau admission") {
            CakeLog::write("info", "Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " s'est déconnecté.");
        }
        $id = $this->Auth->user('_id');
        //$session = $this->DCI_Session->find('first', array('conditions' => array('DCI_Session.user_id' => $id)));
        if (!empty($id)) {
            //$this->DCI_Session->delete($session['DCI_Session']['_id']);
        }
        $this->Auth->logout();
        $this->Session->destroy();
        $this->redirect(array('controller' => 'users', 'action' => 'login', $this->Session->read('prefix') => FALSE));
    }

}
