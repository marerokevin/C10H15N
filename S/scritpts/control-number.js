function getInitials(firstName, lastName) {
    return (firstName[0] + lastName[0]).toUpperCase()
}

function getYear() {
    return (new Date).getFullYear() % 100
}

function paddedNumber(number) {
    var result = ""
    for(var i = 4 - number.toString().length; i > 0; i--) {
    result += "0"
    }
    return result + number
}

function makeStudentID(firstName, lastName, studentNumber) {
    return getInitials(firstName, lastName) + paddedNumber(studentNumber) + getYear()
}

var sequenceNumber = 1
function gatherDataAndOutput() {
    var firstName = document.getElementById("disaster_desc").value
    var lastName = document.getElementById("disaster_type").value
    var outputElement = document.getElementById("dis_control_number")

    outputElement.value = makeStudentID(firstName, lastName, sequenceNumber)

    sequenceNumber++; // make a different ID for the next student.
}