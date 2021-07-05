
const example0 = '<div class="asu-feedback-card col-12 col-md-8 d-flex flex-column flex-md-row my-2">\n' +
    '                    <div class="m-3 mt-4">\n' +
    '                        <img class="asu-avatar" src="/static/imgs/avatars/{avatar}">\n' +
    '                    </div>\n' +
    '                    <div class="container-fluid">\n' +
    '                        <div class="mt-2">\n' +
    '                            <strong>{name}, {city}</strong><br>\n' +
    '                            <strong>Группа: </strong>{group} <br>\n' +
    '                            <strong>Место работы:</strong> {workplace}<br>\n' +
    '                            <strong>Email:</strong> {email}<br>\n' +
    '                            <strong>Добавил отзыв с {from}</strong><br>\n' +
    '                        </div>\n' +
    '                        <hr>\n' +
    '                        <div>\n' +
    '                            <p>{review}</p>\n' +
    '                       </div>\n' +
    '                        <hr>\n' +
    '                        <div class="p-2 d-flex justify-content-end">\n' +
    '                            <button class="btn btn-info me-1" onclick="editFeed({id})">Редактировать</button>\n' +
    '                            <button class="btn btn-danger me-1" onclick="deny({id})">Отклонить</button>\n' +
    '                            <button class="btn btn-success me-1" onclick="accept({id})">Принять</button>\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                </div>';
    const example1 = '<div class="asu-feedback-card col-12 col-md-8 d-flex flex-column flex-md-row my-2">\n' +
    '                    <div class="m-3 mt-4">\n' +
    '                        <img class="asu-avatar" src="/static/imgs/avatars/{avatar}">\n' +
    '                    </div>\n' +
    '                    <div class="container-fluid">\n' +
    '                        <div class="mt-2">\n' +
    '                            <strong>{name}, {city}</strong><br>\n' +
    '                            <strong>Группа: </strong>{group} <br>\n' +
    '                            <strong>Место работы:</strong> {workplace}<br>\n' +
    '                            <strong>Email:</strong> {email}<br>\n' +
    '                            <strong>Добавил отзыв с {from}</strong><br>\n' +
    '                        </div>\n' +
    '                        <hr>\n' +
    '                        <div>\n' +
    '                            <p>{review}</p>\n' +
    '                       </div>\n' +
    '                        <hr>\n' +
    '                        <div class="p-2 d-flex justify-content-end">\n' +
    '                            <button class="btn btn-info me-1" onclick="editFeed({id})">Редактировать</button>\n' +
    '                            <button class="btn btn-danger me-1" onclick="deny({id})">Удалить</button>\n' +
    '                            {star}\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                </div>';
    const example2 = '<div class="asu-feedback-card col-12 col-md-8 d-flex flex-column flex-md-row my-2">\n' +
    '                    <div class="m-3 mt-4">\n' +
    '                        <img class="asu-avatar" src="/static/imgs/avatars/{avatar}">\n' +
    '                    </div>\n' +
    '                    <div class="container-fluid">\n' +
    '                        <div class="mt-2">\n' +
    '                            <strong>{name}, {city}</strong><br>\n' +
    '                            <strong>Группа: </strong>{group} <br>\n' +
    '                            <strong>Место работы:</strong> {workplace}<br>\n' +
    '                            <strong>Email:</strong> {email}<br>\n' +
    '                            <strong>Добавил отзыв с {from}</strong><br>\n' +
    '                        </div>\n' +
    '                        <hr>\n' +
    '                        <div>\n' +
    '                            <p>{review}</p>\n' +
    '                       </div>\n' +
    '                        <hr>\n' +
    '                        <div class="p-2 d-flex justify-content-end">\n' +
    '                            <button class="btn btn-info me-1" onclick="editFeed({id})">Редактировать</button>\n' +
    '                            <button class="btn btn-danger me-1" onclick="del({id})">Удалить</button>\n' +
    '                            <button class="btn btn-success me-1" onclick="accept({id})">Восстановить</button>\n' +
    '                        </div>\n' +
    '                    </div>\n' +
    '                </div>';


feedbacks = [];





$(document).ready(()=>{
    getFeeds();
    const data = {
        username: username,
        token: token,
        type: 0
    }
    $.get('/api/aGetFeedbacks', data, (e)=>{
        $("#count").html("+" + e.size)
    })
})
setInterval(()=>{
    const data = {
        username: username,
        token: token,
        type: 0
    }
    $.get('/api/aGetFeedbacks', data, (e)=>{
        $("#count").html("+" + e.size)
    })
}, 2500) 



let typeOfFeedbacks = 0;

const getFeeds = () =>{
    const data = {
        username: username,
        token: token,
        type: typeOfFeedbacks
    }
    feedbacks = [];
    $("#feedholder").empty();
    $.get('/api/aGetFeedbacks', data, (e)=>{
        const array = JSON.parse(JSON.stringify(e))
        let end = [];
        for(let i = 1; i <= e.size; i++){
            if(array[i].review == ""){
                end.push(array[i]);
            }else{
                feedbacks[i-1] = array[i];
                addFeedbacks(array[i]);
            }
        }
        for(let val of end){
            addFeedbacks(val);
        }
        if(e.size == 0){
            $("#feedholder").append("<h2 class=\"mt-2\">Пока отзывов нет!</h2>")
        }
        
    })
}

const addFeedbacks = (data) => {
    let e;
    if(typeOfFeedbacks == 0){
        e = example0;
    }else if(typeOfFeedbacks == 1){
        e = example1
    }else if(typeOfFeedbacks == 2){
        e = example2
    }

    let btn;
    if(data.favorites == 0){
        btn = '<button class="btn btn-outline-warning me-1 b{id}" onclick="toStar({id})">В избранное</button>';
    }else{
        btn = '<button class="btn btn-warning me-1 b{id}" onclick="toStar({id})">В избранном!</button>';
    }

    let card = e
        .replace('{name}', data.name)
        .replace('{city}', data.city)
        .replace('{avatar}', data.avatar_path)
        .replace('{group}', data.group)
        .replace('{workplace}', data.workplace)
        .replace('{email}', data.email)
        .replace('{review}', data.review)
        .replace('{id}', data.id)
        .replace('{id}', data.id)
        .replace('{star}', btn)
        if(data.from == 0){
            card = card.replace('{from}', "формы \"добавить отзыв\" ")
        }else if(data.from == 1){
            card = card.replace('{from}', "формы \"отметиться\"")    
        }else if(data.from == 2){
            card = card.replace('{from}', "формы на главной")    
        }else if(data.from == 3){
            card = card.replace('{from}', "формы на странице очерков")    
        }
        card = card.replace('{id}', data.id)
        .replace('{id}', data.id);
    $("#feedholder").append(card);
}

const update = () => {
    if(typeOfFeedbacks === 0){
        $('#await').addClass("active")
        $('#public').removeClass("active")
        $('#can').removeClass('active')
    }else if(typeOfFeedbacks === 1){
        $('#public').addClass("active")
        $('#await').removeClass("active")
        $('#can').removeClass('active')
    }else if(typeOfFeedbacks === 2){
        $('#can').addClass("active")
        $('#await').removeClass("active")
        $('#public').removeClass('active')
    }
}

const changeTypeOfFeedbacks = (type) =>{
    typeOfFeedbacks = type;
    getFeeds();
    update();
    const data = {
        username: username,
        token: token,
        type: 0
    }
    $.get('/api/aGetFeedbacks', data, (e)=>{
        $("#count").html("+" + e.size)
    })
}

const accept = (id) => {
    const data = {
        username: username,
        token: token,
        id: id
    }
    $.get('/admin/accept', data, (e)=>{
        changeTypeOfFeedbacks(typeOfFeedbacks);
        log("Отзыв был одобрен", '#3caa3c')
    })
    
}

const deny = (id) => {
    const data = {
        username: username,
        token: token,
        id: id
    }
    $.get('/admin/deny', data, (e)=>{
        changeTypeOfFeedbacks(typeOfFeedbacks);
        log("Отзыв был добавлен в корзину", '#ff2400')
    })
}

const del = (id) => {
    const res = confirm("Вы уверены?")
    if(res){
        const data = {
            username: username,
            token: token,
            id: id
        }
        $.get('/admin/delete', data, (e)=>{
            changeTypeOfFeedbacks(typeOfFeedbacks);
            log("Отзыв был удален", '#ff2400')
        })
    }
}

const toStar = (id) => {
    if($(".b" + id).hasClass("btn-outline-warning")){
        $(".b" + id).removeClass("btn-outline-warning")
        $(".b" + id).addClass("btn-warning")
        $(".b" + id).text("В избранном!")
        const data = {
            username: username,
            token: token,
            id: id,
            type: "add"
        }
        $.get('/admin/star', data, (e)=>{
            log("Отзыв был отмечен как избранный", '#f3da0b')
        })
    }else{
        $(".b" + id).addClass("btn-outline-warning")
        $(".b" + id).removeClass("btn-warning")
        $(".b" + id).text("В избранное")
        const data = {
            username: username,
            token: token,
            id: id,
            type: "remove"
        }
        $.get('/admin/star', data, (e)=>{
            log("Отзыв был убран из избранного", '#f3da0b')
        })
    }
    
}

update()
const myModal = new bootstrap.Modal(document.getElementById('editModal'))
const editFeed = (id)=>{
    $("#labelEdit").empty();
    $("#labelEdit").append('Редактировать отзыв с id ' + id);
    const data = {
        username: username,
        token: token,
        id: id
    }
    $.get('/api/aGetFeedbackById', data, (e)=>{
        myModal.show()
        e = JSON.parse(JSON.stringify(e))
        $("#mname").val(e.name);
        $("#memail").val(e.email);
        $("#mcity").val(e.city);
        $("#mworkplace").val(e.workplace);
        $("#mgroup").val(e.group);
        $("#mreview").val(e.review);
        $("#mid").val(e.id);
    })
    
}




const updateFeedback = () =>{
    const data = {
        username: username,
        token: token,
        id: $("#mid").val(),
        name: $("#mname").val(),
        group: $("#mgroup").val(),
        review: $("#mreview").val(),
        city: $("#mcity").val(),
        workplace: $("#mworkplace").val(),
        email: $("#memail").val(),
    }
    let isGood = true;
    if (!(data.name && data.name.trim().length)) {  
        $("#mname").addClass("is-invalid");
        isGood = false;
    }else{
        $("#mname").removeClass("is-invalid");
    }

    if (!(data.group && data.group.trim().length)) {  
        $("#mgroup").addClass("is-invalid");
        isGood = false;
    }else{
        $("#mgroup").removeClass("is-invalid");
    }

    if (!(data.city && data.city.trim().length)) {  
        $("#mcity").addClass("is-invalid");
        isGood = false;
    }else{
        $("#mcity").removeClass("is-invalid");
    }


    if (!(data.email && data.email.trim().length)) {  
        $("#memail").addClass("is-invalid");
        isGood = false;
    }else{
        $("#memail").removeClass("is-invalid");
    }

    if(isGood){
        $.post('/admin/edit', data, (e)=>{
            myModal.hide();
            changeTypeOfFeedbacks(typeOfFeedbacks);
            log("Отзыв был отредактирован", '#ffa500')
        })
    }
}

const moderModal = new bootstrap.Modal(document.getElementById('moderModal'))
const opeModer = ()=>{    
    moderModal.show();
}



