<?php
/**
 * Loads the room types from database and echoes them in html
 *
 * @author  @Belal-Elsabbagh
 *
 * @var     string        $sql    The query to get room types
 * @var     mysqli_result $result The room types
 * @var     string[]      $row    Each room type
 * @return  void
 */
function load_room_types(): void
{
    $sql = "select * from room_types";
    $result = run_query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input class='options' type='radio' name='room_type' id='{$row['room_category']}' value='{$row['type_id']}' onchange='change_max_beds()'><label for='{$row['room_category']}'>{$row['room_category']}</label>\n";
}

/**
 * Loads the room views from database and echoes them in html
 *
 * @author  @Belal-Elsabbagh
 *
 * @var     string        $sql    The query to get room views
 * @var     mysqli_result $result The room views
 * @var     string[]      $row    Each room view
 * @return  void
 */
function load_room_views(): void
{
    $sql = "select * from room_views";
    $result = run_query($sql);
    while ($row = mysqli_fetch_assoc($result))
        echo "<input class='options' type='radio' name='room_view' id='{$row['room_view_title']}' value='{$row['room_view_id']}'><label for='{$row['room_view_title']}'>{$row['room_view_title']}</label>\n";
}

/**
 * Returns an email input
 *
 * @author @Belal-Elsabbagh
 * @return void
 */
function load_email(): void
{
    $email_form = '<div class="email">
                    <label for="email">Client E-mail</label>
                    <input type="text" id="email" name="email" required/>
                   </div>';
    echo $email_form;
}