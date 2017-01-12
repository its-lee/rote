const 
	pkg = require('./package.json'),
	program = require('commander'),
	express = require('express'),
	log = require('winston');

// Initialise logging.
require('./Logging').init();

var config = {
	web_port: 3003,
	db: {
		database: "rote",
		host: "localhost",
		user: "root",
		password: "admin"
	}
};

// Fetch program parameters:
program
	.version(pkg.version)
	.option('-p, --port', `Web server port (${config.web_port}).`, parseInt)
	.option('-d, --database', `Name of the rote database (${config.db.database}).`)
	.option('-h, --host', `Hostname of the rote database (${config.db.host}).`)
	.option('-u, --user', `Username for the rote database (${config.db.user}).`)
	.option('-p, --password', `Password for the rote database (${config.db.password}).`)
	.parse(process.argv);

config.web_port = program.port || config.web_port;
config.db.database = program.database || config.db.database;
config.db.host = program.host || config.db.host;
config.db.user = program.user || config.db.user;
config.db.password = program.password || config.db.password;

log.info(config);

var app = express();

// Static files:
app.use(express.static('public'));
// Allow sending json bodies.
app.use(require('body-parser').json());

// Create controllers:
var controllers = {
	note: new (require('./controllers/NoteController'))(config.db),
	category: new (require('./controllers/CategoryController'))(config.db),
	api: new (require('./controllers/ApiController'))(app)
};

// Register controllers:
Object.keys(controllers).forEach(function(key) {
	controllers[key].register(app);
});

// Listen:
var server = app.listen(config.web_port, () => {
	log.info(`App listening at http://${server.address().address}:${server.address().port}`);
});