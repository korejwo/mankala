let socket = null;
let connected = false;

function connect (host) {
    if (socket) {
        return;
    }

    socket = io.connect(host);
    connected = true;
    console.log(socket);
}

// connect('http://192.168.0.126:8080');

// $(document).ready(function () {
//     $('#setName').on('click', function () {
//         console.log(socket);
//         socket.emit('setName', $('[name=name]').val());
//     });
// });
