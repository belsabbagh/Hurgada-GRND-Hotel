const server = require("./global/js/server");
const database = require("./global/js/db-connection");
let db_connection;

server.server_start();
database.db_connect(db_connection);