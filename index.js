const mysql = require('mysql'),
    http = require("http"),
    fs = require('fs'),
    hostname = "127.0.0.1",
    port = 2611;
let db_connection, server;

let handleRequest = (request, response) => {
    response.writeHead(200, {
        'Content-Type': 'text/html'
    });
    fs.readFile('./index.html', null, (error, data) => {
        if (error) {
            response.writeHead(404);
            response.write('file not found');
        } else {
            response.write(data);
        }
        response.end();
    });
};

server = http.createServer(handleRequest);
server.listen(port, function (error) {
    if (error) {
        console.error('Something went wrong ', error);
        return;
    }
    console.log('Server running at http://' + hostname + ':' + port + '/');
});

db_connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "hurgada-grnd-hotel"
});

db_connection.connect(function (err) {
    if (err) throw err;
    console.log("Connected!");
});
