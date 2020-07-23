<?php

namespace App\Service;

class DateRaidService {

    public function calculateDate()
    {
        $date = new \DateTime();
        $day = $date->format('w');

        if ($day === '1') {
            $date = new \DateTime();
            $monday = $date->format('d/m');
            $date = new \DateTime();
            $tuesday = $date->modify('+1 day')->format('d/m');
            $date = new \DateTime();
            $friday = $date->modify('+3 day')->format('d/m');
        }
        if ($day === '2') {
            $date = new \DateTime();
            $monday = $date->modify('-1 day')->format('d/m');
            $date = new \DateTime();
            $tuesday = $date->format('d/m');
            $date = new \DateTime();
            $friday = $date->modify('+2 day')->format('d/m');
        }
        if ($day === '3') {
            $date = new \DateTime();
            $monday = $date->modify('-2 day')->format('d/m');
            $date = new \DateTime();
            $tuesday = $date->modify('-1 day')->format('d/m');
            $date = new \DateTime();
            $friday = $date->modify('+1 day')->format('d/m');
        }
        if ($day === '4') {
            $date = new \DateTime();
            $monday = $date->modify('-3 day')->format('d/m');
            $date = new \DateTime();
            $tuesday = $date->modify('-2 day')->format('d/m');
            $date = new \DateTime();
            $friday = $date->format('d/m');
        }
        if ($day === '5') {
            $date = new \DateTime();
            $monday = $date->modify('+3 day')->format('d/m');
            $date = new \DateTime();
            $tuesday = $date->modify('+4 day')->format('d/m');
            $date = new \DateTime();
            $friday = $date->modify('+6 day')->format('d/m');
        }
        if ($day === '6') {
            $date = new \DateTime();
            $monday = $date->modify('+2 day')->format('d/m');
            $date = new \DateTime();
            $tuesday = $date->modify('+3 day')->format('d/m');
            $date = new \DateTime();
            $friday = $date->modify('+5 day')->format('d/m');
        }
        if ($day === '0') {
            $date = new \DateTime();
            $monday = $date->modify('+1 day')->format('d/m');
            $date = new \DateTime();
            $tuesday = $date->modify('+2 day')->format('d/m');
            $date = new \DateTime();
            $friday = $date->modify('+4 day')->format('d/m');
        }

        return [$monday, $tuesday, $friday];
    }
}
