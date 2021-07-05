const dataExample = {
    name: "Анатолий Кузнецов",
    email: "m@ya.ru",
    city: "Иркутск",
    group: "АСУб 18-2",

}

const textUpdate = () =>{
    const title = $(".in-title").val();
    const text = $(".in-text").val();
    const stitle = $(".in-stitle").val();
    const atext = $(".in-atext").val();
    const dtext = $(".in-dtext").val();
    const ftext = $(".in-ftext").val();
    $(".out-text").val(textRefactor(text));
    $(".out-title").val(textRefactor(title));
    $(".out-stitle").val(textRefactor(stitle));
    $(".out-atext").val(textRefactor(atext));
    $(".out-dtext").val(textRefactor(dtext));
    $(".out-ftext").val(textRefactor(ftext));
}

const textRefactor = (text) =>{
    const searchRegName = /%name%/g;
    const searchRegEmail = /%email%/g;
    const searchRegCity = /%city%/g;
    const searchRegGroup = /%group%/g;
    return text.replace(searchRegName, dataExample.name).replace(searchRegEmail, dataExample.email)
                       .replace(searchRegCity, dataExample.city).replace(searchRegGroup, dataExample.group);
    
}

const toSend = () => {
    const title = $(".in-title").val();
    const text = $(".in-text").val();
    const data = {
        username: username,
        token: token,
        title: title,
        message: text
    }
    const check = confirm("Вы уверенны? Сообщение будет отправлено на все одобренные email.")
    if(check){
        log("Сообщения отправленны!", '#3caa3c')
        $.post('/admin/massSendMail', data)
    }
}

textUpdate()