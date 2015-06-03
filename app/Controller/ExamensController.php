<?php

/**
 * 
 * @author Mehdi Moalla <mehdimoalla2010@gmail.com>
 * @version 1.0.0
 * @copyright (c) 2015, DCI
 */
App::uses('AppController', 'Controller');

class ExamensController extends AppController {

    public function home_index() {
        //$examens = $this->Examen->find('all');
        $examens = $this->Examen->find('all');
        $this->set(compact('examens'));
    }

    public function home_add() {
        if ($this->request->is('ajax')) {
            //init Var
            $message = '';
            $data = $this->request->data;
            if ($this->Examen->save($data)) {
                CakeLog::write('info', "Le docteur " . $this->Auth->user('prenom') . ' ' . $this->Auth->user('nom') . " consulté les antécédants du patient.");
                $message = 'success';
            } else {
                $message = 'error';
            }
        }
        $this->set(compact('message'));
    }

}
