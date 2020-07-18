//Thanks to Nitin Patel
//http://iamnitinpatel.com/projects/calendar/
//Referenced from https://medium.com/@nitinpatel_20236/challenge-of-building-a-calendar-with-pure-javascript-a86f1303267d

//dates are passed as json object
console.log(start_date);
/*let result = [];
for(let i = 0; i<dates.length; i++){
    result.push(dates[i]);
}
console.log(dates);
console.log(result);
dates = result;*/
let today = new Date();
let theDay = today;
 if(start_date !== undefined){
     today = new Date(start_date);
 }
 console.log(today);
const thisYear = today.getFullYear();
const thisMonth = today.getMonth();
let currentMonth = thisMonth;
let currentYear = thisYear;
let currentDate;
const monthName = ['January', 'February', 'March', 'April', 'May', 'Jun', 'July', 'August', 'September',
    'October', 'November', 'December'];
// const daysNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
// const daysNamesShort = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
function showCalendar(month = null, year = null) {


    if(year === null) year = thisYear;
    if(month === null) month = thisMonth;



    let firstDayInMonth = (new Date(year, month)).getDay();

    let output;
    output = "<table id='plan' class='table'>";
    output +="<thead class='text-center'>" +
        "<tr>" +
            "<th>" +
                "<a href='/public/plan/back' class='btn btn-outline-light py-0 px-3'>" +
                    "<i class='fas fa-caret-left fa-2x'></i>" +
                "</a>" +
            "</th>" +
            "<th class='chooseBtn' id='date' colspan='5' onclick='chooseDate()'>" +
                monthName[month] + " " + year +
            "</th>" +
            "<th class='chooseBtn' onclick='next()'>" +
                "<a href='/public/plan/next' class='btn btn-outline-light py-0 px-3'>" +
                    "<i class='fas fa-caret-right fa-2x'></i>" +
                "</a>" +
            "</th>" +
        "</tr>";
    output += "<tr style='font-size: 1rem'><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>";
    output += "</thead>";
    output += "<tbody>";
    let cellBGcolor;
    let day = 1;
    for(let i=0; i<6; i++){
        output += "<tr>";
        for(let j=0; j<7; j++){
            cellBGcolor = '#ccc';

            if(i === 0 && j < firstDayInMonth){
                output += "<td><div class='cell_container'></div></td>";
            }else if(day > daysInMonth(month, year)){
                output += "<td><div class='cell_container'></div></td>";
            }else{
                let field = "";
                field = fields(year, month, day);

                if (day === theDay.getDate() && year === theDay.getFullYear() && month === theDay.getMonth()){
                    cellBGcolor = '#fb8';
                    output += "<td id='today' aria-valuenow=" + currentDate + " style='background-color:" + cellBGcolor + "'><div class='cell_container'>" + day + field + "</div></td>";
                }else {
                    output += "<td aria-valuenow=" + currentDate + " style='background-color:" + cellBGcolor + "'><div class='cell_container'>" + day + field + "</div></td>";
                }
                day++
            }
        }
        output += "</tr>";
    }
    output += "</tbody>";
    output += "</table>";

    let calendar = document.getElementById("calendar");
    calendar.innerHTML = output;

}

function fields(year, month, day) {
    currentDate = year + "-" + addZero(month+1) + "-" + addZero(day);
    //console.log(currentDate);
    let f = ""; let bg_color = ""; randColor = 100;
    for(let i = 0; i < dates.length; i++){
        if(dates[i].date === currentDate){
            randColor = randColor + 60;
            if(randColor > 220) randColor = 100;
            bg_color = "rgb(" + randColor + ", " + randColor + ", " + randColor + ")";

            let st = dates[i].start_time;
            st = st.slice(0, -3);
            let et = dates[i].end_time;
            et = et.slice(0, -3);
            f +=
                "<ul title='"+ dates[i].note +"' style='background-color:" + bg_color + "'>" +
                //"<li>ID: " + dates[i].id + "</li>" +
                "<li style='font-weight: bold'>" + st + " - " + et + "</li>" +
                //"<li>Date:" + dates[i].date + "</li>" +
                "<li>" + dates[i].therapist + "</li>" +
                //"<li>Note:" + dates[i].note + "</li>" +
                (dates[i].reserved === 1 ? "<li class='text-danger'>Reserved</li>" : "") +
                "</ul>";
        }
        //console.log(dates[i].date);
    }
    return f;
}


function daysInMonth(month, year){
    return 32 - new Date(year, month, 32).getDate();
}

function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function chooseDate() {
    let tempCell = document.getElementById('date');
    tempCell.removeAttribute('onclick');

    let newCell = "<select id='year'>";
    for(let i = (thisYear-100); i<(thisYear + 100); i++){
        newCell += "<option value=" + i + ((i === thisYear) ? " selected" : "") + ">" + i + "</option>";
    }
    newCell += "</select>";


    newCell += "<select id='month'>";
    for(let i = 0; i<12; i++){
        newCell += "<option value=" + i + ((i === thisMonth) ? " selected" : "") + ">" + monthName[i] + "</option>";
    }
    newCell += "</select>";
    newCell += "<button type='button' onclick='jump()'>OK</button>";
    tempCell.innerHTML = newCell;
}


function jump() {
    const selectMonth  = document.getElementById('month');
    const selectYear = document.getElementById('year');
    currentYear = parseInt(selectYear.value) || currentYear;
    currentMonth = parseInt(selectMonth.value) || currentMonth;
    showCalendar(currentMonth, currentYear);
}

function addZero(n){
    if(n <= 9){
        return "0" + n;
    }else{
        return n;
    }
}

showCalendar();
