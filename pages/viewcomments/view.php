<?php
include_once "../../global/php/db-functions.php";
maintain_session();
// DB Config
$server = "localhost";
$username = "root";
$password = "";
$dbname = "hurgada-grnd-hotel";
// Open Connection
$connect = new mysqli($server, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HURGADA-GRND-HOTEL</title>
    <link rel="icon" href="../../resources/img/pretty stuff/hurghada-beach.jpg">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="./view.css">
    <link rel='stylesheet' href='../../global/template/qualitytemp.css' />
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
</head>
<body>
    <div id="App"></div>
    <script type="text/babel">
        class Header extends React.Component {
            handleRates = e => {
                ReactDOM.render(<Rates/>, document.getElementById('comments'));
            }
            handleContact = e => {
                ReactDOM.render(<Contact/>, document.getElementById('comments'));
            }
            render() {
                return (
                    <div className='header'>
                        <a href="#" onClick={this.handleContact}>
                            <i className='bx bxs-phone'></i>
                            <span>Contact Us Suggestions </span>
                        </a>
                        <a href="#" onClick={this.handleRates}>
                            <i className='bx bxs-star'></i>
                            <span>Rating Comments</span>
                        </a>
                    </div>
                )
            }
        }

        class Sidebar extends React.Component {
            render() {
                return (
                    <div className="sidebar">
                        <ul>
                            <li>
                                <a href="./view.php">
                                <i class='bx bxs-user-rectangle'></i> Profile</a>
                            </li>
                            <li>
                                <a href="../viewcomments/view.php">
                                <i class='bx bxs-message-dots'></i> Guests Comments</a>
                            </li>
                            <li>
                                <a href="./view.php">
                                <i class='bx bxs-report'></i> Rating Reports</a>
                            </li>
                            <li>
                                <a href="../receptionists/index.php">
                                <i class='bx bxs-edit-alt'></i> Receptionist</a>
                            </li>
                            <li>
                                <a href="./view.php">
                                <i class='bx bx-log-out'></i> Log out</a>
                            </li>
                        </ul>
                    </div>
                )
            }
        }

        class Rates extends React.Component {
            state = {
                lists: <?php echo get_comments_as_JSON();?>
            }

            render() {
                const lists = this.state.lists.map(e => {
                    return (
                        <li className='comment'>
                            <h5>{e.name}:</h5>
                            <p>{e.comment}</p>
                        </li>
                    )
                });

                return (
                    <div className='comments'>
                        <ul>
                            {lists}
                        </ul>
                    </div>
                )
            }
        }

        class Contact extends React.Component {
            state = {
                lists: <?php echo get_contactus_suggestions_as_JSON();?>
            }

            render() {
                const lists = this.state.lists.map(e => {
                    return (
                        <li className='comment'>
                            <h5>{e.name}:</h5>
                            <p>{e.comment}</p>
                        </li>
                    )
                });

                return (
                    <div className='comments'>
                        <ul>
                            {lists}
                        </ul>
                    </div>
                )
            }
        }

        class App extends React.Component {
            render() {
                return (
                    <div className='container'>
                        <Header/>
                        <Sidebar/>
                        <div id="comments">
                            <Contact/>
                        </div>
                    </div>
                )
            }
        }
        ReactDOM.render(<App/>, document.getElementById('App'));
    </script>
</body>

</html>