const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const PORT = 3000;

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Créer la connexion à la base de données
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'your_password', // Assurez-vous que 'your_password' est correct
  database: 'sauvegarde'  // Remplacez par le nom de votre base de données
  });
  
  // Connectez-vous à la base de données MySQL
  db.connect((err) => {
    if (err) {
      console.error('Erreur de connexion à la base de données:', err);
      return;
    }
    console.log('Connecté à la base de données MySQL');
  });


// Route pour sauvegarder les tâches
app.get('/backup', (req, res) => {
    const query = 'SELECT * FROM tasks';
    db.query(query, (err, results) => {
        if (err) {
            return res.status(500).send('Error fetching tasks');
        }
        res.json(results);
    });
});

// Route pour restaurer les tâches
app.post('/restore', (req, res) => {
    const tasks = req.body.tasks;
    const query = 'INSERT INTO tasks (description, completed) VALUES ?';
    const values = tasks.map(task => [task.description, task.completed]);

    db.query(query, [values], (err, result) => {
        if (err) {
            return res.status(500).send('Error restoring tasks');
        }
        res.send('Tasks restored successfully');
    });
});

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});




app.post('/registration', (req, res) => {
    const email = req.body.email;
    const password = req.body.password;

    // Vérifier si l'utilisateur existe déjà
    db.query('SELECT * FROM users WHERE email = ?', [email], (err, results) => {
        if (err) {
            return res.status(500).send('Erreur de connexion');
        }

        // Vérifier si l'utilisateur existe déjà
        if (results.length > 0) {
            return res.status(409).send('Cet utilisateur existe déjà');
        }

        // Insérer un nouvel utilisateur dans la base de données
        db.query('INSERT INTO users (email, password) VALUES (?, ?)', [email, password], (err, result) => {
            if (err) {
                return res.status(500).send('Erreur lors de l\'inscription');
            }
            res.status(201).send('Inscription réussie');
        });
    });
});

