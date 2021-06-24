const clearLogs = () =>{
    const data = {
        username: username,
        token: token,
    }
    $.get('/admin/clearLogs', data, (e)=>{
        log("Логи сервера были очищены", '#3caa3c')
        window.location.reload();
    })
}