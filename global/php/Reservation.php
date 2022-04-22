<?php

class Reservation
{
    private DateTime $start, $end;
    private int $nAdults, $nChildren;

    /**
     * @param DateTime $start
     * @param DateTime $end
     * @param int      $nAdults
     * @param int      $nChildren
     */
    public function __construct(DateTime $start, DateTime $end, int $nAdults, int $nChildren)
    {
        $this->start = $start;
        $this->end = $end;
        $this->nAdults = $nAdults;
        $this->nChildren = $nChildren;
    }

    /**
     * @return int
     */
    public function getNAdults(): int
    {
        return $this->nAdults;
    }

    /**
     * @return int
     */
    public function getNChildren(): int
    {
        return $this->nChildren;
    }


    /**
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }

    /**
     * Checks the constraints on reservation dates
     *
     * @author @Belal-Elsabbagh
     *
     * @return bool             Returns true if date is not feasible, false if date works.
     */
    public function bad_date(): bool
    {
        $today = new DateTime();
        return $this->start > $this->end || $this->start < $today || $this->end < $today;
    }


    /**
     * Gets the difference between two dates in days
     *
     * @author @Belal-Elsabbagh
     *
     * @return  int  The difference in days
     */
    public function get_numberof_days_between_dates(): int
    {
        return (int)round((strtotime($this->start->format('Y-m-d')) - strtotime($this->end->format('Y-m-d'))) / (60 * 60 * 24));
    }
}