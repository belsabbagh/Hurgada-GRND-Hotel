<?php

class RoomOptions
{
    public function __construct(int $type, int $view, int $patio)
    {
        $room_type = $type;
        $room_view = $view;
        $room_patio = $patio;
    }
    private int $room_type, $room_view, $room_patio;

    /**
     * @return int
     */
    public function getRoomType(): int
    {
        return $this->room_type;
    }

    /**
     * @return int
     */
    public function getRoomView(): int
    {
        return $this->room_view;
    }

    /**
     * @return int
     */
    public function getRoomPatio(): int
    {
        return $this->room_patio;
    }

}