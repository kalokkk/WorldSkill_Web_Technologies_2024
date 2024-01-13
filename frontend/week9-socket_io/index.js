import path from 'path'
import express from 'express'
import { Server } from 'socket.io'
import { fileURLToPath } from 'url';

const HOSTNAME = '127.0.0.1';
const PORT = 3000;
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
app.use(express.static('public'));

const server = app.listen(PORT, HOSTNAME, function () {
    console.log(`Server is running at http://${HOSTNAME}:${PORT}`);
})

app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

const io = new Server(server);

io.on('connection', socket => {
    // socket.emit('welcome message', 'hello world!');

    socket.on('send message', msg => {
        socket.emit('receive message', msg);
    });
});