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
const pageExample = '<a onclick="update({num})">{num}</a>';
const cardOnScreen = 5
let feedbackList = [];
let nowPage = 1;

$(document).ready(()=>{
    $.get('/api/getFeedbacks', null, (e)=>{
        const array = JSON.parse(JSON.stringify(e))
        feedbackList = array
        render(nowPage);
        if(feedbackList['size'] > cardOnScreen){
            for(let i = 1; i < e.size/cardOnScreen+1; i++){
                $("#pages").append(pageExample.replace("{num}", i).replace("{num}", i).replace("{num}", i))
            }
        }
    })
})

const render = (pageNum) => {
    $("#placeholder").empty()
    for(let i = (pageNum-1)*cardOnScreen+1; i <= (pageNum-1)*cardOnScreen + cardOnScreen; i++){
            const card = exampleCard.replace('{name}', feedbackList[i]['name'])
                .replace('{city}', feedbackList[i]['city'])
                .replace('{group}', feedbackList[i]['group'])
                .replace('{review}', feedbackList[i]['review'])
                .replace('{avatar}', feedbackList[i]['avatar_path'])
            $('#placeholder').append(card);
    }
}

const update = (num) =>{
    nowPage = num;
    render(nowPage);
}


const myModal = new bootstrap.Modal(document.getElementById('feedbackModal'))
const openModal = () => {
    myModal.show()
}

function strip(html)
{
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent||tmp.innerText;
}

const addFeedback = () => {
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





