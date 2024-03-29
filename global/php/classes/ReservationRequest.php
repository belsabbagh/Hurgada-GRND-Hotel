<?php
class ReservationRequest
{
    private DateTime $start, $end;
    private int $nAdults, $nChildren;
    private RoomOptions $room_options;

    /**
     * @param DateTime    $start
     * @param DateTime    $end
     * @param int         $nAdults
     * @param int         $nChildren
     * @param RoomOptions $room_options
     */
    public function __construct(DateTime $start, DateTime $end, int $nAdults, int $nChildren, RoomOptions $room_options)
    {
        $this->start = $start;
        $this->end = $end;
        $this->nAdults = $nAdults;
        $this->nChildren = $nChildren;
        $this->room_options = $room_options;
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
     * Calculates reservation price
     *
     * @param float $base_price
     *
     * @return float
     */
    function calculate_reservation_price(float $base_price): float
    {
        $interval = $this->start->diff($this->end);
        return $base_price * ($interval->d + 1);
    }

    /**
     * Adds reservation for a room
     *
     * @author @Belal-Elsabbagh
     *
     * @throws Exception Emits exception in case of error
     *
     * @param int   $room_no   The room number to be reserved
     * @param float $price     The price of the room
     *
     * @param int   $client_id The client who wants to reserve the room
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
        try
        {
            run_query($book_query);
        } catch (Exception $e)
        {
            echo $e->getMessage();
            throw new Exception('Failed to create reservation', $e->getCode(), $e);
        }
    }

    /**
     * Gets an available room number and price for reservation according to given options
     *
     * @author @Belal-Elsabbagh
     *
     * @return array|null   An array with the room number and price of the room OR null if nothing was found
     */
    function get_available_room(): ?array
    {
        $date_format = "Y-m-d";
        $start_date_str = $this->start->format($date_format);
        $end_date_str = $this->end->format($date_format);

        $get_rooms = "SELECT room_id, room_base_price FROM rooms 
        where room_id NOT IN 
        (
            SELECT room_no FROM reservations
            WHERE ((start_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (end_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (start_date >= '$start_date_str' AND end_date <= '$end_date_str'))
        )
        AND room_type_id = {$this->room_options->getRoomType()} 
        AND room_view = {$this->room_options->getRoomView()}
        AND room_patio = {$this->room_options->getRoomPatio()};";
// Check if a room with these options exist
        try
        {
            $result_rooms = run_query($get_rooms);
            if (empty_mysqli_result($result_rooms)) return null;
            return $result_rooms->fetch_assoc();
        } catch (Exception $e)
        {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * Logs request in activity log.
     *
     * @author @Belal-Elsabbagh
     *
     * @param int   $client_id
     * @param float $price
     * @param int   $room_id
     *
     * @return void
     */
    function log(int $client_id, int $room_id, float $price): void
    {
        $action = "Room Reservation Request";
        $action_description = "Client $client_id 
        reserved room number $room_id 
        from {$this->start->format('Y-m-d')} to {$this->end->format('Y-m-d')} 
        for $this->nAdults adults and $this->nChildren children.";
        activity_log($client_id, $action, $action_description, $price);
    }
}