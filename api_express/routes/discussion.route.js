const express = require('express');
const router = express.Router();
const discussion_controller = require('../controllers/discussion.controller');

router.get('/', discussion_controller.index);

router.post('/create', discussion_controller.discussion_create_post);

router.put('/:id/update', discussion_controller.discussion_update_put);

router.delete('/:id/delete', discussion_controller.discussion_delete_delete);

router.get('/discussions', discussion_controller.discussion_list);
module.exports = router;
