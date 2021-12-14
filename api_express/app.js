const express = require('express');
const app = express();
const mongoose = require('mongoose');
const cors = require('cors');
const discussionRouter = require('./routes/discussion.route');
require('dotenv/config');

app.use(cors());
app.use(express.json());
app.use(
  express.urlencoded({
    extended: true,
  })
);

app.use('/discussion', discussionRouter);

const mongoDB = process.env.MONGODB_URI || dev_db_url;
const dev_db_url = mongoDB;
mongoose.connect(mongoDB, () =>
  console.log('Connexion à la base de données effectuée')
);
mongoose.Promise = global.Promise;
const db = mongoose.connection;
db.on('error', console.error.bind(console, 'Connexion error on MongoDB: '));

const port = 5555;

app.listen(port, () => {
  console.log('Server running on : ' + port);
});
