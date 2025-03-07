// models/user.js
const bcrypt = require('bcryptjs');
const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('./database/database.db');

// Kasutaja loomine ja parooli krüpteerimine
function createUser(username, password, role, callback) {
  bcrypt.hash(password, 10, (err, hashedPassword) => {
    if (err) {
      callback(err);
    } else {
      db.run("INSERT INTO users (username, password, role) VALUES (?, ?, ?)", [username, hashedPassword, role], callback);
    }
  });
}

// Kasutaja leidmine kasutajanime järgi
function getUserByUsername(username, callback) {
  db.get("SELECT * FROM users WHERE username = ?", [username], callback);
}

// Kasutaja leidmine ID järgi
function getUserById(id, callback) {
  db.get("SELECT * FROM users WHERE id = ?", [id], callback);
}

module.exports = { createUser, getUserByUsername, getUserById };
