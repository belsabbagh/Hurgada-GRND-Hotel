<?php
if (!isset($_SESSION))
{
    session_start();
}

include_once "classes/RoomOptions.php";
include_once "classes/ReservationRequest.php";

/***** CONSTANTS *****/

/**
 * Path to profile pictures directory.
 */
const PFP_DIRECTORY_PATH = "../../resources/img/user_pics/";

/**
 * Path to national id pictures directory.
 */
const ID_PIC_DIRECTORY_PATH = "../../resources/img/id_pics/";

/**
 * URL to the root of the webpages directory.
 */
const REPOSITORY_PAGES_URL = "http://localhost/Hurgada-GRND-Hotel/pages/";

/**
 * URL of home page.
 */
const HOME_URL = REPOSITORY_PAGES_URL . "Home/index.php";

/**
 * URL of login page.
 */
const LOGIN_URL = REPOSITORY_PAGES_URL . "login/index.php";

const SERVER_NAME = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DB_NAME = "hurgada-grnd-hotel";
const NO_USER = -1;
/**--------------------------------------------**/

/**
 * Creates connection to database
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws RuntimeException Emits exception in case of connection error.
 * @return  mysqli  Connection object to the database
 */
function db_connect(): mysqli
{
    $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
    if ($conn->connect_errno)
        throw new RuntimeException('mysqli connection error: ' . $conn->connect_error, $conn->connect_errno);
    return $conn;
}

/**
 * Connects database, runs the given query, and returns the result
 *
 * @author  @Belal-Elsabbagh
 *
 * @throws RuntimeException Thrown if connection was unsuccessful.
 * @throws mysqli_sql_exception Thrown if the query wasn't run successfully.
 *
 * @param string $sql The sql query to run
 *
 * @return mysqli_result|bool The result of the query
 */
function run_query(string $sql): mysqli_result|bool
{
    try
    {
        $conn = db_connect();
    } catch (RuntimeException $e)
    {
        throw new RuntimeException($e);
    }
    $result = $conn->query($sql);
    if ($result === false) throw new mysqli_sql_exception("Failed to run query.\n$conn->error", $conn->errno);
    $conn->close();
    return $result;
}

/**
 * Checks if mysqli_result is empty by checking if its null and the number of rows it returned is zero.
 *
 * @author @Belal-Elsabbagh
 *
 * @param mysqli_result|null $result
 *
 * @return bool
 */
function empty_mysqli_result(?mysqli_result $result): bool
{
    return $result && $result->num_rows == 0;
}

/**
 * Logs action in activity Log
 *
 * @author  @Belal-Elsabbagh
 *
 * @param int        $action_owner_id The id of the account that executed the action.
 * @param string     $action          The action that the user made.
 *
 * @param string     $description     The description of the action.
 * @param float|null $transaction     Amount of money transferred.
 *
 * @return  void
 */
function activity_log(int $action_owner_id, string $action, string $description, ?float $transaction = null): void
{
    $sql = "INSERT INTO activity_log
    (owner, actiontype, description, transaction) 
    VALUES($action_owner_id, '$action', '$description', $transaction)";
    try
    {
        run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

/**
 * Checks availability of room within a certain time period
 *
 * @author @Belal-Elsabbagh
 *
 * @param DateTime $start_date The start date of the booking
 * @param DateTime $end_date   The end date of the booking
 * @param int      $room_id    The room to be booked
 *
 * @return bool Returns true if room is available, false if room is unavailable
 *
 */
function room_isAvailable(int $room_id, DateTime $start_date, DateTime $end_date, int $reservation_id=-1): bool
{
    $exclude =($reservation_id== -1)? " ":"AND reservation_id != $reservation_id";
    $date_format = "Y-m-d";
    $start_date_str = $start_date->format($date_format);
    $end_date_str = $end_date->format($date_format);
    $sql = "SELECT room_no FROM reservations
            WHERE ((start_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (end_date BETWEEN '$start_date_str' AND '$end_date_str') 
            OR (start_date >= '$start_date_str' AND end_date <= '$end_date_str'))
            AND room_no = $room_id $exclude";
           // echo $sql;
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        return false;
    }
    if ($result->num_rows == 0) return true;
    return false;
}

/**
 * Gets the current user's type
 *
 * @author @Belal-Elsabbagh
 *
 * @return bool True if the user is an employee, False if the user is a client
 */
function active_user_isEmployee(): bool
{
    if (get_active_user_type() < 3 && get_active_user_type() != NO_USER) return true;
    return false;
}

/**
 * Takes an email and gets its user id
 *
 * @author @Belal-Elsabbagh
 *
 * @param             $email
 *
 * @var string        $sql  The Query String
 * @var mysqli_result $result
 * @var array         $user The user's data
 * @return int|null returns user id or null if not found
 */
function get_user_id_from_email($email): ?int
{
    $sql = "SELECT user_id FROM users WHERE email = '$email'";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        return null;
    }
    if (empty_mysqli_result($result)) return null;
    $user = $result->fetch_assoc();
    return $user['user_id'];
}

/**
 * Gets the maximum number of occupants for a room
 *
 * @author @Belal-Elsabbagh
 *
 * @param int $room_id The room number
 *
 * @return int|null The room's maximum capacity
 */
function get_room_max_occupants_by_room_id(int $room_id): ?int
{
    $sql = "SELECT room_max_cap FROM room_types, rooms
            WHERE rooms.room_type_id = room_types.type_id 
            AND rooms.room_id = $room_id;";
    try
    {
        $result = run_query($sql);
    } catch (Exception $e)
    {
        echo $e->getMessage();
        return null;
    }
    if (empty_mysqli_result($result)) return null;
    $room = $result->fetch_assoc();
    return $room['room_max_cap'];
}

/**
 * Checks if the requested reservation exceeds maximum room capacity
 *
 * @param int $room_id   The room number to be checked
 * @param int $nAdults   The number of adults requested
 * @param int $nChildren The number of children requested
 *
 * @return bool True if the requested reservation exceeds maximum room capacity. False otherwise
 */
function room_overflow(int $room_id, int $nAdults, int $nChildren): bool
{
    $room_max_cap = get_room_max_occupants_by_room_id($room_id);
    $numberOf_occupants = $nAdults + round($nChildren / 2);
    if ($numberOf_occupants > $room_max_cap) return true;
    return false;
}

/**
 * Gets all the receptionists in the database
 *
 * @author @Belal-Elsabbagh
 *
 * @param string     $column
 * @param string|int $key
 *
 * @return mysqli_result
 */
function get_receptionists(string $column = "1", string|int $key ="1"): mysqli_result
{
    $key = (is_int($key)) ? $key : "'$key'";
    $sql = "SELECT user_id, email, first_name, last_name, national_id_photo, user_pic, receptionist_enabled, receptionist_qc_comment FROM users WHERE user_type = 2 AND $column = $key";
    try
    {
        return run_query($sql);
    } catch (Exception $e)
    {
        throw new LogicException("Unable to get receptionists", 333, $e);
    }
}

/**
 * Gets user from database by their id
 *
 * @author @Belal-Elsabbagh
 *
 * @param int $id The user id.
 *
 * @return array|null Returns an associative array of the found user. Returns null otherwise.
 */
function get_user_by_id(int $id): ?array
{
    try
    {
        $result = run_query("SELECT * FROM users WHERE user_id = $id;");
        if (empty_mysqli_result($result)) return null;
        return $result->fetch_assoc();
    } catch (Exception)
    {
        return null;
    }
}

function user_is_logged_in(): bool
{
    return isset($_SESSION['active_user_type']);
}

function redirect_to_login(): void
{
    if (!user_is_logged_in()) header("Location: " . REPOSITORY_PAGES_URL . "login");
}

/**
 * Constructs header bars respective to the active user type.
 *
 * @author Belal-Elsabbagh
 *
 * @param bool     $bootstrap
 * @param int|null $active_user_type The header's user type.
 *
 * @var Closure    $generate_item    A function that creates an item in the header bar.
 * @return string The html structure of the items.
 */
function load_header_bar(?int $active_user_type = NO_USER, bool $bootstrap = false): string
{
    /**
     * Generates header bar item with a specific title and link.
     *
     * @author Belal-Elsabbagh
     *
     * @param string $title     The title of the item.
     * @param string $link      The link that the item takes the user to.
     * @param bool   $bootstrap Whether the nav item should be bootstrap or not
     *
     * @return string The html content of the item.
     */
    $generate_item = function (string $title, string $link, bool $bootstrap): string
    {
        if (!$bootstrap) return /** @lang HTML */ "<div class='container'><a style='text-decoration: none;' href='$link'>$title</div>\n";
        return /** @lang HTML */ "<li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='$link'>$title</a></span></li>";
    };
    $home = $generate_item("Home", REPOSITORY_PAGES_URL . "Home", $bootstrap);
    $profile = $generate_item("Profile", REPOSITORY_PAGES_URL . "profile", $bootstrap);
    $reservations = $generate_item("Reservations", REPOSITORY_PAGES_URL . "reservations", $bootstrap);
    $my_reservations = $generate_item("My Reservations", REPOSITORY_PAGES_URL . "reservations", $bootstrap);
    $receptionists = $generate_item("Receptionists", REPOSITORY_PAGES_URL . "receptionists", $bootstrap);
    $rooms = $generate_item("Rooms", REPOSITORY_PAGES_URL . "rooms", $bootstrap);
    $ratings = $generate_item("Ratings", REPOSITORY_PAGES_URL . "ratings", $bootstrap);
    $about = $generate_item("About", REPOSITORY_PAGES_URL . "about", $bootstrap);
    $login = $generate_item("Log In", REPOSITORY_PAGES_URL . "login", $bootstrap);
    $signup = $generate_item("Sign Up", REPOSITORY_PAGES_URL . "signUp", $bootstrap);
    $contactus = $generate_item("Contact Us", REPOSITORY_PAGES_URL . "contactUs", $bootstrap);

    return match ($active_user_type)
    {
        3 => $home . $profile . $my_reservations . $contactus,
        2 => $home . $profile . $reservations . $rooms,
        1 => $home . $profile . $reservations . $receptionists . $ratings,
        default => /** @lang HTML */
            $home . $login . $signup . $about
    };
}

/**
 * Takes a submitted picture, renames it to the user's email, and moves it to the given directory to be stored.
 *
 * @author Belal-Elsabbagh
 *
 * @param array  $picture_file  The submitted picture
 * @param string $new_filename  The desired file name.
 * @param string $directory     The folder where the file will go
 *
 * @var string   $pic_extension The picture's extension.
 * @var string   $pic_filename  The full new image file name.
 * @return string The full new image file name.
 */
function insert_pic_into_directory(array $picture_file, string $new_filename, string $directory): string
{
    $pic_info = pathinfo($picture_file['name']);
    $pic_extension = $pic_info['extension'];
    $pic_filename = "$new_filename.$pic_extension";
    move_uploaded_file($picture_file['tmp_name'], $directory . $pic_filename);
    return $pic_filename;
}

/**
 * Constructs the page template with the custom html content given to it.
 *
 * @author Belal-Elsabbagh
 *
 * @param string $page_title   The page title
 * @param string $html_content The html data to be presented within the template
 *
 * @return string The complete html page.
 */
function construct_template(string $page_title, string $html_content): string
{
    return /** @lang HTML */ <<<TEMPLATE
<!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>$page_title</title>
        <!--=============== BOXICONS ===============-->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <link rel='stylesheet' href='../../global/css/bootstrap-5.0.2-dist/css/bootstrap.css'>
        <script src='../../global/css/bootstrap-5.0.2-dist/js/bootstrap.js'></script>
        <script src='../../global/js/font-awesome.js'></script>
        <!-- Render All Elements Normally -->
        <link rel='stylesheet' href='../../global/css/style.css' />
        <link rel='stylesheet' href='style.css' />
        <!-- Main template CSS File -->
        <link rel='stylesheet' href='../../global/template-bootstrap.css' />
        <!-- Main JS File -->
        <script src='../../global/template/template.js'></script>
    </head>

    <body class='d-flex flex-column min-vh-100'>
        <!-- Header -->
        <nav class='navbar' id='header'>
            <div class='container-fluid'>
                <div class='navbar-header' onclick='showbar()'>
                    <span class='navbar-brand'><em class='bx bx-menu-alt-left icon'></em></span>
                </div>
                <div class='row'>
                    <ul class='nav items' id='items'>
                        <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Home</a></span></li>
                        <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Rooms</a></span></li>
                        <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Dining</a></span></li>
                        <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Experience</a></span></li>
                        <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>Location</a></span></li>
                        <li class='nav-item'><span class='nav navbar-nav nav-link-container'><a class='nav-link nlink' href='#'>About</a></span></li>
                    </ul>
                </div>
                <div>
                    <span id='icon2' class='icon2' onclick='hidebar()'><em class='bx bx-x'></em></span>
                </div>
                <span class='book nav navbar-nav navbar-right nav-link-container text-center' id='book'><a class='nav-link nlink' href='#'>Book now</a></span>
            </div>
        </nav>
        <!-- End Of Header -->

        <!-- Body -->


        <div class='container root'>
            <div class='feature'>
                $html_content
            </div>
        </div>
        <!-- End Of Body -->


        <!-- Footer -->
        <footer class='text-center text-white' class='mt-auto' style='background-color: var(--blue0-color);'>
            <!-- Grid container -->
            <div class='container p-4 pb-0'>
                <!-- Section: Social media -->
                <section class='mb-4'>
                    <!-- Github -->
                    <a class='btn btn-outline-light btn-floating m-1' href='https://github.com/Belal-Elsabbagh/Hurgada-GRND-Hotel' role='button'>
                        <img src='../../resources/img/icons/GitHub-Mark-Light-64px.png' width='32' alt='Our GitHub'> GitHub Repository
                    </a>
                </section>
                <!-- Section: Social media -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class='text-center p-3' style='background-color: var(--blue0-color);'>
                &copy; 2022
                <span>MIU</span> All Rights Reserved
            </div>
            <!-- Copyright -->
        </footer>
        <!-- End Of Footer -->

        <!-- Scroll Bar -->
        <span class='c-scroller_thumb'></span>
    </body>

    </html>
TEMPLATE;
}

/**
 * Checks if post contains data.
 *
 * @author Belal-Elsabbagh
 * @return bool True if post contains data, false otherwise.
 */
function post_data_exists(): bool
{
    return ($_SERVER['REQUEST_METHOD'] == 'POST');
}

/**
 * Checks if file was uploaded.
 *
 * @author Belal-Elsabbagh
 * @return bool True if file uploaded, false otherwise.
 */
function fileUploaded(string $file_post_name): bool
{
    return (file_exists($_FILES[$file_post_name]['tmp_name']) && is_uploaded_file($_FILES[$file_post_name]['tmp_name']));
}

function user_email_exists(string $email): bool
{
    $sql = /** @lang MariaDB */
        "SELECT email FROM users WHERE email = '$email'";
    if (!empty_mysqli_result(run_query($sql))) return true;
    return false;
}

/**
 * Gets login data from valid email and password.
 *
 * @throws Exception Throws an exception if login credentials were incorrect.
 * @return array an array containing the user's user_id, email, and user_type.
 */
function get_login_data(string $email, string $password): array
{
    $sql = "SELECT user_id, email, user_type FROM users WHERE email = '$email' AND password = '$password'";
    $result = run_query($sql);
    if (empty_mysqli_result($result)) throw new Exception("Incorrect email or password", 3);
    return mysqli_fetch_assoc($result);
}

/**
 * Checks login credentials
 *
 * @throws Exception Exception if it failed to get login data.
 */
function log_in(string $email, string $password): void
{
    try
    {
        $user_data = get_login_data($email, $password);
        set_active_user($user_data['user_id'], $user_data['email'], $user_data['user_type']);
        activity_log($_SESSION['active_user_id'], "Login", "User {$_SESSION['active_user_id']} logged in.");
        return;
    } catch (Exception $e)
    {
        throw new Exception($e->getMessage(), $e->getCode(), $e);
    }
}

/**
 * @param int    $user_id
 * @param string $email
 * @param int    $user_type
 *
 * @return void
 */
function set_active_user(int $user_id, string $email, int $user_type): void
{
    $_SESSION['active_user_id'] = $user_id;
    $_SESSION['active_email'] = $email;
    $_SESSION['active_user_type'] = $user_type;
}

/**
 * @author Belal-Elsabbagh
 * @return int the active user id or NO_USER value if session wasn't set
 */
function get_active_user_type(): int
{
    return $_SESSION['active_user_type'] ?? NO_USER;
}

/**
 * @author Belal-Elsabbagh
 * @return int the active user id or NO_USER value if session wasn't set
 */
function get_active_user_id(): int
{
    return $_SESSION['active_user_id'] ?? NO_USER;
}

/**
 * Checks if session is running
 *
 * @author Belal-Elsabbagh
 * @return bool true if session is running. False otherwise.
 */
function session_running(): bool
{
    return isset($_SESSION);
}

function maintain_session(): void
{
    if (!session_running()) session_start();
}
//warning
function warningmsg ($msg ,$header,$link){

    echo"

    <div class='center' id = 'center'>
        <div class='content'>
        <div class='header'>
        <h2>$header</h2>
     </div>
        <p> $msg </p>
        <div class='line'></div>
        <form action= '' method = 'post'>
        <a href= '$link'  class = 'close-btn'> ok </a>


  </form>
 </div>
</div>
    ";
}


//confirm
function confirmmsg ($msg ,$header){

    echo"

    <div class='center' id = 'center'>
        <div class='content'>
        <div class='header'>
        <h2>$header</h2>
     </div>
        <p> $msg </p>
        <div class='line'></div>
        <form action= '' method = 'post'>

        <input type ='submit'  class = 'close-btn' name= 'no_btn' value = 'no'>
        <input type ='submit'   class = 'confirm-btn' name= 'yes_btn' value = 'yes'>
  </form>
 </div>
</div>
    ";
}

//confirm using link
function confirmmsg2 ($msg ,$header,$link_no, $link_yes){

    echo"

    <div class='center' id = 'center'>
        <div class='content'>
        <div class='header'>
        <h2>$header</h2>
     </div>
        <p> $msg </p>
        <div class='line'></div>
        <form action= '' method = 'post'>
        <a href= '$link_yes'  class = 'confirm-btn'> yes </a>
        <a href= '$link_no'  class = 'close-btn'> no </a>


  </form>
 </div>
</div>
    ";
}

function restrict_to_staff(): void
{
    if (!active_user_isEmployee()) die("CANNOT ACCESS PAGE.");
}