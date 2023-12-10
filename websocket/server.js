const WebSocket = require('ws');
const http = require('http');

const server = http.createServer((req, res) => {
    res.writeHead(200, { 'Content-Type': 'text/plain' });
    res.end('WebSocket Server\n');
});

const wss = new WebSocket.Server({ server });

const connections = new Set();

wss.on('connection', (ws) => {
    console.log('Client connected');

    connections.add(ws);

    ws.on('message', (message) => {
        console.log(`Received message: ${message}`);

        connections.forEach((connection) => {
            if (connection !== ws && connection.readyState === WebSocket.OPEN) {
                connection.send(`${message}`);
            }
        });
    });

    ws.send('Welcome to the WebSocket server!');
});

const port = 5000;
server.listen(port, () => {
    console.log(`Server listening on http://localhost:${port}`);
});

