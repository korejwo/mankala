let socket = null;
let connected = false;

function connect (host) {
    if (socket) {
        return;
    }

    socket = io.connect(host);
    connected = true;

    socket.on('rockMove', function (data) {
        rocks[data.id].left = data.x;
        rocks[data.id].top = data.y;
        rocks[data.id].setCoords();
        canvas.renderAll();
    });
}

connect('http://mankala.local:8080');

function restartSocketServer() {
    if (!connected || !socket) {
        return;
    }

    socket.emit('restart');
}
