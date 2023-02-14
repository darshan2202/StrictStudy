//Loading Animation Close
window.addEventListener('load', () => {
    const preload = document.querySelector('.loader');
    preload.classList.add('loader-close');
})

/*Quote Generate*/
window.addEventListener("load", function getQuotes() {
    const api = "https://api.quotable.io/random";
    const quote = document.getElementById("quote");
    const author = document.getElementById("author");
    fetch(api)
        .then((res) => res.json())
        .then((data) => {
            quote.innerHTML = `"${data.content}"`;
            author.innerHTML = `- ${data.author}`;
        });
});
//Hide Quotes after 15sec
setTimeout(function hideQuote() {
    document.getElementById('quote').style.display = "none";
    document.getElementById('author').style.display = "none";
}, 15000);

//MusicPlayer
function showMusicPlayer() {
    document.querySelector('iframe').style.display = "block";
    document.querySelector('.material-icons.md-38').style.display = "block";
    document.getElementById('spotify').style.display = "none";
}
function closeMusicPlayer() {
    document.querySelector('iframe').style.display = "none";
    document.querySelector('.material-icons.md-38').style.display = "none";
    document.getElementById('spotify').style.display = "block";
}

//Timer Function
var interval;
var flag;
var studyTime;
var title = document.title;
var studyTimeInput;
var breakTimeInput;
var breakTime;
var musicFlag = document.getElementById("musicNote").value;
var studytimecount = 0;
var breaktimecount = 0;

function subtractFuntion(check) { // Time subtracting function
    if (check == 1) {
        //for study time
        var studyInput = document.getElementById("stime").textContent;
        var temp = studyInput.split(":");
        if (temp[0] <= "55" && temp[0] > "00") {
            var min = temp[0];
            min = min - 5;
            finalTime = min + ":" + "00";
            document.getElementById("stime").innerHTML = finalTime;
        }
    }
    if (check == 2) {
        //for break time 
        var studyInput = document.getElementById("btime").textContent;
        var temp = studyInput.split(":");
        if (temp[0] <= "55" && temp[0] > "00") {
            var min = temp[0];
            min = min - 5;
            finalTime = min + ":" + "00";
            document.getElementById("btime").innerHTML = finalTime;
        }
    }
}

function additionFuntion(check) {
    //Time adding function
    if (check == 1) {
        //for study time
        var studyInput = document.getElementById("stime").textContent;
        var temp = studyInput.split(":");
        if (temp[0] < "55" && temp[0] >= "0") {
            var min = temp[0];
            min = parseInt(min) + 5;
            finalTime = min + ":" + "00";
            document.getElementById("stime").innerHTML = finalTime;
        }
    }
    if (check == 2) {
        //for break time 
        var studyInput = document.getElementById("btime").textContent;
        var temp = studyInput.split(":");
        if (parseInt(temp[0]) < "25" && temp[0] >= "0") {
            var min = temp[0];
            min = parseInt(min) + 5;
            finalTime = min + ":" + "00";
            document.getElementById("btime").innerHTML = finalTime;
        }
    }
}

function timefunction() {

    studyTimeInput = document.getElementById("stime").textContent; // get time value 
    breakTimeInput = document.getElementById("btime").textContent;// get time value 

    studyTime = studyTimeInput.split(":");  //spliting time into hr. and min.
    studytimecount = studyTime[0]
    timecalculate(studyTime, 1);  //function called for study time countdown
    playAudio();
    document.getElementById("submit").disabled = true;
    document.getElementById('submit').style.pointerEvents = "none";
    document.getElementById("subtract_study").disabled = true;
    document.getElementById("addition_study").disabled = true;
    document.getElementById("subtract_break").disabled = true;
    document.getElementById("addition_break").disabled = true;
}

function timecalculate(time, flag) {
    //calculate timer
    var hr = 0;
    var min = time[0];
    var sec = 0;

    if (min != 0) {
        min--;
        sec = 59;
    }
    if (min == 0 && hr != 0) {
        sec = 59;
    }
    interval = setInterval(function () {   //countdown loop.
        if (hr == 0 && min == 0 && sec == 0) {
            clearInterval(interval);
            if (flag == 1) {
                studynotify();
            }
            if (flag == 2) {
                breaknotify();
            }
            // exit the loop if coutdown is ended.
        }
        else {
            sec--;
            if (sec == 0 && min != 0) {
                sec = 59;
                min--;
            }
            if (min == 0 && hr != 0) {
                min = 59;
                hr--;
            }
        }
        var totalTime = (min + ":" + sec);
        if (flag == 1) {
            document.getElementById("stime").innerHTML = totalTime;//printing timmer.
            document.getElementById('timer').innerHTML = totalTime;

        }
        if (flag == 2) {
            document.getElementById("btime").innerHTML = totalTime;
            document.getElementById('timer').innerHTML = totalTime;
        }

    }, 1000);
}

function studynotify() {     //creating funtion for notification when study timer ends   
    var newTitle = "(" + "Break Started " + ")" + title;
    document.title = newTitle;
    breakTime = breakTimeInput.split(":");
    breaktimecount = breakTime[0];
    timecalculate(breakTime, 2);  //function called for break time countdown
    count = 2;
    playAudio();
    clearTimeout(studyTime);
}

function breaknotify() {     //creating funtion for notification when break timer ends
    var newTitle = "(" + "Break End " + ")" + title;
    document.title = newTitle;
    playAudio();
    passSessionTime();
}

function resetTitle() { //Reset the time and title of page
    document.getElementById("submit").disabled = false;
    document.getElementById('submit').style.pointerEvents = "initial";
    document.getElementById("subtract_study").disabled = false;
    document.getElementById("addition_study").disabled = false;
    document.getElementById("subtract_break").disabled = false;
    document.getElementById("addition_break").disabled = false;
    document.title = title;
    studyfinalTime = "25" + ":" + "00";
    breakfinalTime = "10" + ":" + "00";
    document.getElementById("stime").innerHTML = studyfinalTime;
    document.getElementById("btime").innerHTML = breakfinalTime;
    document.getElementById('timer').innerHTML = '00:00';
    clearInterval(interval); // stop time countdown when clicked on reset button
}

function playAudio() {       // play audio function
    musicFlag = document.getElementById("musicNote").value;
    if (musicFlag == "true") {
        var audio = document.getElementById("audioFunction()");
        audio.play();
    }
}
function musicFunction() {
    //music button function
    musicFlag = document.getElementById("musicNote").value;
    if (musicFlag == "true") {
        var alertsoundStatus = document.getElementById('alertsound');
        alertsoundStatus.innerHTML = "volume_off";
        document.getElementById("musicNote").value = "false";
    }
    else {
        var alertsoundStatus = document.getElementById('alertsound');
        alertsoundStatus.innerHTML = "volume_up";
        document.getElementById("musicNote").value = "true";
    }
}
function passSessionTime() {
    var date = new Date();
    var currentdate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
    date.setTime(date.getTime() + (21 * 1000));
    var expires = "; expires=" + date.toGMTString();
    document.cookie = escape("sessionStudyTime") + "=" + escape(studytimecount);
    document.cookie = escape("sessionBreakTime") + "=" + escape(breaktimecount);
    document.cookie = escape("sessionDate") + "=" + escape(currentdate);
    document.cookie = escape("usecookie") + "=" + escape("true") + expires;
    console.log(document.cookie);
    location.reload();
}

//Open Close Timer function onclick
function showTimer() {
    let x = document.getElementById('fulltimer');
    if (x.style.display == "block") {
        x.style.display = "none";
    }
    else {
        x.style.display = "block";
    }
}

//Goals Function
var checkFlag = 0;               //flag for keeping count of number of input
var completeFlag = 0;
var remainingFlag = 0;
var labelText;                  //will contain text of goals


function addGoalFunction(goal_text) {                    //Button function
    if (goal_text.value != "") {                        //Checking for Input field is empty or not 
        checkFlag = checkFlag + 1;
        createCheckbox(goal_text, checkFlag);
        remainingFlag += 1;
        addRemainingGoal();
    }
}
function createCheckbox(goal_text, checkFlag) {         //function for creating dynamic checkbox
    var label = document.createElement("label");
    label.id = "checkLabel" + checkFlag;
    labelText = document.createTextNode(goal_text.value);

    var hold = document.getElementById("goal_list");
    var checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.id = "checkBox" + checkFlag;
    checkbox.addEventListener("click", checkboxTrue);

    var addline = document.createElement("hr")
    var BrEAK = document.createElement("br");
    label.htmlFor = "checkBox";
    hold.appendChild(checkbox);
    label.appendChild(labelText);
    hold.appendChild(label);
    hold.appendChild(BrEAK);
    hold.appendChild(addline);
    goal_text.value = '';
    document.getElementById(goal_text.id).focus();
}

function checkboxTrue() {                    //when checkbox is clicked this funtion will be called
    completeFlag++;
    remainingFlag--;
    for (temp = checkFlag; temp > 0; temp--) {
        if (document.querySelector('#checkBox' + temp).checked == true) {
            var check_value = document.querySelector('#checkBox' + temp);
            text = labelText;
            document.getElementById("checkLabel" + temp).style.textDecoration = 'line-through';
            check_value.disabled = true;
            addComplete_goal();
            remainingGoals = remainingFlag;
            document.getElementById("goals_remaining").innerHTML = remainingGoals;
        }
    }
}

function addRemainingGoal() {                 //Show remaining goals in number
    var remainingGoals = remainingFlag;
    document.getElementById("goals_remaining").innerHTML = remainingGoals;
}
function addComplete_goal() {                  //Show completed goals in number
    var completedGoals = completeFlag;
    document.getElementById("goals_completed").innerHTML = completedGoals;
}

//Open Close Goals function onclick
function showGoals() {
    let x = document.getElementById('goals-box');
    if (x.style.display == "block") {
        x.style.display = "none";
    }
    else {
        x.style.display = "block";
    }
}

//Login Function

function loginform() {
    document.querySelector('.sidebar').classList.add('formactive');
    document.querySelector('.top').classList.add('formactive');
    document.querySelector('.form-container').classList.add('show');
    document.querySelector("#closeForm").addEventListener("click", function () {
        document.querySelector('.form-container').classList.remove('show');
        document.querySelector('.sidebar').classList.remove('formactive');
        document.querySelector('.top').classList.remove('formactive');
    });
    document.getElementById('signuptab').addEventListener("click", function () {
        document.querySelector(".login-form").style.display = "none";
        document.querySelector(".signup-form").style.display = "block";
        document.getElementById('form-title').innerHTML = "Sign Up"
    });
    document.getElementById('logintab').addEventListener("click", function () {
        document.querySelector(".login-form").style.display = "block";
        document.querySelector(".signup-form").style.display = "none";
        document.getElementById('form-title').innerHTML = "Login"
    });
}

function showStats() {
    document.querySelector('.stats-container').classList.add('showstats');
    document.querySelector("#closeStats").addEventListener("click", function () {
        document.querySelector('.stats-container').classList.remove('showstats');
    });
}




