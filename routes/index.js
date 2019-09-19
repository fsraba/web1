var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

router.get('/web', function(req, res, next){
  res.render('../views/category/web/web.ejs');
});

module.exports = router;
