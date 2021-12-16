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
      _id: req_params.id,
    });
    res.json(discussion);
  } catch (err) {
    res.json({ message: err });
  }
  next();
};

exports.discussion_create_get = async (req, res, next) => {
  res.send('NOT IMPLEMENTED: Discussion  create GET');
  next();
};

exports.discussion_delete_get = async (req, res, next) => {
  res.send('NOT IMPLEMENTED: Discussion delete GET');
  next();
};

exports.discussion_delete_post = async (req, res, next) => {
  res.send('NOT IMPLEMENTED: Discussion delete POST');
  next();
};

exports.discussion_update_get = async (req, res, next) => {
  res.send('NOT IMPLEMENTED: Discussion update GET');
  next();
};

exports.discussion_update_post = async (req, res, next) => {
  const discussion = new Discussion({
    name: req.body.name,
    users: req.body.users,
  });

  try {
    const updatedDiscussion = await discussion.updateOne();
    res.json(updatedDiscussion);
  } catch (err) {
    res.json({ message: err });
    next();
  }
};
