<?php
include_once "../../global/php/db-functions.php";
if (!isset($_SESSION)) {
    session_start();
}
// DB Config
$server = "localhost";
$username = "root";
$password = "";
$dbname = "hurgada-grnd-hotel";
// Open Connection
$connect = new mysqli($server, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function get_user_full_name_by_id($user_id): string
{
    $result = run_query("SELECT first_name, last_name FROM users WHERE user_id = $user_id");
    $user = $result->fetch_assoc();
    return $user['first_name'] . " " . $user['last_name'];
}
class Comment
{
    public string $name;
    public string $comment;

    public function __construct(string $name, string $comment){
        $this->name = $name;
        $this->comment = $comment;
    }
    public function JSON(): string{
        return "{name: \"$this->name\", comment: \"$this->comment\"}";
    }
}

$comments = run_query("SELECT client_id, comments FROM room_reviews");
$arr = "[";
while ($review = $comments->fetch_assoc()){
    $name = get_user_full_name_by_id($review['client_id']);
    $review_object = new Comment($name, $review['comments']);
    $arr .= $review_object->JSON() . ",";
    }
$view = rtrim($arr, ", ") . "]";



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="icon" href="../../resources/img/icons/icon2.png">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="./View.css">
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
</head>
<body>
    <div id="App"></div>

    <script type="text/babel">
        
        class Comments extends React.Component {
            state = {
                lists:<?php include_once"../../global/php/db-functions.php"; echo $view;?>
            }
            handleClick = (e) => {
                e.target.classList.toggle('active')
            }

            render() {
                console.log(this.state.lists);
                const lists = this.state.lists.map(e => {
                    return (
                        <li className='comment'>
                        <h5>{e.name}:</h5>
                        <p>{e.comment}</p>
                        </li>
                    )
                });
                
                return (
                    <div className='comment-box'>
                        <div className='header toggle'>
                            <a href="/contact" onClick={this.handleClick}>
                                <i className='bx bxs-phone'></i>
                                <span>contact us</span>
                            </a>
                            <a href="/rates" onClick={this.handleClick}>
                                <i className='bx bxs-star'></i>
                                <span>rates</span>
                            </a>
                        </div>
                        <ul>
                            {lists}
                        </ul>
                    </div>
                )
            }
        }
        ReactDOM.render(<Comments/>, document.getElementById('App'));
    </script>
</body>

</html>