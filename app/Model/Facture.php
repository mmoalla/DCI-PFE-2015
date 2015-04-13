<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Facture extends AppModel {

    public $name = "Facture";
    var $useDbConfig = 'default';
    var $mongoSchema = array(
        '_id' => array('type' => 'integer', 'primary' => true),
        'numero' => array('type' => 'string'),
        'montant' => array('type' => 'float'),
        'designation' => array('type' => 'string'),
        'tva' => array('type' => 'float'),
        'timbre' => array('type' => 'float'),
        'totalttc' => array('type' => 'float'),
        'acompte' => array('type' => 'float'),
        'typepaiement' => array('type' => 'string'),
        'numcarte' => array('type' => 'integer'),
        'expiration' => array('type' => 'date'),
        'cryptogramme' => array('type' => 'integer'),
        'devise' => array('type' => 'string'),
        'numcheque' => array('type' => 'integer'),
        'patient_id' => array('type' => 'integer'),
        'created' => array('type' => 'datetime')
    );
    public $validate = array(
        'numero' => array(
            'rule' => 'isUnique',
            'message' => 'Le numéro de facture existe déja'
        ),
        'avatar_file' => array(
            'rule' => array('fileExtension', array('png', 'jpg')),
            'message' => 'Vous ne pouver envoyer que des jpg et png'
        )
    );
    //many to one
    public $belongsTo = array('Patient');

}
