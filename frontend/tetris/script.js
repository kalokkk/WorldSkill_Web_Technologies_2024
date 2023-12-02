const NUMBER_COLUMN = 10;
const NUMBER_ROW = 20;
const SIZE_CELL = 20;// in px;

initialGameBoard();

function initialGameBoard() {
    const board = document.getElementById('board');
    board.dataset.col = NUMBER_COLUMN;
    board.dataset.row = NUMBER_ROW;
    board.style.gridTemplateColumns = `repeat(${NUMBER_COLUMN}, ${SIZE_CELL}px)`;

    for (let i=0; i<NUMBER_ROW*NUMBER_COLUMN; i++) {
        board.appendChild(initialCell(i));
    }
}

function initialCell(index) {
    const cell = document.createElement('div');
    cell.classList.add('cell');
    cell.dataset.index = index;
    return cell;
}