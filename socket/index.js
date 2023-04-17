const fs = require('fs');
let server;

if (__dirname.indexOf('/root/mankala') > -1) {
    server = require('https').createServer({
        key: fs.readFileSync('/etc/letsencrypt/live/mankala.michal.es/privkey.pem'),
        cert: fs.readFileSync('/etc/letsencrypt/live/mankala.michal.es/cert.pem')
    });
} else {
    server = require('http').createServer();
}
const socket = require('socket.io');
const process = require('process');
const port = 8080;
server.listen(port, function () {
    console.log('listening on port', port);
});

const io = socket(server, {
    cors: {
        credentials: true,
        origin: ['https://mankala.michal.es', 'http://mankala.local'],
        methods: ['GET', 'POST'],
        transports: ['websocket', 'polling'],
    },
    allowEIO3: true
});

io.on('connection', socket => {
    socket.on('moving', data => {
        socket.broadcast.emit('rockMove', data);
    });

    socket.on('restart', () => {
        process.exit(1);
    });
});
