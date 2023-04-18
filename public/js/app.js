let socket = null;
let connected = false;

function connect (host) {
    socket = io.connect(host);

    socket.on('connect', () => {
        connected = true;
    });
    socket.on('disconnect', () => {
        connected = false;
    });
    socket.on('rockMove', function (data) {
        rocks[data.id].set({left: data.x, top: data.y});
        rocks[data.id].setCoords();
        canvas.renderAll();
    });
}

connect('https://mankala.michal.es:8080');

function restartSocketServer() {
    if (!connected || !socket) {
        return;
    }

    socket.emit('restart');
}
