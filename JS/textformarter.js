const dataExample = {
    name: "Анатолий Кузнецов",
    email: "m@ya.ru",
    city: "Иркутск",
    group: "АСУб 18-2",

}

const textUpdate = () =>{
    const text = $(".in").val();
    $(".out").val(textRefactor(text));
}

const textRefactor = (text) =>{
    const searchRegName = /%name%/g;
    const searchRegEmail = /%email%/g;
    const searchRegCity = /%city%/g;
    const searchRegGroup = /%group%/g;
    return text.replace(searchRegName, dataExample.name).replace(searchRegEmail, dataExample.email)
                       .replace(searchRegCity, dataExample.city).replace(searchRegGroup, dataExample.group);
    
}