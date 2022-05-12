<?php
/**
 * Loads the room types from database and echoes them in html
 *
 * @author  @Belal-Elsabbagh
 *
 * @var     string        $sql    The query to get room types
 * @var     mysqli_result $result The room types
 * @var     string[]      $row    Each room type
 * @return  string The room types input or the exception message.
 */
function load_room_types(): string
{
    $sql = "select * from room_types";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        return $e->getMessage();
    }
    $html = "";
    while ($row = mysqli_fetch_assoc($result))
        $html .= "<input class='options' type='radio' name='room_type' id='{$row['room_category']}' value='{$row['type_id']}' onchange='change_max_beds()'><label for='{$row['room_category']}'>{$row['room_category']}</label>\n";
    return $html;
}

/**
 * Loads the room views from database and echoes them in html
 *
 * @author  @Belal-Elsabbagh
 *
 * @var     string        $sql    The query to get room views
 * @var     mysqli_result $result The room views
 * @var     string[]      $row    Each room view
 * @return  string The room views input
 */
function load_room_views(): string
{
    $sql = "select * from room_views";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        return $e->getMessage();
    }
    $html = "";
    while ($row = mysqli_fetch_assoc($result))
        $html .= "<input class='options' type='radio' name='room_view' id='{$row['room_view_title']}' value='{$row['room_view_id']}'><label for='{$row['room_view_title']}'>{$row['room_view_title']}</label>\n";
    return $html;
}

/**
 * Returns an email input
 *
 * @author @Belal-Elsabbagh
 * @return string The email input
 */
function load_email(): string
{
    return '<div class="email">
                    <label for="email">Client E-mail</label>
                    <input type="email" id="email" name="email" required/>
                   </div>';
}

/**
 * Constructs a new booking form
 *
 * @author @Belal-Elsabbagh
 *
 * @param bool $isEmployee Whether the form user is an employee or not.
 *
 * @return string The booking form html data.
 */
function construct_new_booking_form(bool $isEmployee): string
{
    $email = $isEmployee ? load_email() : "";
    $room_types = load_room_types();
    $room_views = load_room_views();
    return "<form action='book.php' method='post'>
                $email
                <div class='dates'>
                    <label for='checkin'>Check in date</label>
                    <input type='date' id='checkin' name='checkin' required/>
                    <label for='checkout'>Check out date</label>
                    <input type='date' id='checkout' name='checkout' required/>
                </div>
                <div class='num-of-occupants'>
                    <label for='adults'>Number of adults</label>
                    <input type='number' id='adults' name='adults' min='1' max='4' value='1' required/>
                    <label for='children'>Number of children</label>
                    <input type='number' id='children' name='children' min='0' max='8' value='0' required/>
                </div>
                <div class='options'>
                    <div class='room_type'>
                        <h4 class='prompt' style='margin-top: 0;'>Choose a room type</h4>
                        $room_types
                    </div>
                    <div class='view'>
                        <h4 class='prompt' style='margin-top: 0;'>Choose a view from the room</h4>
                        $room_views
                    </div>
                    <div class='outdoors'>
                        <h4 class='prompt' style='margin-top: 0;'>Choose an outdoors setting</h4>
                        <input class='options' id='outdoors_balcony' name='outdoors' type='radio' value='0'>
                        <label for='outdoors_balcony'>Balcony</label>
                        <input class='options' id='outdoors_patio' name='outdoors' type='radio' value='1'>
                        <label for='outdoors_patio'>Patio</label>
                    </div>
                </div>
                <button type='submit' class='submit' id='submit' name='submit'>Submit</button>
                <button type='reset' class='submit' id='reset_button' name='reset_button'>Reset</button>
            </form>";
}