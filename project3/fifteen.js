// Variables for the puzzle size
let currentBackgroundImage = sessionStorage.getItem("background");

if(!currentBackgroundImage){	
	sessionStorage.setItem("background", './components/bg0.jpeg');
}

let PUZZLE_SIZE = 4;

const TILE_SIZE = 100;

let timerInterval; // Variable to store the interval for the timer
let seconds = 0; // Variable to store the number of seconds elapsed

// Function to start the timer
function startTimer() {
    timerInterval = setInterval(() => {
        seconds++; // Increment the seconds counter
        // Display the timer value wherever you want (e.g., console, HTML element)
        console.log(formatTime(seconds)); // Logging the time in the console
    }, 1000); // Update the timer every second (1000 milliseconds)
}

// Function to stop the timer
function stopTimer() {
    clearInterval(timerInterval); // Stop the interval
}

// Function to format the time and update the timer element
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    const formattedMinutes = String(minutes).padStart(2, '0');
    const formattedSeconds = String(remainingSeconds).padStart(2, '0');
    const formattedTime = `${formattedMinutes}:${formattedSeconds}`;

    // Update the #timer element with the formatted time
    document.getElementById('timer').textContent = formattedTime;

    return formattedTime;
}

function changeBackground(newBackgroundImage) {
	//save background image to storage
	sessionStorage.setItem("background",newBackgroundImage);
    // Update the current background image
	currentBackgroundImage = sessionStorage.getItem("background");


 // Get all elements with the class "puzzle-tile"
 const tiles = document.getElementsByClassName('puzzle-tile');

 // Iterate through all tiles and update their background images
 for (let i = 0; i < tiles.length - 1; i++) {
     tiles[i].style.backgroundImage = `url(${currentBackgroundImage})`;
 }
}

// Function to change puzzle size
function updateSize(newSize) {
    PUZZLE_SIZE = newSize;
    generatePuzzle();
}

function createTile(row, col) {
    const tile = document.createElement('div');
    tile.classList.add('puzzle-tile');

    // Set tile dimensions and position
    tile.style.width = `${TILE_SIZE}px`;
    tile.style.height = `${TILE_SIZE}px`;
    tile.style.lineHeight = `${TILE_SIZE}px`; // For vertical centering
    tile.style.backgroundImage = `url(${currentBackgroundImage})`; // background image of the puzzle
    tile.style.backgroundSize = `${PUZZLE_SIZE * TILE_SIZE}px ${PUZZLE_SIZE * TILE_SIZE}px`;
 // Adjust based on puzzle size

    // Set background position to display a part of the image
    const xPosition = col * TILE_SIZE;
    const yPosition = row * TILE_SIZE;
    tile.style.backgroundPosition = `-${xPosition}px -${yPosition}px`;

    // Set grid row and column positions
    tile.style.gridRow = `${row + 1}`;
    tile.style.gridColumn = `${col + 1}`;

    // Add tile number (1-15) except for the last tile (empty)
    const tileNumber = row * PUZZLE_SIZE + col + 1;
    if (tileNumber !== PUZZLE_SIZE * PUZZLE_SIZE) {
        tile.textContent = tileNumber;
    } else {
        // Set the last tile as visually empty
        tile.style.backgroundImage = 'none'; // Removes the background image
        tile.classList.add('empty-tile');
    }

    // Add click event to each tile except the visually empty tile
    if (tileNumber !== PUZZLE_SIZE * PUZZLE_SIZE) {
        tile.addEventListener('click', handleTileClick);
    }

    // Return the created tile element
    return tile;
}

function areTilesAdjacent(tile1, tile2) {
    // The tile to be empty
    const tile1Row = parseInt(tile1.style.gridRow);
    const tile1Col = parseInt(tile1.style.gridColumn);

    const tile2Row = parseInt(tile2.style.gridRow);
    const tile2Col = parseInt(tile2.style.gridColumn);

    // Check if the tiles are adjacent horizontally or vertically
    return (
        (Math.abs(tile1Row - tile2Row) === 1 && tile1Col === tile2Col) ||
        (Math.abs(tile1Col - tile2Col) === 1 && tile1Row === tile2Row)
    );
}

function isPuzzleSolved() {
    const tiles = document.querySelectorAll('.puzzle-tile:not(.empty-tile)');
    for (let i = 0; i < tiles.length; i++) {
        const correctRow = Math.floor(i / PUZZLE_SIZE) + 1;
        const correctCol = (i % PUZZLE_SIZE) + 1;
        const tileRow = parseInt(tiles[i].style.gridRow);
        const tileCol = parseInt(tiles[i].style.gridColumn);

        // Compare the position of each tile with its correct position
        if (tileRow !== correctRow || tileCol !== correctCol) {
            return false; // If any tile is not in its correct position, return false
        }
    }
    return true; // If all tiles are in correct positions, return true
}

function handleTileClick() {
    const clickedTile = this;
    const emptyTile = document.querySelector('.empty-tile');

    if (!emptyTile) return; // If no empty tile found, do nothing

    if (!timerInterval) {
        startTimer(); // Start the timer when the first move is made
    }

    if (areTilesAdjacent(clickedTile, emptyTile)) {
        // Swap positions of clicked tile and empty tile
        const clickedRow = clickedTile.style.gridRow;
        const clickedCol = clickedTile.style.gridColumn;
        const emptyRow = emptyTile.style.gridRow;
        const emptyCol = emptyTile.style.gridColumn;

        clickedTile.style.gridRow = emptyRow;
        clickedTile.style.gridColumn = emptyCol;
        emptyTile.style.gridRow = clickedRow;
        emptyTile.style.gridColumn = clickedCol;

        // Check if the puzzle is solved after each move
        if (isPuzzleSolved()) {
            // Puzzle is solved
            stopTimer(); // Stop the timer when the puzzle is solved
            alert(`Congratulations! You solved the puzzle in ${formatTime(seconds)}!`);
        }
    }
}

function handleTileHover() {
    const hoveredTile = this;
    const emptyTile = document.querySelector('.empty-tile');

    // Removes hover effect if it has it
    // hovered = Animation for growing
    // hoveredAfter = Animation for shrinking to normal size
    if(hoveredTile.classList.contains('hovered')) {
        // Removes hover effect after 200 ms
        setTimeout(() => {
            hoveredTile.classList.remove('hovered');
            hoveredTile.classList.remove('hoveredAfter')
        }, 200);
        
        if(hoveredTile.classList.contains('hoveredAfter')) {
            hoveredTile.classList.remove('hoveredAfter');
        }
        hoveredTile.classList.add('hoveredAfter')
        return;
    }

    // Adds hover effect is appliable
    if(areTilesAdjacent(hoveredTile, emptyTile)) {
        hoveredTile.classList.add('hovered');
    }
}

//generate the puzzle grid
function generatePuzzle() {
    const container = document.getElementById('puzzle-container');
    container.innerHTML = ''; // Clear previous puzzle if any

    for (let row = 0; row < PUZZLE_SIZE; row++) {
        for (let col = 0; col < PUZZLE_SIZE; col++) {
            const tile = createTile(row, col);
            tile.addEventListener('click', handleTileClick); // Add click event to each tile

            // Add hover event to each tile
            tile.addEventListener('mouseenter', handleTileHover); 
            tile.addEventListener('mouseleave', handleTileHover);

            container.appendChild(tile); // Append the created tile to the container
        }
    }
}

function shuffleTiles() {
    const tiles = document.querySelectorAll('.puzzle-tile:not(.empty-tile)');
    const emptyTile = document.querySelector('.empty-tile');
    const gridSize = PUZZLE_SIZE * PUZZLE_SIZE;

    const tileArray = Array.from(tiles);

    // The shuffle tiles function works perfectly fine as long as the last tile is the empty tile
    // so I just swapped the last tile and empty tile to ensure the last tile is ALWAYS empty

    // Fetches the last tile
    const lastTilePosition = PUZZLE_SIZE + ' / ' + PUZZLE_SIZE;
    let lastTile;
    for(let i = 0; i < tiles.length; i++) {
        const gridArea = tiles[i].style.gridArea
        if(gridArea === lastTilePosition) {
            lastTile = tiles[i];
            break;
        }
    }

    // Swaps the last tile with the empty tile
    if(lastTile) {
        lastTile.style.gridRow = emptyTile.style.gridRow
        lastTile.style.gridCol = emptyTile.style.gridCol
        lastTile.style.gridArea = emptyTile.style.gridArea
    }

    for (let i = tileArray.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));

        // Swap the positions of tiles
        const tempRow = tileArray[i].style.gridRow;
        const tempCol = tileArray[i].style.gridColumn;
        tileArray[i].style.gridRow = tileArray[j].style.gridRow;
        tileArray[i].style.gridColumn = tileArray[j].style.gridColumn;
        tileArray[j].style.gridRow = tempRow;
        tileArray[j].style.gridColumn = tempCol;
    }

    //empty tile remains at the bottom right
    // const emptyRow = gridSize - PUZZLE_SIZE + 1;
    const emptyRow = PUZZLE_SIZE;
    const emptyCol = gridSize % PUZZLE_SIZE === 0 ? PUZZLE_SIZE : gridSize % PUZZLE_SIZE;

    emptyTile.style.gridRow = `${emptyRow}`;
    emptyTile.style.gridColumn = `${emptyCol}`;

    const container = document.getElementById('puzzle-container');
    container.innerHTML = ''; // Clear previous tiles

    // Re-append shuffled tiles to the container
    tileArray.forEach(tile => {
        // console.log(tile.style.gridArea)
        container.appendChild(tile);
    });

    container.appendChild(emptyTile); // Append the empty tile last to ENSURE it stays at the bottom right
}

// Function to handle shuffle button click
function handleShuffleButtonClick() {
    stopTimer(); // Stop the timer if it's running
    seconds = 0; // Reset the seconds counter to zero
    document.getElementById('timer').textContent = '00:00'; // Reset the displayed timer
    shuffleTiles(); // Call the function to shuffle tiles
    startTimer();
}

// Function to handle the "begin" button click inside the rules box
function handleBeginButtonClick() {
    stopTimer(); // Stop the timer if it's running
    seconds = 0; // Reset the seconds counter to zero
    document.getElementById('timer').textContent = '00:00'; // Reset the displayed timer
    rulesBox.style.display = "none"; // Hide the rules box
    startTimer(); // Start the timer
    shuffleTiles(); // Shuffle the puzzle
    startBox.style.display = "none"; // Hide the rules box after beginning the game
}


//listener for the shuffle button click
document.getElementById('shuffle-btn').addEventListener('click', handleShuffleButtonClick);
document.getElementById('beginButton').addEventListener('click', handleBeginButtonClick);
//generate the puzzle grid when the page loads
window.addEventListener('load', generatePuzzle);

/*Onclick function for reset button */
	let resetButton = document.getElementById("restart-btn");
	
	resetButton.onclick = function(){
		window.location.reload();
	}


/* Code for PopUp Boxes for rules, start game */

	//get rulesBox
		let rulesBox = document.getElementById("rulesBox");
		//get rulesButton
		let rulesButton = document.getElementById("rulesButton");
		//click on rulesbutton to open po up
		rulesButton.onclick = function(){
			rulesBox.style.display = "block";
		}
		//get close span element
		let closeRules = document.getElementsByClassName("close")[0];

		//click on close, to close the pop-up
		closeRules.onclick = function(){
			rulesBox.style.display = "none";
		}

	//get startBox
		let startBox = document.getElementById("startBox");
		//get startButton
		let startButton = document.getElementById("startButton");
		//get close span element
		let closeStart = document.getElementsByClassName("close")[1];

		//click on start button to open start box
		startButton.onclick = function(){
			startBox.style.display = "block";
		}
		//click on close, to close the pop-up
		closeStart.onclick = function(){
			startBox.style.display = "none";
		}
	
	//get aboutBox
	let aboutBox = document.getElementById("aboutBox");
	
	//get about button
	let aboutButton = document.getElementById("aboutButton");
	
	//get close button
	let closeAbout = document.getElementsByClassName("close")[2];
	
	//click on button to open box
	aboutButton.onclick =  function(){
		aboutBox.style.display = "block"
	}

	//click on close button to close box
		closeAbout.onclick = function(){
		aboutBox.style.display = "none"
	}