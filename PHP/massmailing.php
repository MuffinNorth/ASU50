<div class="container mt-5">
    <div class="card">
        <h5 class="card-header">Шаблон письма</h5>
        <div class="card-body">
            <div>
                <label for="mail">Заголовок письма:</label>
                <input type="text" class="form-control">
            </div>
            <div>
                <label for="mail">Текст письма:</label>
                <textarea class="form-control in" name="mail" rows="12" onkeyup="textUpdate()"></textarea>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <h5 class="card-header">Предпросмотр</h5>
        <div class="card-body">
            <div>
                <label for="mail">Текст письма:</label>
                <textarea class="form-control out" name="mail" rows="12" disabled></textarea>
            </div>
        </div>
    </div>
    <div class="card mt-1">
        <h5 class="card-header">Отправить</h5>
        <div class="card-body">
            <button class="btn btn-info">Отправить на все подтвержденные!</button>
        </div>
    </div>
</div>

