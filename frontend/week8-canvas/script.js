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
