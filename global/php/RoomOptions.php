<?php

class RoomOptions
{
    public function __construct(int|string $type = 'room_type_id', int|string $view = 'room_view', int|string $patio = 'room_patio')
    {
        $room_type = $type;
        $room_view = $view;
        $room_patio = $patio;
    }

    private int|string $room_type = 'room_type_id', $room_view = 'room_view', $room_patio = 'room_patio';

    /**
     * @return int|string
     */
    public function getRoomType(): int|string
    {
        return $this->room_type;
    }

    /**
     * @return int|string
     */
    public function getRoomView(): int|string
    {
        return $this->room_view;
    }

    /**
     * @return int|string
     */
    public function getRoomPatio(): int|string
    {
        return $this->room_patio;
    }

}