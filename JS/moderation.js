feedbacks = [];

const data = {
    username: username,
    token: token
}

let typeOfFeedbacks = 0;



const render = () =>{
    fr
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


$.get('/api/aGetFeedbacks', data, (e)=>{
    const array = JSON.parse(JSON.stringify(e))
    for(let i = 1; i <= e.size; i++){
        feedbacks[i-1] = array[i];
    }
    console.log(feedbacks)
})

update()