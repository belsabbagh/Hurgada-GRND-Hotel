<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="icon" href="../../resources/img/icons/icon2.png">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="./view.css">
    <script crossorigin src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
</head>
<body>
    <div id="App"></div>

    <script type="text/babel">

        class Comments extends React.Component {
            state = {
                name: ['adham', 'mrym', 'habiba', 'nouran', 'nancy', "sara", "nour"],
                comments: [
                    'this is my comment and my rating is 0 from 5',
                    'this is my comment and my rating is 1 from 5',
                    'this is my comment and my rating is 2 from 5',
                    'this is my comment and my rating is 3 from 5',
                    'this is my comment and my rating is 4 from 5'
                ]
            }
            handleClick = (e) => {
                e.target.classList.toggle('active')
                // e.target.classList.add('active');
            }
            render() {
                const names = this.state.name;
                const list = names.map(name => {
                    return (
                        <li className='comment'>
                            <h5>{name}:</h5>
                            <p>{this.state.comments[3]}</p>
                        </li>
                    )
                });
                return (
                    <div className='comment-box'>
                        <div class='header toggle'>
                            <a href="#" onClick={this.handleClick}>
                                <i class='bx bxs-phone'></i>
                                <span>contact us</span>
                            </a>
                            <a href="#" onClick={this.handleClick}>
                                <i class='bx bxs-star'></i>
                                <span>rates</span>
                            </a>
                        </div>
                        <ul>
                            {list}
                        </ul>
                    </div>
                )
            }
        }
        ReactDOM.render(<Comments/>, document.getElementById('App'));
    </script>
</body>
</html>