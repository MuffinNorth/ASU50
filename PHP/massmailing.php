<div class="container mt-5">
    <div class="card">
        <h5 class="card-header">Шаблон письма</h5>
        <div class="card-body">
            <div class="alert alert-primary" role="alert">
                Обратите внимание, что для форматирование текста сообщения, Вы, можете использовать следующие ключевые слова:
                <ul >
                    <li><b>%name%</b> - заменяется на <b>имя</b> получателя</li>
                    <li><b>%city%</b> - заменяется на <b>город</b> получателя</li>
                    <li><b>%group%</b> - заменяется на <b>группу</b> получателя</li>
                    <li><b>%email%</b> - заменяется на <b>почту</b> получателя</li>
                </ul>
            </div>
            <div>
                <label for="mail">Заголовок письма:</label>
                <input type="text" class="form-control in-title"  onkeyup="textUpdate()">
            </div>
            <div>
                <label for="mail">Текст письма:</label>
                <textarea class="form-control in-text" name="mail" rows="12" onkeyup="textUpdate()"></textarea>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <h5 class="card-header">Предпросмотр</h5>
        <div class="card-body">
            <div>
                <label for="mail">Заголовок письма:</label>
                <input type="text" class="form-control out-title" disabled>
            </div>
            <div>
                <label for="mail">Текст письма:</label>
                <textarea class="form-control out-text" name="mail" rows="12" disabled></textarea>
            </div>
        </div>
    </div>
    <div class="card mt-1">
        <h5 class="card-header">Отправить</h5>
        <div class="card-body">
            <button class="btn btn-info" onclick="toSend()">Отправить на все подтвержденные!</button>
        </div>
    </div>
</div>

