<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $uses = array('Consultation', 'User', 'Patient', 'Facture', 'Group', 'Chambre', 'Service',
        'Reclamation', 'Poste', 'Historique', 'Stock', 'Medicament', 'Prescription', 'MedicamentPrescription',
        'Presence', 'Examen', 'DCI_Session');
    public $role = null;
    public $prefix = null;
    public $usr = array();
    public $grp = array();
    public $components = array(
        'RequestHandler',
        //'DebugKit.Toolbar',
        'Session',
        'Auth' => array(
            'authorize' => array('Controller'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login', false)
        )
    );

    /**
     * 
     * @param int $id Verify that the patient exist
     * @throws Exception
     */
    public function verifIdPatient($id = null) {
        if ($id !== null) {
            $this->Patient->id = $id;
            if (!$this->Patient->exists()) {
                throw new Exception(__("Patient Invalide"), 404, null);
            }
        }
    }

    /**
     * 
     * @param string $user
     * @return array
     */
    public function setUser($user = null) {
        $this->usr = $this->User->find('first', array(
            'conditions' => array('User.username' => $user['username']),
            'fields' => array('username', 'group_id')
        ));
        $this->grp = $this->Group->find('first', array(
            'conditions' => array('Group.id' => array('$in' => array($this->usr['User']['group_id'])))
        ));
        $this->usr['Group'] = $this->grp['Group'];

        return $this->usr;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('countNotif', $this->Reclamation->find('count', array('conditions' => array('status' => 0))));
        $this->Auth->allow('login', 'logout');
    }

    /**
     * 
     * @param string $user
     * @return boolean|string
     */
    public function isAuthorized($user = null) {
        $usr = $this->setUser($user);
        $this->role = $usr['Group']['name'];

        if ($this->role === 'administration' || $this->role === 'technique') {
            return 'admin';
        }
        if ($this->role === 'bureau admission' || $this->role === 'docteur' || $this->role === 'pharmacien' || $this->role = 'infirmier') {
            return 'home';
        }
        return false;
    }

    /**
     * 
     * @return string
     */
    public function beforeRender() {
        parent::beforeRender();
        if (!empty($this->params['prefix'])) {
            if ($this->params['controller'] === 'users' && $this->params['action'] === $this->params['prefix'] . '_login') {
                $this->redirect(array('controller' => 'users', 'action' => 'login', $this->params['prefix'] => false));
            }
        }
        if (isset($this->params['prefix']) && $this->params['prefix'] === 'home') {
            return $this->layout = 'home';
        }
        if (isset($this->params['prefix']) && $this->params['prefix'] === 'admin') {
            return $this->layout = 'admin';
        } else {
            return $this->layout = 'default';
        }
    }
    
    /**
     * @see PagesController::search_patient()
     */
    public function search_patient() {
        //Ne pas éffacer
        //Redéfinition de cette action dans le controlleur pages
    }

}
