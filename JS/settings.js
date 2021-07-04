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