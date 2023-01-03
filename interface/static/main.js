var state = [];
var rotateIdxs_old = null;
var rotateIdxs_new = null;
var stateToFE = null;
var FEToState = null;
var legalMoves = null;

var solveStartState = [];
var solveMoves = [];
var solveMoves_rev = [];
var solveIdx = null;
var solution_text = null;

var faceNames = ["top", "bottom", "left", "right", "back", "front"];
var colorMap = { 0: "#ffffff", 1: "#ffff1a", 4: "#0000ff", 5: "#33cc33", 2: "#ff8000", 3: "#e60000" };
var lastMouseX = 0,
	lastMouseY = 0;
var rotX = -30,
	rotY = -30;

var moves = []

function reOrderArray(arr, indecies) {
	var temp = []
	for (var i = 0; i < indecies.length; i++) {
		var index = indecies[i]
		temp.push(arr[index])
	}

	return temp;
}

/*
	Rand int between min (inclusive) and max (exclusive)
*/
function randInt(min, max) {
	return Math.floor(Math.random() * (max - min)) + min;
}

function clearCube() {
	for (i = 0; i < faceNames.length; i++) {
		var myNode = document.getElementById(faceNames[i]);
		while (myNode.firstChild) {
			myNode.removeChild(myNode.firstChild);
		}
	}
}

function setStickerColors(newState) {
	state = newState
	clearCube()

	idx = 0
	for (i = 0; i < faceNames.length; i++) {
		for (j = 0; j < 9; j++) {
			var iDiv = document.createElement('div');
			iDiv.className = 'sticker';
			iDiv.style["background-color"] = colorMap[Math.floor(newState[idx] / 9)]
			document.getElementById(faceNames[i]).appendChild(iDiv);
			idx = idx + 1
		}
	}
}

function buttonPressed(ev) {
	var face = ''
	var direction = '1'

	if (ev.shiftKey) {
		direction = '-1'
	}
	if (ev.which == 85 || ev.which == 117) {
		face = 'U'
	} else if (ev.which == 68 || ev.which == 100) {
		face = 'D'
	} else if (ev.which == 76 || ev.which == 108) {
		face = 'L'
	} else if (ev.which == 82 || ev.which == 114) {
		face = 'R'
	} else if (ev.which == 66 || ev.which == 98) {
		face = 'B'
	} else if (ev.which == 70 || ev.which == 102) {
		face = 'F'
	}
	if (face != '') {
		clearSoln();
		moves.push(face + "_" + direction);
		nextState();
	}
}


function enableScroll() {
	document.getElementById("first_state").disabled = false;
	document.getElementById("prev_state").disabled = false;
	document.getElementById("next_state").disabled = false;
	document.getElementById("last_state").disabled = false;
}

function disableScroll() {
	document.getElementById("first_state").blur(); //so keyboard input can work without having to click away from disabled button
	document.getElementById("prev_state").blur();
	document.getElementById("next_state").blur();
	document.getElementById("last_state").blur();

	document.getElementById("first_state").disabled = true;
	document.getElementById("prev_state").disabled = true;
	document.getElementById("next_state").disabled = true;
	document.getElementById("last_state").disabled = true;
}

/*
	Clears solution as well as disables scroll
*/
function clearSoln() {
	solveIdx = 0;
	solveStartState = [];
	solveMoves = [];
	solveMoves_rev = [];
	solution_text = null;
	document.getElementById("solution_text").innerHTML = "解法:";
	disableScroll();
}

function setSolnText(setColor = true) {
	solution_text_mod = JSON.parse(JSON.stringify(solution_text))
	if (solveIdx >= 0) {
		if (setColor == true) {
			solution_text_mod[solveIdx] = solution_text_mod[solveIdx].bold().fontcolor("yellow")
		} else {
			solution_text_mod[solveIdx] = solution_text_mod[solveIdx]
		}
	}
	document.getElementById("solution_text").innerHTML = "解法: " + solution_text_mod.join(" ");
}

function enableInput() {
	document.getElementById("shoudong").disabled = false;
	document.getElementById("scramble").disabled = false;
	document.getElementById("solve").disabled = false;
	document.getElementById("cfop").disabled = false;
	$(document).on("keypress", buttonPressed);
}

function disableInput() {
	document.getElementById("shoudong").disabled = true;
	document.getElementById("scramble").disabled = true;
	document.getElementById("solve").disabled = true;
	document.getElementById("cfop").disabled = true;
	$(document).off("keypress", buttonPressed);
}

function nextState(moveTimeout = 0) {
	if (moves.length > 0) {
		disableInput();
		disableScroll();
		move = moves.shift() // get Move

		//convert to python representation
		state_rep = reOrderArray(state, FEToState)
		newState_rep = JSON.parse(JSON.stringify(state_rep))

		//swap stickers
		for (var i = 0; i < rotateIdxs_new[move].length; i++) {
			newState_rep[rotateIdxs_new[move][i]] = state_rep[rotateIdxs_old[move][i]]
		}

		// Change move highlight
		if (moveTimeout != 0) { //check if nextState is used for first_state click, prev_state,etc.
			solveIdx++
			setSolnText(setColor = true)
		}

		//convert back to HTML representation
		newState = reOrderArray(newState_rep, stateToFE)

		//set new state
		setStickerColors(newState)

		//Call again if there are more moves
		if (moves.length > 0) {
			setTimeout(function () { nextState(moveTimeout) }, moveTimeout);
		} else {
			enableInput();
			if (solveMoves.length > 0) {
				enableScroll();
				setSolnText();
			}
		}
	} else {
		enableInput();
		if (solveMoves.length > 0) {
			enableScroll();
			setSolnText();
		}
	}
}

function scrambleCube() {
	disableInput();
	clearSoln();

	numMoves = randInt(100, 200);
	for (var i = 0; i < numMoves; i++) {
		moves.push(legalMoves[randInt(0, legalMoves.length)]);
	}

	nextState(0);
}

function shoudong() {
	document.getElementsByClassName("form_1")[0].className = "form_1 open";
	// state = [2, 5, 8, 1, 4, 7, 24, 25, 26, 27, 28, 29, 10, 13, 16, 9, 12, 15, 20, 23, 11, 19, 22, 14, 18, 21, 17, 0, 32, 35, 3, 31, 34, 6, 30, 33, 42, 39, 36, 43, 40, 37, 44, 41, 38, 45, 46, 47, 48, 49, 50, 51, 52, 53];
	// setStickerColors(state);
}

function solveCube() {
	disableInput();
	clearSoln();
	document.getElementById("solution_text").innerHTML = "计算中..."
	$.ajax({
		url: '/solve',
		data: { "state": JSON.stringify(state) },
		type: 'POST',
		dataType: 'json',
		success: function (response) {
			solveStartState = JSON.parse(JSON.stringify(state))
			solveMoves = response["moves"];
			solveMoves_rev = response["moves_rev"];
			solution_text = response["solve_text"];
			solution_text.push("还原完毕")
			setSolnText(true);

			moves = JSON.parse(JSON.stringify(solveMoves))

			setTimeout(function () { nextState(500) }, 500);
		},
		error: function (error) {
			console.log(error);
			document.getElementById("solution_text").innerHTML = "..."
			setTimeout(function () { solveCube() }, 500);
		},
	});
}

function solveCubeCFOP() {
	disableInput();
	clearSoln();
	document.getElementById("solution_text").innerHTML = "计算中..."
	$.ajax({
		url: '/cfop',
		data: { "state": JSON.stringify(state) },
		type: 'POST',
		dataType: 'json',
		success: function (response) {
			solveStartState = JSON.parse(JSON.stringify(state))
			solveMoves = response["moves"];
			solveMoves_rev = response["moves_rev"];
			solution_text = response["solve_text"];
			solution_text.push("还原完毕")
			setSolnText(true);

			moves = JSON.parse(JSON.stringify(solveMoves))

			setTimeout(function () { nextState(500) }, 500);
		},
		error: function (error) {
			console.log(error);
			document.getElementById("solution_text").innerHTML = "..."
			setTimeout(function () { solveCubeCFOP() }, 500);
		},
	});
}

function color2id(color) {
	if (color == "绿")
		return 49;
	if (color == "黄")
		return 13;
	if (color == "白")
		return 4;
	if (color == "橙")
		return 22;
	if (color == "红")
		return 31;
	if (color == "蓝")
		return 40;
}

function submit() {
	var green = document.getElementById("green").value;
	var red = document.getElementById("red").value;
	var orange = document.getElementById("orange").value;
	var blue = document.getElementById("blue").value;
	var yellow = document.getElementById("yellow").value;
	var white = document.getElementById("white").value;
	var m = { 2: 0, 5: 1, 8: 2, 1: 3, 4: 4, 7: 5, 0: 6, 3: 7, 6: 8, 11: 9, 14: 10, 17: 11, 10: 12, 13: 13, 16: 14, 9: 15, 12: 16, 15: 17, 20: 18, 23: 19, 26: 20, 19: 21, 22: 22, 25: 23, 18: 24, 21: 25, 24: 26, 29: 27, 32: 28, 35: 29, 28: 30, 31: 31, 34: 32, 27: 33, 30: 34, 33: 35, 42: 36, 39: 37, 36: 38, 43: 39, 40: 40, 37: 41, 44: 42, 41: 43, 38: 44, 47: 45, 50: 46, 53: 47, 46: 48, 49: 49, 52: 50, 45: 51, 48: 52, 51: 53 };
	var green2id = [47, 50, 53, 46, 49, 52, 45, 48, 51];
	var red2id = [29, 32, 35, 28, 31, 34, 27, 30, 33];
	var orange2id = [20, 23, 26, 19, 22, 25, 18, 21, 24];
	var blue2id = [38, 41, 44, 37, 40, 43, 36, 39, 42];
	var yellow2id = [11, 14, 17, 10, 13, 16, 9, 12, 15];
	var white2id = [6, 3, 0, 7, 4, 1, 8, 5, 2];
	state = [2, 5, 8, 0, 4, 7, 0, 3, 6, 11, 14, 17, 10, 13, 16, 9, 12, 15, 20, 23, 26, 19, 22, 25, 18, 21, 24, 29, 32, 35, 28, 31, 34, 27, 30, 33, 42, 39, 36, 43, 40, 37, 44, 41, 38, 47, 50, 53, 46, 49, 52, 45, 48, 51];
	setStickerColors(state);
	for (var i = 0; i < 9; i++) {
		state[m[green2id[i]]] = color2id(green[i]);
		state[m[red2id[i]]] = color2id(red[i]);
		state[m[orange2id[i]]] = color2id(orange[i]);
		state[m[blue2id[i]]] = color2id(blue[i]);
		state[m[yellow2id[i]]] = color2id(yellow[i]);
		state[m[white2id[i]]] = color2id(white[i]);
	}
	var sum = 0;
	for (var i = 0; i < 54; i++) {
		sum = sum + state[i];
	}
	if (sum != 1431) {
		document.getElementById("solution_text").innerHTML = "魔方不合法"
		return;
	}
	document.getElementById("solution_text").innerHTML = ""
	$.ajax({
		url: '/cfop',
		data: { "state": JSON.stringify(state) },
		type: 'POST',
		dataType: 'json',
		success: function (response) {
			solveStartState = JSON.parse(JSON.stringify(state))
			solveMoves = response["moves"];
			solveMoves_rev = response["moves_rev"];
			// solution_text = response["solve_text"];
			// solution_text.push("SOLVED!")
			// setSolnText(true);

			// moves_rev = JSON.parse(JSON.stringify(solveMoves_rev))

			// setTimeout(function () { nextState(500) }, 500);
			state = [2, 5, 8, 1, 4, 7, 0, 3, 6, 11, 14, 17, 10, 13, 16, 9, 12, 15, 20, 23, 26, 19, 22, 25, 18, 21, 24, 29, 32, 35, 28, 31, 34, 27, 30, 33, 42, 39, 36, 43, 40, 37, 44, 41, 38, 47, 50, 53, 46, 49, 52, 45, 48, 51];
			setStickerColors(state);
			moves = solveMoves_rev.reverse();
			solveIdx = 0;
			nextState();
		},
		error: function (error) {
			console.log(error);
			document.getElementById("solution_text").innerHTML = "..."
			setTimeout(function () { solveCubeCFOP() }, 500);
		},
	});
}

$(document).ready($(function () {
	disableInput();
	clearSoln();
	$.ajax({
		url: '/initState',
		data: {},
		type: 'POST',
		dataType: 'json',
		success: function (response) {
			setStickerColors(response["state"]);
			rotateIdxs_old = response["rotateIdxs_old"];
			rotateIdxs_new = response["rotateIdxs_new"];
			stateToFE = response["stateToFE"];
			FEToState = response["FEToState"];
			legalMoves = response["legalMoves"]
			enableInput();
		},
		error: function (error) {
			console.log(error);
		},
	});

	$("#cube").css("transform", "translateZ( -100px) rotateX( " + rotX + "deg) rotateY(" + rotY + "deg)"); //Initial orientation	

	$('#scramble').click(function () {
		scrambleCube()
	});

	$('#shoudong').click(function () {
		shoudong()
	});

	$('#solve').click(function () {
		solveCube()
	});

	$('#cfop').click(function () {
		solveCubeCFOP()
	});

	$('#quit').click(function () {
		document.getElementsByClassName("form_1")[0].className = "form_1";
	});

	$('#submit').click(function () {
		submit()
	});

	$('#first_state').click(function () {
		if (solveIdx > 0) {
			moves = solveMoves_rev.slice(0, solveIdx).reverse();
			solveIdx = 0;
			nextState();
		}
	});

	$('#prev_state').click(function () {
		if (solveIdx > 0) {
			solveIdx = solveIdx - 1
			moves.push(solveMoves_rev[solveIdx])
			nextState()
		}
	});

	$('#next_state').click(function () {
		if (solveIdx < solveMoves.length) {
			moves.push(solveMoves[solveIdx])
			solveIdx = solveIdx + 1
			nextState()
		}
	});

	$('#last_state').click(function () {
		if (solveIdx < solveMoves.length) {
			moves = solveMoves.slice(solveIdx, solveMoves.length);
			solveIdx = solveMoves.length
			nextState();
		}
	});

	$('#cube_div').on("mousedown", function (ev) {
		lastMouseX = ev.clientX;
		lastMouseY = ev.clientY;
		$('#cube_div').on("mousemove", mouseMoved);
	});
	$('#cube_div').on("mouseup", function () {
		$('#cube_div').off("mousemove", mouseMoved);
	});
	$('#cube_div').on("mouseleave", function () {
		$('#cube_div').off("mousemove", mouseMoved);
	});

	console.log("ready!");
}));


function mouseMoved(ev) {
	var deltaX = ev.pageX - lastMouseX;
	var deltaY = ev.pageY - lastMouseY;

	lastMouseX = ev.pageX;
	lastMouseY = ev.pageY;

	rotY += deltaX * 0.2;
	rotX -= deltaY * 0.5;

	$("#cube").css("transform", "translateZ( -100px) rotateX( " + rotX + "deg) rotateY(" + rotY + "deg)");
}

