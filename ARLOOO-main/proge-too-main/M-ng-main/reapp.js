// Kasutaja registreerimine
app.post('/register', (req, res) => {
    const { username, password, role } = req.body;
  
    User.createUser(username, password, role, (err) => {
      if (err) {
        return res.status(500).send('Kasutajat ei saanud luua');
      }
      res.redirect('/login');
    });
  });
  