const onSwitch = () =>{
    const data = {
        username: username,
        token: token,
        property: 'openToFeeds',
        value: $("#openToFeedsSwitch").prop('checked')
    }
    $.post('/admin/changeProperty', data, (e)=>{
        log("Настройки были обновлены", '#3caa3c')
    })
}

const changeMail = () => {
    const data = {
        username: username,
        token: token,
        property: 'adminMail',
        value: $("#adminEmail").val()
    }
    $.post('/admin/changeProperty', data, (e)=>{
        log("Email был изменен!", '#3caa3c')
    })
}

const updateShablon = () => {
    let data = {
        username: username,
        token: token,
        property: 'feedbackMessageTitle',
        value: $(".in-stitle").val()
    }
    $.post('/admin/changeProperty', data)
    
    data = {
        username: username,
        token: token,
        property: 'acceptMessage',
        value: $(".in-atext").val()
    }
    $.post('/admin/changeProperty', data)

    data = {
        username: username,
        token: token,
        property: 'denyMessage',
        value: $(".in-dtext").val()
    }
    $.post('/admin/changeProperty', data)

    data = {
        username: username,
        token: token,
        property: 'footerMessage',
        value: $(".in-ftext").val()
    }
    $.post('/admin/changeProperty', data)
    log("Шаблон был обновлен!", '#3caa3c')
}