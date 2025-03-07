const express = require('express');
const session = require('express-session');
const passport = require('passport');
const LocalStrategy = require('passport-local').Strategy;
const bcrypt = require('bcryptjs');
const User = require('./models/user'); // Kasutaja mudel

const app = express();

// Middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Seansside seadistamine
app.use(session({
  secret: 'secret',
  resave: false,
  saveUninitialized: true,
}));

// Passport seansi ja autentimise seadistamine
passport.use(new LocalStrategy(
  function(username, password, done) {
    User.getUserByUsername(username, (err, user) => {
      if (err) { return done(err); }
      if (!user) { return done(null, false, { message: 'Kasutajat ei leitud' }); }

      bcrypt.compare(password, user.password, (err, isMatch) => {
        if (err) { return done(err); }
        if (isMatch) {
          return done(null, user);
        } else {
          return done(null, false, { message: 'Vale parool' });
        }
      });
    });
  }
));

passport.serializeUser(function(user, done) {
  done(null, user.id);
});

passport.deserializeUser(function(id, done) {
  User.getUserById(id, (err, user) => {
    done(err, user);
  });
});

app.use(passport.initialize());
app.use(passport.session());

// Route, et kuvada sisselogitud kasutajat
app.get('/profile', (req, res) => {
  if (!req.isAuthenticated()) {
    return res.redirect('/login');
  }
  res.send(`Tere, ${req.user.username}`);
});

// Logimine
app.post('/login', passport.authenticate('local', {
  successRedirect: '/profile',
  failureRedirect: '/login',
  failureFlash: true
}));

// Sisselogimise leht
app.get('/login', (req, res) => {
  res.send(`
    <form action="/login" method="POST">
      <input type="text" name="username" placeholder="Kasutajanimi" required>
      <input type="password" name="password" placeholder="Parool" required>
      <button type="submit">Logi sisse</button>
    </form>
  `);
});

app.listen(3000, () => {
  console.log('Server käib portil 3000');
});
