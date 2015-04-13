<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('Model', 'Model');

class AppModel extends Model {

    public $actsAs = array('mongodb.SqlCompatible', 'containable');

}
