<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class PagesController extends AppController {

    private $user_id = null;
    public $uses = array('Consultation');
    public $components = array('Paginator');
    public $paginate = array(
        'fields' => array('User.nom', 'User.prenom'),
        'paramType' => 'querystring',
        'limit' => 5
    );

    public function index() {
        $this->layout = 'default';
    }

    public function home_home() {
        //Récuperer le role docteur
        $grp = $this->Group->find('first', array(
            'conditions' => array(
                '$and' => array(
                    //condition not in et and 
                    array('name' => array('$nin' => array('administration', 'technique', 'bureau admission', 'infirmier', 'pharmacien')))
                )
            )
        ));
        //liste des docteurs
        $users = $this->User->find('list', array(
            'fields' => array('User.prenom'),
            'conditions' => array('User.group_id' => $grp['Group']['_id'], 'User.status' => '1')
        ));
        $this->set('users', $users);
        //liste des numero de chambres
        $chambres = $this->Chambre->find('list', array(
            'fields' => array('Chambre.numero'),
            'order' => array('Chambre.numero ASC')
        ));
        $this->set('chambres', $chambres);

        //compter les factures pour récuperer leurs numéro et l'incrémenter
        $factures = $this->Facture->field('count');
        $this->set('factures', $factures);

        //compter les patient pour récuperer leurs référence et l'incrémenter
        $countp = $this->Patient->find('count', array(
            'fields' => 'Patient.reference'
        ));
        $this->set('countp', $countp);

        if ($this->Session->read('group.Group.name') === 'bureau admission') {
            //récuperer tous les consultations (bureau admission)
            CakeLog::write("info", "Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté le formulaire d'admission");
            $consult = $this->Consultation->find('all', array(
                'order' => array('Consultation.date', 'Consultation.heure ASC')
            ));
            $this->set('consult', $consult);
        }

        if ($this->Session->read('group.Group.name') === 'docteur') {
            date_default_timezone_set('Africa/Tunis');
            //récuperer tous les consultations du docteur
            CakeLog::write("info", "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté son planning journalier");
            $rdvs = $this->Consultation->find('all', array(
                'conditions' => array(
                    'Consultation.user_id' => $this->Auth->user('_id'),
                    'Consultation.datedebut' => date('Y-m-d')
                ),
                'order' => array('Consultation.datedebut ASC', 'Consultation.heure ASC'),
            ));
            
            $this->set(compact('rdvs'));
            $pts = array();
            $chbs = array();
            foreach ($rdvs as $k => $v):
                //Récuperer le patient de la consultation
                $patient = $this->Patient->find('first', array(
                    'conditions' => array('id' => $rdvs[$k]['Consultation']['patient_id'])
                ));
                //Récuperer la chambre de la consultation
                $chbrs = $this->Chambre->find('first', array(
                    'conditions' => array('id' => $rdvs[$k]['Consultation']['chambre_id'])
                ));
                array_push($pts, $patient);
                array_push($chbs, $chbrs);
            endforeach;
            $pts = current($pts);
            $this->set(compact('pts'));
            $chbs = current($chbs);
            $this->set(compact('chbs'));
        }

        if ($this->Session->read('group.Group.name') === 'pharmacien') {
            $params = array(
                "distinct" => "medicaments",
                "key" => "dci"
            );
            //Récuperer les médicaments par dci
            $dcis = $this->Medicament->query($params);
            $dcis = $dcis['values'];
            //Lister les médicaments
            $pcts = $this->Medicament->find('list');
            $this->set(compact('dcis', 'pcts'));
            $this->set('stocks', $this->Stock->find('all'));
        }
    }

    /**
     *
     * @param string $patient
     */
    public function search_patient($patient = null) {
        parent::search_patient();
        if ($this->Session->read('group.Group.name') === "bureau admission") {
            CakeLog::write("info", "Le responsable des admissions " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a effectué une recherche d'un employé");
        }
        if ($this->Session->read('group.Group.name') === "docteur") {
            CakeLog::write("info", "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a effectué une recherche d'un employé");
        }
        //Récuperer tout les patients
        $patients = $this->Patient->find('all', array(
            'fields' => array('Patient.prenom', 'Patient.nom', 'Patient.avatar'),
            'conditions' => array('Patient.prenom' => new MongoRegex("/$patient/i"))
        ));
        $this->set('patients', $patients);
    }

    /**
     * 
     * @param int $id
     */
    public function search_f_patient($id = null) {
        //Récuperer le dossier patient
        $patient = $this->Patient->find('first', array(
            'conditions' => array('Patient.id' => $id)
        ));
        $this->set('patient', $patient);
    }

    public function admin_home() {
        $this->layout = 'admin';
        if ($this->Session->read('group.Group.name') === "administration") {
            CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a consulté les statistiques ");
        }
        //liste de raclamations non résolue
        $reclamations = $this->Reclamation->find("all", array(
            'order' => array('status' => '0 DESC')
        ));
        $this->set(compact('reclamations'));
        //Pourcentage du personnel par sexe
        $sexecthomme = $this->User->find('count', array(
            'conditions' => array('sexe' => 'Homme'),
            'fields' => array('sexe')
        ));
        $this->set(compact('sexecthomme'));
        $sexectfemme = $this->User->find('count', array(
            'conditions' => array('sexe' => 'Femme'),
            'fields' => array('sexe')
        ));
        $this->set(compact('sexectfemme'));
        $patientct = $this->Patient->find('count', array(
            'fields' => array('sexe')
        ));
        $this->set(compact('patientct'));
        $chambrect = $this->Chambre->find('count');
        $this->set(compact('chambrect'));
    }

    public function stat_benefice() {
        //Récuperer tout les bénéfices de l'hôpital
        $benefices = $this->Facture->find('all', array(
            'fields' => array('montant', 'created'),
            'conditions' => array('aggregate' => array(
                array('$group' => array(
                    '_id' => array('year' => array('$year' => '$created'), 'month' => array('$month' => '$created'), 'day' => array('$dayOfMonth' => '$created')),
                    'montant' => array('$sum' => '$montant')
                ))
            ))
        ));
        $this->set(compact('benefices'));
    }

    /**
     * 
     * @param int $else
     */
    public function admin_all_notif($else = null) {
        $this->set('else', $else);
        if ($else !== null):
            $reclamations = $this->Reclamation->find("all", array(
                'conditions' => array('status' => 0),
                'fields' => array('nom', 'created'),
                'order' => array('id DESC')
            ));
            $this->set(compact('reclamations'));
        else:
            $reclamations = $this->Reclamation->find("all", array(
                'conditions' => array('status' => 0),
                'order' => array('id' => 'DESC')
            ));
            $this->set(compact('reclamations'));
        endif;
    }

    /**
     * 
     * @param int $id
     * @throws NotFoundException
     */
    public function admin_view_reaclamation($id = null) {
        $rec = $this->Reclamation->findById($id);
        if (!$rec) {
            throw new NotFoundException('Réclamation invalide');
        }
        $this->set(compact('rec'));
    }

    /**
     * 
     * @param int $id
     * @return string
     */
    public function admin_update_notif($id = null) {
        if ($this->request->is('ajax')) {
            if ($this->request->is('put')) {
                $this->Reclamation->id = $id;
                $this->Reclamation->saveField('status', 1);
                return 'success';
            }
        }
        return 'error';
    }

    public function home_reclamation() {
        $user_id = $this->Auth->user('_id');
        if ($this->request->is('post')) {
            $this->Reclamation->create();
            if ($this->Reclamation->save($this->request->data)) {
                CakeLog::write("info", "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a envoyé une réclamation intitulé " . $this->request->data['Reclamation']['nom']);
                $this->Reclamation->saveField('user_id', $user_id);
                $this->Session->setFlash('Votre réclamation à été transmise au technicien', 'notif', array('type' => 'success'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash('Votre réclamation n\'a pas aboutie', 'notif', array('type' => 'error'));
                $this->redirect($this->referer());
            }
        }
    }

    public function admin_list_trace() {
        CakeLog::write("info", "L'administrateur a consulté toutes les activités des utilisateurs.");
    }

    public function admin_presence() {
        CakeLog::write("info", "L'administrateur a consulté la liste des absences");
        $doc = $this->User->find('all', array(
            'fields' => array('nom', 'prenom')
        ));
        foreach ($doc as $key => $val):
            $presence = $this->Presence->find('first', array(
                'conditions' => array(
                    'user_id' => $doc[$key]['User']['_id']
                )
            ));
            if (!empty($presence)) {
                $this->user_id = $presence['Presence']['user_id'];
            }
            $doc[$key]['Presence'] = $presence;
        endforeach;
        $this->set(compact('doc'));
    }
    
    public function admin_hist_presence(){
        $presences = $this->Presence->find('all');
        
        foreach ($presences as $k => $pres):
            $users = $this->User->find('first', array(
            'fields' => array('nom', 'prenom'),
            'conditions' => array('id' => $pres['Presence']['user_id'])
        ));
        $presences[$k]['User'] = $users;
        endforeach;
        
        $this->set(compact('presences'));
    }

    public function admin_add_presence() {
        if ($this->request->is('ajax')) {
            $this->user_id = $this->request->data['Presence']['user_id'];
            if ($this->Presence->save($this->request->data)) {
                CakeLog::write("info", "L'administrateur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " a fait la présence.");
                echo json_encode($this->request->data);
                $message = 'success';
            } else {
                $message = 'Error';
            }
        }
        $this->set(compact('message'));
    }

}
