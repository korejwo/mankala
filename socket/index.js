const server = require('http').createServer();
const socket = require('socket.io');
const process = require('process');
const port = 8080;
server.listen(port, function () {
    console.log('listening on port', port);
});

const io = socket(server, {
    cors: {
        credentials: true,
        origin: ['http://192.168.0.126', 'http://192.168.0.120:8080', 'http://145.239.93.29', 'http://michal.es', 'http://mankala.local'],
        methods: ['GET', 'POST'],
        transports: ['websocket', 'polling'],
    },
    allowEIO3: true
});

const sockets = {};

io.on('connection', socket => {
    console.log('connection', socket.id);
    sockets[socket.id] = socket;
    // console.log(sockets);

    socket.on('moving', data => {
        console.log('moving', data);
        for (const loopSocket in sockets) {
            if (loopSocket === socket.id) {
                continue;
            }

            console.log(loopSocket);
        }
    });

    socket.on('restart', data => {
        process.exit(1);
    });

    socket.on('disconnect', (event) => {
        console.log('disconnect', socket.id);
        delete sockets[socket.id];
    });
});
