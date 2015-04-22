<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class ConsultationsController extends AppController {

    public function home_index() {
        if ($this->Session->read('group.Group.name') === 'bureau admission') {
            //tous les condultations (bureau admission) dans le calenrier
            CakeLog::write('info', "Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté le planning mensuel de l'hôpital");
            $consultations = $this->Consultation->find('all');
            $this->set(compact('consultations'));
        }

        if ($this->Session->read('group.Group.name') == 'docteur') {
            //tous les condultation du docteur
            CakeLog::write('info', "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté son planning mensuel");
            $rdvs = $this->Consultation->find('all', array(
                'conditions' => array('Consultation.user_id' => $this->Auth->user('_id'))
            ));
            $this->set(compact('rdvs'));
        }
    }

    /**
     * 
     * @param int $id
     * @throws Exception
     * @throws NotFoundException
     */
    public function detail_consultation($id = null) {
        $this->layout = null;
        if ($id == null) {
            throw new Exception('Consultation Introuvable', 404);
        }
        $detconsult = $this->Consultation->findById($id);
        if ($this->Session->read('group.Group.name') === "docteur") {
            CakeLog::write('info', "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a affiché les détail de la consultation " . $detconsult['Consultation']['motif']);
        }
        if ($this->Session->read('group.Group.name') === "bureau admission") {
            CakeLog::write('info',"Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a affiché les détail de la consultation " . $detconsult['Consultation']['motif']);
        }
        $patient = $this->Patient->find('first', array(
            'fields' => array('nom', 'prenom'),
            'conditions' => array('Patient.id' => $detconsult['Consultation']['patient_id'])
        ));
        $detuser = $this->User->find('first', array(
            'fields' => array('prenom', 'nom'),
            'conditions' => array('User.id' => $detconsult['Consultation']['user_id'])
        ));
        $chambre = $this->Chambre->find('first', array(
            'fields' => array('numero', 'etage'),
            'conditions' => array('Chambre.id' => $detconsult['Consultation']['chambre_id'])
        ));
        $this->set(compact('detconsult', 'detuser', 'chambre', 'patient'));
        if (!$detconsult) {
            throw new NotFoundException('Impossible de récuperer les details', 404);
        }
    }

    public function home_addAdmission() {
        if ($this->request->is(array('post', 'put'))) {
            //Patient
            $count_p = $this->Patient->find('count');
            $this->request->data['Patient']['reference'] = 'P-' . ($count_p + 1);
            $this->Patient->save($this->request->data['Patient']);
            $patient_id = null;
            if (!empty($this->request->data['Patient']['_id'])) {
                $patient_id = $this->request->data['Patient']['_id'];
            } else {
                $patient_id = $this->Patient->getLastInsertID();
            }

            //facture
            $count_f = $this->Facture->find('count');
            $this->request->data['Facture']['numero'] = 'CF-' . ($count_f + 1);

            //Get Patient_id for Facture/Consultation
            $this->request->data['Facture']['patient_id'] = $patient_id;
            $this->request->data['Consultation']['patient_id'] = $patient_id;

            //Save Facture
            if ($this->Facture->save($this->request->data['Facture'])) {
                CakeLog::write('info', "Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a ajouté un nouveau dossier patient");
                $this->Consultation->save($this->request->data['Consultation']);
                $extension = strtolower(pathinfo($this->request->data['Patient']['avatar_file']['name'], PATHINFO_EXTENSION));
                $filename = strtolower(pathinfo($this->request->data['Patient']['avatar_file']['name'], PATHINFO_BASENAME));
                if (!empty($this->request->data['Patient']['avatar_file']['tmp_name']) && in_array($extension, array('jpg', 'png'))) {
                    move_uploaded_file($this->request->data['Patient']['avatar_file']['tmp_name'], IMAGES . 'avatars' . DS . $filename);
                    $this->Patient->saveField('avatar', $filename);
                }
                $this->Session->setFlash("Le dossier du patient a été crée", 'notif', array('type' => 'success'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash("Echec de l'enregistrement du dossier patient. Répétez l'opération", 'notif', array('type' => 'error'));
                $this->redirect($this->referer());
            }
        }
        die();
    }

}
