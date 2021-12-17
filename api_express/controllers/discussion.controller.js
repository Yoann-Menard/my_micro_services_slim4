const Discussion = require('../models/discussion.model');
const { body, validationResult } = require('express-validator');

exports.discussion_create_post = async (req, res, next) => {
  const discussion = new Discussion({
    name: req.body.name,
    users: req.body.users,
  });

  try {
    const savedDiscussion = await discussion.save();
    res.json(savedDiscussion);
  } catch (err) {
    res.json({ message: err });
  }
  next();
};

exports.index = async (req, res, next) => {
  try {
    const discussion = await Discussion.find().limit(15);
    res.json(discussion);
  } catch (err) {
    res.json({ message: err });
  }
  next();
};

exports.discussion_list = async (req, res, next) => {
  try {
    const discussion = await Discussion.find();
    res.json(discussion);
  } catch (err) {
    res.json({ message: err });
  }
  next();
};

exports.discussion_detail = async (req, res, next) => {
  try {
    const discussion = await Discussion.findOne({
      _id: req.params.id,
    });
    res.json(discussion);
  } catch (err) {
    res.json({ message: err });
  }
  next();
};

exports.discussion_update_put = async (req, res, next) => {
  const discussion = new Discussion({
    _id: req.params.id,
    name: req.body.name,
    users: req.body.users,
  });

  try {
    const updatedDiscussion = await discussion.updateMany();
    res.json(updatedDiscussion);
  } catch (err) {
    res.json({ message: err });
    next();
  }
};

exports.discussion_delete_delete = async (req, res, next) => {
  try {
    const deletedDiscussion = await Discussion.deleteOne({
      _id: req.params.id,
    });
    res.json(deletedDiscussion);
  } catch (err) {
    res.json({ message: err });
    next();
  }
};
