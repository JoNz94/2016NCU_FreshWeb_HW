function add() {
    // if input textbox has nothing = do nothing
    if ($('#userInput').val() != "") {
        $('table#toDoList').prepend(
            '<tr style="line-height: 50px;"><td><input type="checkbox" class="done"></td><td>　<span>' +
            $('input#userInput').val() +
            '</span>　</td><td><button type="button" class="btn btn-danger" id="delete">刪除</button></td></tr>'
        );

        // reset input textbox
        $('#userInput').val('');
    }
}

function del() {
    $(this).parent().parent().remove();
}

function done() {
    if (!$(this).prop('checked')) {
        $(this).parent().siblings().children('span').css('textDecoration', 'none');
    } else {
        $(this).parent().siblings().children('span').css('textDecoration', 'line-through');
    }
}

// after document had totally loaded
$(document).ready(function() {

    // if click add btn
    $("#add").on('click', add);
    $(document).on('click', '#delete', del);
    $(document).on('click', '.done', done);

});
