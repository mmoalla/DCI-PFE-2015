<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class PatientsController extends AppController {

    public $uses = array('Patient');
    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 3,
        'order' => array(
            'Patient._id' => 'DESC'
        ),
        'paramType' => 'querystring'
    );

    public function home_index() {
        if ($this->Session->read('group.Group.name') === "bureau admission") {
            CakeLog::write("info","Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté la liste des employés");
            $this->Paginator->settings = $this->paginate;
            $pts = $this->Paginator->paginate('Patient');
            $this->set('pts', $pts);
        }

        if ($this->Session->read('group.Group.name') === "docteur") {
            CakeLog::write("info","Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté la liste de ses employés");
            $users = $this->User->find('first', array(
                'fields' => array('User.id'),
                'conditions' => array('User.id' => $this->Auth->user('_id'))
            ));
            $consultations = $this->Consultation->find('all', array(
                'fields' => array('Consultation.user_id', 'Consultation.patient_id'),
                'conditions' => array('Consultation.user_id' => $users['User']['_id'])
            ));
            $malades = array();
            for ($i = 0; $i < count($consultations); $i++) {
                $this->Paginator->settings = array(
                    'conditions' => array('Patient.id' => $consultations[$i]['Consultation']['patient_id'])
                );
                array_push($malades, $this->Paginator->paginate('Patient'));
            }
            $malades = current($malades);
            arsort($malades);
            $this->set(compact('malades'));
        }
    }

    public function find_medoc() {
        $medoc = $this->Stock->find('all');
        $this->set(compact('medoc'));
    }

    /**
     * 
     * @param int $id
     */
    public function patient_folder($id = null) {
        $patient = $this->Patient->find('first', array('conditions' => array('Patient.id' => $id)));
        $this->set(compact('patient'));
        if ($this->Session->read('group.Group.name') === "bureau admission") {
            CakeLog::write("info","Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté le dossier du patient " . $patient['Patient']['prenom'] . " " . $patient['Patient']['nom']);
            $consultes = $this->Consultation->find('all', array(
                'conditions' => array(
                    'patient_id' => $id
                ),
                'order' => array('id' => 'DESC')
            ));
            $this->set(compact('consultes'));
            $chbres = array();
            for ($i = 0; $i < count($consultes); $i++) {
                $chambres = $this->Chambre->find('first', array(
                    'fields' => array('id', 'numero', 'etage'),
                    'conditions' => array('Chambre.id' => array('$in' => array($consultes[$i]['Consultation']['chambre_id'])))
                ));
                array_push($chbres, $chambres);
                $doctors = $this->User->find('all', array(
                    'fields' => array('nom', 'prenom'),
                    'conditions' => array('User.id' => array('$in' => array($consultes[$i]['Consultation']['user_id'])))
                ));
                $this->set(compact('doctors'));
            }
            $this->set(compact('chbres'));
        }
        if ($this->Session->read('group.Group.name') === "docteur") {
            $spec = $this->Service->find('first', array(
                'conditions' => array('id' => $this->Session->read('Auth.User.nom.service_id'))
            ));
            $this->set(compact('spec'));
            CakeLog::write("info","Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté le dossier du patient " . $patient['Patient']['prenom'] . " " . $patient['Patient']['nom'] . ".");
            $consults = $this->Consultation->find('all', array(
                'conditions' => array(
                    'patient_id' => $id,
                    'created' => array('$gte' => new MongoDate(time(), 0))
                ),
                'order' => array('id' => 'DESC')
            ));
            $this->set(compact('consults'));
            $antecedants = $this->Consultation->find('all', array(
                'conditions' => array(
                    'patient_id' => $id,
                    "created" => array('$lt' => new MongoDate(time(), 0))
                ),
                'order' => array('id' => 'DESC')
            ));
            $this->set(compact('antecedants'));
            $chbres = array();
            for ($i = 0; $i < count($consults); $i++) {
                $chambres = $this->Chambre->find('first', array(
                    'fields' => array('id', 'numero', 'etage'),
                    'conditions' => array('Chambre.id' => array('$in' => array($consults[$i]['Consultation']['chambre_id'])))
                ));
                array_push($chbres, $chambres);
                $doctors = $this->User->find('all', array(
                    'fields' => array('nom', 'prenom'),
                    'conditions' => array('User.id' => array('$in' => array($consults[$i]['Consultation']['user_id'])))
                ));
                $this->set(compact('doctors'));
            }
            $this->set(compact('chbres'));
        }
        $factures = $this->Facture->find('all', array(
            'consitions' => array('Facture.patient_id' => $id),
            'order' => array('id' => 'DESC')
        ));
        $this->set(compact('factures'));
    }

    /**
     * 
     * @param int $id
     * @throws Exception
     */
    public function home_detail_patient($id = null) {
        if ($id !== null) {
            $this->Patient->id = $id;
            if (!$this->Patient->exists()) {
                throw new Exception("Patient invalide", 403);
            }
        }
        $oldfile = IMAGES . 'avatars' . DS . $this->Patient->field('avatar');
        if ($this->request->is(array('put'))) {
            if (!empty($this->request->data)) {
                $tmp = $this->request->data['Patient']['avatar']['tmp_name'];
                if ($this->Patient->save($this->request->data)) {
                    $extension = explode('.', $this->request->data['Patient']['avatar']['name']);
                    $filename = $extension[0];
                    if (!empty($tmp) && in_array($extension[1], array('jpg', 'png'))) {
                        unlink($oldfile);
                        move_uploaded_file($this->request->data['Patient']['avatar']['tmp_name'], IMAGES . 'avatars' . DS . $filename . '.' . $extension[1]);
                        $this->Patient->saveField('avatar', $filename . '.' . $extension[1]);
                    }
                    CakeLog::write("info","Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a modifié les informations du dossier du patient " . $this->request->data['Patient']['prenom'] . " " . $this->request->data['Patient']['nom']);
                    $this->Session->setFlash(__('Patient modifié'), 'notif', array('type' => 'success'));
                    $this->redirect($this->referer());
                } else {
                    $this->Session->setFlash(__('Echec de l\'opération'), 'notif', array('type' => 'error'));
                }
            }
        } else {
            $this->request->data = $this->Patient->read();
            $detpt = $this->Patient->read();
            $this->set(compact('detpt'));
        }
    }

}
