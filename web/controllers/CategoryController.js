const 
	log = require('winston'),
	mysql = require("mysql");

function CategoryController(config)
{
	this.config = config;
}

(function() {
	
	this.register = function(app)
	{
		app.get('/category', this.getCategory.bind(this));
		app.post('/category', this.insertCategory.bind(this));
		app.put('/category', this.updateCategory.bind(this));
		app.delete('/category', this.deleteCategory.bind(this));
	}
	
	// query = function(con, done = function())
	// done must be called after you are done with the connection object.
	this.run = function(query) {
		var con = mysql.createConnection({
			host: this.config.host,
			user: this.config.user,
			password: this.config.password,
			database: this.config.database
		});
		
		// Let the user make their query, then close the connection.
		query(con, function() {
			con.end(function(err) {
				if (err) return log.error(`Error while disconnecting from database ${err}.`);
			});
		});
	}
	
	this.getCategory = function(req, res) {
		this.run(function(con, done) {
			con.query(
				'call r_getCategory(?)', 
				[ req.query.id ], 
				function(err, rows) {
				if (err) {
					log.error(`r_getCategory failed with error ${err}.`);
					res.status(400).json({ error: `Failed to get categories with id ${req.query.id}.` })
				}
				else res.json(rows[0]);
				
				return done();
			});
		});
	}
	
	this.insertCategory = function(req, res) {
		this.run(function(con, done) {
			con.query(
				'call r_insertCategory(?, ?)', 
				[ req.body.name || '', req.body.description || '' ], 
				function(err, rows) {
				if (err) {
					log.error(`r_insertCategory failed with error ${err}.`);
					res.status(400).json({ error: `Failed to insert new category.` });
				} 
				else res.json(rows[0]);
				
				return done();
			});
		});
	}
	
	this.updateCategory = function(req, res) {
		this.run(function(con, done) {
			con.query(
				'call r_updateCategory(?, ?, ?)', 
				[ req.body.id, req.body.name || '', req.body.description || ''], 
				function(err, rows) {
				if (err) {
					log.error(`r_updateCategory failed with error ${err}.`);
					res.status(400).json({ error: `Failed to update category with id ${req.body.id}.` });
				} 
				else res.json(rows[0]);
				
				return done();
			});
		});
	}
	
	this.deleteCategory = function(req, res) {
		this.run(function(con, done) {
			con.query(
				'call r_deleteCategory(?)', 
				[ req.body.id ], 
				function(err, rows) {
				if (err) {
					log.error(`r_updateCategory failed with error ${err}.`);
					res.status(400).json({ error: `Failed to delete category with id ${req.body.id}.` });
				}
				else res.json({});
				
				return done();
			});
		});
	}
	
}).call(CategoryController.prototype);

module.exports = CategoryController;