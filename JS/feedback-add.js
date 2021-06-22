const addFeedback = () => {
    let isGood = true;
    if (isEmpty($("#name").val()))
    {
        $("#name").addClass("is-invalid");
        isGood = false;
    }
    else {
        $("#name").removeClass("is-invalid");
        $("#name").addClass("is-valid");
    }
    if (isEmpty($("#email").val()))
    {
        $("#email").addClass("is-invalid");
        isGood = false;
    }else {
        if(ValidMail($("#email").val())){
            $("#email").removeClass("is-invalid");
            $("#email").addClass("is-valid");
        }else {
            $("#email").addClass("is-invalid");
            isGood = false;
        }
    }
    if (isEmpty($("#city").val()))
    {
        $("#city").addClass("is-invalid");
        isGood = false;
    }else {
        $("#city").removeClass("is-invalid");
        $("#city").addClass("is-valid");
    }
    if (!isGood){
        return
    }
    const data = new FormData(document.getElementById('feedForm'))
    data.set("review", strip(data.get('review')));
    $.ajax({
        // Your server script to process the upload
        url: '/api/addFeedback',
        type: 'POST',

        // Form data
        data: data,
        // Tell jQuery not to process data or worry about content-type
        // You *must* include these options!
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        complete: (e) => {
            console.log(e)
        }
    })
}

const generateGroup = ()=>{
    let now = new Date();
    let groupArray = [];
    for (let i = 1970; i < now.getFullYear()-3 ; i++) {
        let year = String(i).substring(2,4);
        if(i >= 2011){
            groupArray.push("АСУб-" + year);
        }else {
            groupArray.push("АСУ-" + year);
        }
    }
    let example = "<option>{g}</option>";
    for (const nowKey in groupArray) {
        $("#group").append(example.replace("{g}", groupArray[nowKey]));
    }
}
const myModal = new bootstrap.Modal(document.getElementById('feedbackModal'))
const openModal = (from) => {
    $("#fromValue").val(from)
    if(from == 1){
        $("#prompt").text("Также можете оставить отзыв:")
    }else{
        $("#prompt").text("Отзыв:")
    }
    myModal.show()
}
function ValidMail(mail) {
    let re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    return re.test(mail);
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}

function strip(html)
{
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent||tmp.innerText;
}
generateGroup();