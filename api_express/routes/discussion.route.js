const express = require('express');
const router = express.Router();

const discussion_controller = require('../controllers/discussion.controller');

router.get('/', discussion_controller.index);

router.get('/discussion/create', discussion_controller.discussion_create_get);

router.post('/discussion/create', discussion_controller.discussion_create_post);

router.get(
  '/discussion/:id/delete',
  discussion_controller.discussion_delete_get
);
router.post(
  '/discussion/:id/delete',
  discussion_controller.discussion_delete_post
);

router.get(
  '/discussion/:id/update',
  discussion_controller.discussion_update_get
);

router.post(
  '/discussion/:id/update',
  discussion_controller.discussion_update_post
);
router.get('/discussion/:id', discussion_controller.discussion_detail);

router.get('/discussions', discussion_controller.discussion_list);

module.exports = router;
