const exampleCard = '<div class="asu-feedback-card col-12 col-md-8 d-flex flex-column flex-md-row my-2">\n' +
    '                <div class="m-3 mt-4">\n' +
    '                    <img class="asu-avatar" src="/static/imgs/avatars/{avatar}">\n' +
    '                </div>\n' +
    '                <div class="container-fluid">\n' +
    '                    <div class="mt-3">\n' +
    '                        <strong>{name}, {city}</strong><br>\n' +
    '                        <strong>Группа: </strong>{group}\n' +
    '                    </div>\n' +
    '                    <hr>\n' +
    '                    <div>\n' +
    '                        <p>{review}</p>\n' +
    '                    </div>\n' +
    '                </div>\n' +
    '            </div>'
const pageExample = '<li class="page-item" style="cursor: pointer"><a class="page-link" onclick="update({num})">{num}</a></li>'
const pageActiveExample = '<li class="page-item active"><a class="page-link")">{num}</a></li>'
const cardOnScreen = 5
let feedbackList = [];
let nowPage = 1;

const getGet = (name)=>{
    var s = window.location.search;
    s = s.match(new RegExp(name + '=([^&=]+)'));
    return s ? s[1] : false;
}

const pageReload = ()=>{
    generateGroup()
    let data;
    if(getGet('sort') === false){
        data = {
            sort: "new"
        }
    }else{
        data = {
            sort: getGet('sort')
        }
    }
    if(data.sort == "new"){
        $("#s_new").addClass("hover");
    }else if(data.sort == "old"){
        $("#s_old").addClass("hover");
    }
    $.get('/api/getFeedbacks', data, (e)=>{
        const array = JSON.parse(JSON.stringify(e))
        feedbackList = array
        render(nowPage);
        $("#pages")
        if(feedbackList['size'] > cardOnScreen){
            for(let i = 1; i < e.size/cardOnScreen+1; i++){
                if(i == nowPage){
                    $("#pages").append(pageActiveExample.replace("{num}", i).replace("{num}", i))
                }else{
                    $("#pages").append(pageExample.replace("{num}", i).replace("{num}", i))
                }
            }
        }
    })
}

const render = (pageNum) => {
    $("#placeholder").empty()
    for(let i = (pageNum-1)*cardOnScreen+1; i <= (pageNum-1)*cardOnScreen + cardOnScreen; i++){
            if(feedbackList[i] != null){
                const card = exampleCard.replace('{name}', feedbackList[i]['name'])
                .replace('{city}', feedbackList[i]['city'])
                .replace('{group}', feedbackList[i]['group'])
                .replace('{review}', feedbackList[i]['review'])
                .replace('{avatar}', feedbackList[i]['avatar_path'])
            $('#placeholder').append(card);
            }
            
    }
}

const update = (num) =>{
    nowPage = num;
    $("#pages").empty();
    if(feedbackList['size'] > cardOnScreen){
        for(let i = 1; i < feedbackList.size/cardOnScreen+1; i++){
            if(i == nowPage){
                $("#pages").append(pageActiveExample.replace("{num}", i).replace("{num}", i))
            }else{
                $("#pages").append(pageExample.replace("{num}", i).replace("{num}", i))
            }
            }
        }
    render(nowPage);
    const el = document.getElementById('scrollUp');
    el.scrollIntoView();
    
}

const alertModal = new bootstrap.Modal(document.getElementById('alertModal'))
const showAlert = () => {
    alertModal.show()
}
const closeAlert = () =>{
    alertModal.hide();
}

const myModal = new bootstrap.Modal(document.getElementById('feedbackModal'))
const openModal = () => {
    myModal.show()
}
const closeModal = () =>{
    myModal.hide()
}

function strip(html)
{
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent||tmp.innerText;
}

function ValidMail(mail) {
    let re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    return re.test(mail);
}

function isEmpty(str) {
    return (!str || 0 === str.length);
}

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
        url: '/api/addFeedback',
        type: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        complete: (e) => {
            closeModal();
            showAlert();
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

pageReload();



