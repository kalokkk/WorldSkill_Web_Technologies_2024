const container = document.getElementById('container');
const list = document.getElementById('list');
const input = document.getElementById('input');
const button = document.getElementById('button');

const socket = io();

socket.on('welcome message', msg => {
    console.log("welcome message:" , msg);
    const welcomeMsg = document.createElement('h2');
    welcomeMsg.innerText = msg;
    container.appendChild(welcomeMsg);
});

socket.on('receive message', msg => { 
    const li = document.createElement('li');
    li.innerText = msg;
    
    container.appendChild(li);
});

const sendMsgHandler = (e) => {
    e.preventdefault();
    socket.emit('send message', input.value);
};

button.addEventListener('click', sendMsgHandler);
