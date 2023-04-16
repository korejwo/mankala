let socket = null;
let connected = false;

function connect (host) {
    if (socket) {
        return;
    }

    socket = io.connect(host);
    connected = true;
    console.log(socket);

    socket.on('rockInit', function (data) {
        console.log(data);
    });
}

connect('http://mankala.local:8080');

function restartSocketServer() {
    if (!connected || !socket) {
        return;
    }

    socket.emit('restart');
}

// $(document).ready(function () {
//     $('#setName').on('click', function () {
//         console.log(socket);
//         socket.emit('setName', $('[name=name]').val());
//     });
// });
