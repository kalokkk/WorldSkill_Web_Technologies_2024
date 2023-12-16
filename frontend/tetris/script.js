let isDropping = false;
let isRunning = false;

const NUMBER_COLUMN = 10;
const NUMBER_ROW = 20;
const SIZE_CELL = 20;// in px;
// const DROP_TIME_IN_MS = 800;
const DROP_TIME_IN_MS = 300;

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

let allCells = [];

main();


function initialGameBoard() {
    const board = document.getElementById('board');
    board.dataset.col = NUMBER_COLUMN;
    board.dataset.row = NUMBER_ROW;
    board.style.gridTemplateColumns = `repeat(${NUMBER_COLUMN}, ${SIZE_CELL}px)`;

    for (let i=0; i<NUMBER_ROW*NUMBER_COLUMN; i++) {
        board.appendChild(initialCell(i));
        allCells.push(0);
    }

    console.log(allCells);
}

function initialCell(index) {
    const cell = document.createElement('div');
    cell.classList.add('cell');
    cell.dataset.index = index;
    return cell;
}

function getRandomShape() {
    const shapes = [SHAPE_STICK ,SHAPE_L ,SHAPE_L2 ,SHAPE_S ,SHAPE_S2 ,SHAPE_SQUARE ,SHAPE_PYRAMID];

    const randomIndex = Math.floor(Math.random()*(shapes.length-1));
    return shapes[randomIndex];
}

function dropNewShape(row,col) {
    const board = document.getElementById('board');
    const cellElements = board.children;

    const shape = getRandomShape();
    // const startingPoint = [6,5]; // [row, col]
    
    shape.forEach((rows, rowIndex) => {
        rows.forEach((pixel, colIndex)=> {
            if (pixel !== 1) {
                return;
            }
            // cellElements[(startingPoint[1]+colIndex) + (startingPoint[0]+rowIndex)*NUMBER_COLUMN].classList.add('active');
            // cellElements[(col+colIndex) + (row+rowIndex)*NUMBER_COLUMN].classList.add('active');
            allCells[(col+colIndex) + (row+rowIndex)*NUMBER_COLUMN] = 2;
        })
    });
}

function projectShapes() {
    const board = document.getElementById('board');
    const cellElements = board.children;

    allCells.forEach((cell, index) => {
            if (cell === 0 && cellElements[index].classList.contains('active')) {
                cellElements[index].classList.remove('active');
                return;
            }
            else if (cell === 0) return;

            cellElements[index].classList.add('active')
        }
    );
}

function shapeDropping() {
    if (!allCells.includes(2)) {
        isDropping = false;
        return;
    }

    let newAllCells = [...allCells];

    newAllCells.reverse();
    for (let index=0;index<newAllCells.length;index++) {
        if (newAllCells[index] !== 2) continue;
        if (index-NUMBER_COLUMN < 0 || (typeof newAllCells[index-NUMBER_COLUMN] !== 'undefined' && newAllCells[index-NUMBER_COLUMN] !== 0)) {
            newAllCells[index] = 1;
            newAllCells = newAllCells.map((cell, i) => {
                return cell === 2 ? 1 : cell;
            });
            console.log(newAllCells);
            break;
        };

        newAllCells[index] = 0;
        newAllCells[index-NUMBER_COLUMN] = 2;
    }
    
    newAllCells.reverse();
    allCells = [...newAllCells];
}

function moveHorizontal(offset) {
    let newAllCells = [...allCells];
    if (offset === 1) {
        const shouldReturn = newAllCells.some((cell, index) => (cell === 2 && index % NUMBER_COLUMN === 9));
        if (shouldReturn) return;
    }

    for (let index=0;index<newAllCells.length;index++) {
        if (newAllCells[index] !== 2) continue;

        if (offset === -1 && index % NUMBER_COLUMN === 0) break;
        // if (offset === 1 && allCells.some((cell, index) => cell === 2 && index % NUMBER_COLUMN === 9)) break;
        // if (offset === 1 && index % NUMBER_COLUMN === 9) break;

        if (offset === -1) {
            newAllCells[index-1] = 2;
            newAllCells[index] = 0;
        }
        if (offset === 1) {
            newAllCells[index+1] = 2;
            if (allCells[index-1] !== 2) newAllCells[index] = 0;
        }
    }
    allCells = [...newAllCells];
}

function main() {
    initialGameBoard();

    // const positionX = Math.floor(Math.random() * (NUMBER_COLUMN-4) + 2);
    // dropNewShape(0,positionX);
    // projectShapes();
    
    // shapeDropping();
    // projectShapes();
    setInterval(() => {
        do {
            if (!isDropping) {
                const positionX = Math.floor(Math.random() * (NUMBER_COLUMN-4) + 2);
                dropNewShape(0,positionX);
                isDropping = true;

                projectShapes();
                continue;
            }
            moveHorizontal(1);
            shapeDropping();
            projectShapes();
        } while (isRunning);
    }, DROP_TIME_IN_MS);
}