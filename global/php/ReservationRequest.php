<?php

class ReservationRequest
{
    private DateTime $start, $end;
    private int $nAdults, $nChildren, $nBeds;
    private RoomOptions $room_options;

    /**
     * @param DateTime    $start
     * @param DateTime    $end
     * @param int         $nAdults
     * @param int         $nChildren
     * @param int         $nBeds
     * @param RoomOptions $room_options
     */
    public function __construct(DateTime $start, DateTime $end, int $nAdults, int $nChildren, int $nBeds, RoomOptions $room_options)
    {
        $this->start = $start;
        $this->end = $end;
        $this->nAdults = $nAdults;
        $this->nChildren = $nChildren;
        $this->nBeds = $nBeds;
        $this->room_options = $room_options;
    }

    /**
     * @return int
     */
    public function getNBeds(): int
    {
        return $this->nBeds;
    }

    /**
     * @return RoomOptions
     */
    public function getRoomOptions(): RoomOptions
    {
        return $this->room_options;
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

    /**
     * Calculates reservation price
     *
     * @param float $base_price
     *
     * @return float
     */
    function calculate_reservation_price(float $base_price): float
    {
        return $base_price * $this->get_numberof_days_between_dates();
    }

    /**
     * Adds reservation for a room
     *
     * @author @Belal-Elsabbagh
     *
     * @param int   $client_id The client who wants to reserve the room
     * @param int   $room_no   The room number to be reserved
     * @param float $price     The price of the room
     *
     * @return void
     */
    function add_reservation(int $client_id, int $room_no, float $price): void
    {
        $date_format = "Y-m-d";
        $start_date_str = $this->start->format($date_format);
        $end_date_str = $this->end->format($date_format);

        $book_query = "INSERT into reservations
        values(NULL, $client_id, $room_no, '$start_date_str', '$end_date_str', $this->nAdults, $this->nChildren, $price, 0);";
        run_query($book_query);
    }

    /**
     * Gets available rooms for reservation according to given options
     *
     * @author @Belal-Elsabbagh
     *
     * @return array|null   An array with the data of the room OR null if nothing was found
     */
    function get_available_room(): ?array
    {
        $date_format = "Y-m-d";
        $start_date_str = $this->start->format($date_format);
        $end_date_str = $this->end->format($date_format);

        $get_rooms = "SELECT room_id FROM rooms 
        where room_id NOT IN 
        (
            SELECT room_no FROM reservations 
            WHERE (start_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (end_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (start_date >= '$start_date_str' AND end_date <= '$end_date_str')
        )
        AND room_beds_number = $this->nBeds
        AND room_type_id = {$this->room_options->getRoomType()} 
        AND room_view = {$this->room_options->getRoomView()}
        AND room_patio = {$this->room_options->getRoomPatio()};";

// Check if a room with these options exist
        $result_rooms = run_query($get_rooms);
        if ($result_rooms->num_rows == 0) return null;
        return $result_rooms->fetch_assoc();
    }
}