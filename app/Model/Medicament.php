<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppModel', 'Model');

class Medicament extends AppModel {

    public $name = "Medicament";
    var $primaryKey = '_id';
    var $useDbConfig = 'default';
    public $displayField = 'code_pct';
    var $mongoSchema = array(
        'code_pct' => array('type' => 'int'),
        'nom_commercial' => array('type' => 'string'),
        'prix_public' => array('type' => 'float'),
        'tarif_reference' => array('type' => 'float'),
        'categorie' => array('type' => 'string'),
        'dci' => array('type' => 'string'),
        'date_peremption' => array('type' => 'string')
    );

}
