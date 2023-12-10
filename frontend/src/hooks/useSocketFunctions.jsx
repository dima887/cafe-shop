const useSocketFunctions = () => {

    const sendMessageToWebSocket = (message) => {
        const socket = new WebSocket('ws://localhost:5000');

        socket.addEventListener('open', (event) => {
            console.log('WebSocket connection opened:', event);
            socket.send(message);
        });

        socket.addEventListener('close', (event) => {
            console.log('WebSocket connection closed:', event);
        });

        return () => {
            socket.close();
        };
    }

    return { sendMessageToWebSocket };
};

export default useSocketFunctions;
