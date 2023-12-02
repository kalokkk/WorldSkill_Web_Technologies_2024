const NUMBER_COLUMN = 10;
const NUMBER_ROW = 20;
const SIZE_CELL = 20;// in px;

const SHAPE_STICK = [[1],
                     [1],
                     [1],
                     [1]];

const SHAPE_L = [[1,0],
                 [1,0],
                 [1,0],
                 [1,1]];

const SHAPE_L2 = [[0,1],
                  [0,1],
                  [0,1],
                  [1,1]];

const SHAPE_S = [[0,1,1],
                 [1,1,0]];

const SHAPE_S2 = [[1,1,0],
                  [0,1,1]];

const SHAPE_SQUARE = [[1,1],
                      [1,1]];

const SHAPE_PYRAMID = [[0,1,0]
                       [1,1,1]];

initialGameBoard();

projectShape(6,5);


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

function getRandomShape() {
    const shapes = [SHAPE_STICK ,SHAPE_L ,SHAPE_L2 ,SHAPE_S ,SHAPE_S2 ,SHAPE_SQUARE ,SHAPE_PYRAMID];

    return shapes[0];
}

function projectShape(x,y) {
    const board = document.getElementById('board');
    const cells = board.children;

    const shape = getRandomShape();
    // const startingPoint = [6,5]; // [row, col]
    
    shape.forEach((row, rowIndex) => {
        row.forEach((pixel, colIndex)=> {
            if (!pixel === 1) {
                return;
            }
            // cells[(startingPoint[1]+colIndex) + (startingPoint[0]+rowIndex)*NUMBER_COLUMN].classList.add('active');
            cells[(y+colIndex) + (x+rowIndex)*NUMBER_COLUMN].classList.add('active');
        })
    });
}