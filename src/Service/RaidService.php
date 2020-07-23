<?php


namespace App\Service;


class RaidService
{
    public function resumeRaidParticipant($raids)
    {
        $mondayUser = 0;
        $tuesdayUser = 0;
        $fridayUser = 0;
        foreach ($raids as $raid) {
            if ($raid->getDayOne()) {
                $mondayUser++;
            }
            if ($raid->getDayTwo()) {
                $tuesdayUser++;
            }
            if ($raid->getDayThree()) {
                $fridayUser++;
            }
        }
        $result = [$mondayUser, $tuesdayUser, $fridayUser];

        return $result;
    }
}
