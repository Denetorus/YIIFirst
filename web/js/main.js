$(document).ready(function () {

    let btnATS = document.getElementById('btnATS');
    let btnEMAIL = document.getElementById('btnEMAIL');

    btnATS.onclick = function btnATSonClick() {
        alert("You click button ATS");
    };
    btnEMAIL.onclick = function btnEMAILonClick() {
        alert("You click button EMAIL");
    };

});