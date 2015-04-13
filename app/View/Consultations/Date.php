<?php

/**
 * Description of date
 *
 * @author MOALLA Mehdi
 */
class Date {

    var $days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    var $months = array('Janvier', 'Février', 'Mars', 'Avril', 'May', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
            
    function getAll($y) {
        $r = array();

        $date = new DateTime(date('Y-m-d', mktime(0, 0, 0, 1, 1, $y)));
        while ($date->format('Y') <= $y) {
            $year = $date->format('Y');
            $month = $date->format('n');
            $day = $date->format('j');
            $week = $date->format('N');
            $r[$year][$month][$day] = $week;
            $date->add(new DateInterval('P1D'));
        }

        return $r;
    }
    
}
