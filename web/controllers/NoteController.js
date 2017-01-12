const 
	log = require('winston'),
	mysql = require("mysql");

function NoteController(config)
{
	this.config = config;
}

(function() {
	
	this.register = function(app)
	{
		app.get('/note', this.getNote.bind(this));
		app.post('/note', this.insertNote.bind(this));
		app.put('/note', this.updateNote.bind(this));
		app.delete('/note', this.deleteNote.bind(this));
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
	
	this.getNote = function(req, res)
	{
		this.run(function(con, done) {
			con.query('call r_getNote(?, ?, ?, ?, ?)', [ req.query.id, req.query.offset, req.query.limit, req.query.category_id, req.query.title ], function(err, rows) {
				if (err) {
					log.error(`r_getNote failed with error ${err}.`);
					res.status(400).json({ error: `Failed to get notes with id ${req.query.id}.` });
				} 
				else res.json(rows[0]);
				
				return done();
			});
		});
	}
	
	this.insertNote = function(req, res)
	{
		this.run(function(con, done) {
			con.query('call r_insertNote(?, ?, ?)', [ req.body.title, req.body.content, req.body.category_id ], function(err, rows) {
				if (err) { 
					log.error(`r_insertNote failed with error ${err}.`);
					res.status(400).json({ error: `Failed to insert new note.` });
				} 
				else res.json(rows[0]);
				
				return done();
			});
		});
	}
	
	this.updateNote = function(req, res)
	{
		this.run(function(con, done) {
			con.query('call r_updateNote(?, ?, ?, ?)', [ req.body.id, req.body.title, req.body.content, req.body.category_id ], function(err, rows) {
				if (err) { 
					log.error(`r_updateNote failed with error ${err}.`);
					res.status(400).json({ error: `Failed to update note with id ${req.body.id}.` });
				}
				else res.json({});
				
				return done();
			});
		});
	}
	
	this.deleteNote = function(req, res)
	{
		this.run(function(con, done) {
			con.query('call r_deleteNote(?)', [ req.body.id ], function(err, rows) {
				if (err) { 
					log.error(`r_deleteNote failed with error ${err}.`);
					res.status(400).json({ error: `Failed to delete note with id ${req.body.id}.` });
				} 
				else res.json({});
				
				return done();
			});
		});
	}
	
}).call(NoteController.prototype);

module.exports = NoteController;