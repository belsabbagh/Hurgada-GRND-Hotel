exports.db_connect = function connect_to_db(con)
{
    const mysql = require('mysql');
    con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "hurgada-grnd-hotel"
    });

    con.connect(function(err) {
        if (err) throw err;
        console.log("Connected!");
    });
}