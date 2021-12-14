const mongoose = require('mongoose');

const DiscussionSchema = mongoose.model(
  'discussions',
  new mongoose.Schema({
    name: {
      type: String,
    },
    users: {
      type: Array,
      required: [true, 'users required to start a discussion'],
    },
    createdAt: {
      type: Date,
    },
  })
);

module.exports = DiscussionSchema;
