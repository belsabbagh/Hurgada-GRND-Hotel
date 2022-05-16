<?php
include_once "../../global/php/db-functions.php";
const FORM_URL = "http://localhost/Hurgada-GRND-Hotel/pages/booking/form.php";
const LOGIN_ERRNO = 313;
/**
 * Runs booking from form.php
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws Exception Emits Exception in case of an error.
 * @var int|null $client_id The client's id in the database.
 *
 * @return  void
 */
function book(): void
{
    if (!post_data_exists()) throw new RuntimeException("Form was not submitted correctly", 1);
    $client_id = array_key_exists('email', $_POST) ? get_user_id_from_email($_POST['email']) : ($_SESSION['active_id'] ?? null);
    if (is_null($client_id)) throw new Exception("No valid login or client.", LOGIN_ERRNO);

    // Gather data from POST and parse into correct data type
    try
    {
        $start_date = new DateTime($_POST['checkin']);
        $end_date = new DateTime($_POST['checkout']);
    } catch (Exception $e)
    {
        throw new ValueError("Failed to process dates", 3, $e);
    }

    $reservation_request = new ReservationRequest(
        $start_date,
        $end_date,
        intval($_POST['adults']),
        intval($_POST['children']),
        new RoomOptions(
            array_key_exists('room_type', $_POST) ? intval($_POST['room_type']) : 'room_type_id',
            array_key_exists('room_view', $_POST) ? intval($_POST['room_view']) : 'room_view',
            array_key_exists('outdoors', $_POST) ? intval($_POST['outdoors']) : 'room_patio'
        )
    );

    if ($reservation_request->bad_date()) throw new LogicException("Invalid Date Chosen.", 4);

    $room = $reservation_request->get_available_room();
    if (!$room) throw new LogicException("No Room matches these options.");
    if (room_overflow($room['room_id'], $reservation_request)) throw new LogicException("Too many people in one room.", 5);
    $price = $reservation_request->calculate_reservation_price($room['room_base_price']);
    try
    {
        $reservation_request->add_reservation($client_id, $room['room_id'], $price);
    } catch (Exception $e)
    {
        throw new RuntimeException("Failed to create reservation.", 666, $e);
    }
    $reservation_request->log($client_id, $room['room_id'], $price);
}

$content = "Operation Successful.";
try
{
    book();
} catch (Exception $e)
{
    $content = "<img src='../../resources/img/icons/warning-sign.png' alt='warning sign' width='150' height='150'><br> {$e->getMessage()}" . "<br>";
    if ($e->getCode() == LOGIN_ERRNO) $content .= "<a href='" . FORM_URL . "'>Log in</a>";

} finally
{
    $content .= "<a href='" . FORM_URL . "'>Go back to form</a>";
}
echo construct_template("Edit receptionist", $content);