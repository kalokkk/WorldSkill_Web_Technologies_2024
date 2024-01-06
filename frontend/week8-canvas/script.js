const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

ctx.fillStyle = "rgba(0, 0, 0, 0.3)";
ctx.fillRect(10, 10, 300 - 10 - 10, 150 - 10 - 10);

ctx.fillStyle = "rgba(36, 52, 180, 0.4)";
ctx.strokeRect(5, 5, 100, 7);

ctx.beginPath();
ctx.moveTo(100, 100);
ctx.lineTo(200, 5);
ctx.lineTo(200, 100);
// ctx.stroke();
ctx.fill()

// ctx.arc(20, 20, 10, 0, Math.PI / 2);
// console.log("PI", Math.PI);
// ctx.fillStyle = "blue";
// ctx.fill();

let isDrawing = false;

canvas.addEventListener('mousedown', e => {
    isDrawing = true;
    ctx.moveTo(e.offsetX, e.offsetY);
});

canvas.addEventListener('mouseup', e => {
    isDrawing = false;
});

canvas.addEventListener('mousemove', e => {
    if (!isDrawing) return;
    ctx.lineTo(e.offsetX, e.offsetY);
    ctx.stroke();
});

const canvas2 = document.getElementById('canvas2');
const ctx2 = canvas2.getContext('2d');

console.log("ctx2: ", ctx2);

// ctx2.beginPath();
// ctx2.fillStyle = "blue";
// ctx2.arc(20, 20, 10, 0, 2 * Math.PI);
// ctx2.closePath();
// ctx2.fill();

const CANVAS_WIDTH = 300;
const CANVAS_HEIGHT = 150;

const ball = {
    x: 20,
    y: 20,
    vx: 1.2,
    vy: 1,
    loss: 0.95,
    radius: 15,
    color: "rgb(210, 32, 56)",
    draw() {
        ctx2.beginPath();
        ctx2.arc(this.x, this.y, this.radius, 0, 2 * Math.PI);
        ctx2.closePath();
        ctx2.fillStyle = this.color;
        ctx2.fill();
    }
}

function clear() {
    ctx2.fillStyle = "rgba(255, 255, 255, 0.4)";
    ctx2.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
}

function animate() {
    // ctx2.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
    clear();

    ball.draw();

    if (ball.y + ball.vy > canvas.height || ball.y + ball.vy < 0) {
        ball.vy = -ball.vy;
        // if (Math.abs(ball.vy) < 6) {
        //     console.log("vy: ", ball.vy);
        //     ball.vy *= 2 / Math.abs(ball.vy);
        // }
    }
    if (ball.x + ball.vx > canvas.width || ball.x + ball.vx < 0) {
        ball.vx = -ball.vx;
    }

    ball.x += ball.vx;
    ball.y += ball.vy;

    ball.vy *= 0.98;
    // if (ball.y < canvas2.height /2) 
    if (ball.vy > 0) {
        ball.vy += 0.4;
    } else {
        ball.vy += 0.45;
    }

    // console.log("vy: ", ball.vy);
    

    window.requestAnimationFrame(animate);
}

function resetPosition() {
    ball.x = 10;
    ball.y = 10;
}

canvas2.addEventListener('click', () => {
    resetPosition();
})

ball.draw();
window.requestAnimationFrame(animate);