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