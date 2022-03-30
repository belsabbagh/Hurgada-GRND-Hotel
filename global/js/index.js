const mysql = require('mysql');
let con;
function connect_to_db()
{
    con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "lab06"
    });

    con.connect(function(err) {
        if (err) throw err;
        console.log("Connected!");
    });
}

function insert_into_db()
{
    let sql = "INSERT INTO user (Email, Password) VALUES ('Tony', '123')";
    con.query(sql, function (err) {
        if (err) throw err;
        console.log("1 record inserted");
    });
}
connect_to_db();
insert_into_db();