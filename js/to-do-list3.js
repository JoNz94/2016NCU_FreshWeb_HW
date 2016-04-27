function add() {
    // if input textbox has nothing = do nothing
    if ($('#userInput').val() != "") {
        $('div#toDoList').prepend(
            '<div class="row" style="line-height: 50px;"><input type="checkbox" class="done">　<span>' +
            $('input#userInput').val() +
            '</span>　<button type="button" class="btn btn-danger" id="delete">刪除</button></div>'
        );

        // reset input textbox
        $('#userInput').val('');
    }
}

function del() {
    $(this).parent().remove();
}

function done() {
    if (!$(this).prop('checked')) {
        $(this).parent().children('span').css('textDecoration', 'none');
    } else {
        $(this).parent().children('span').css('textDecoration', 'line-through');
    }
}

// after document had totally loaded
$(document).ready(function() {

    // if click add btn
    $("#add").on('click', add);
    $(document).on('click', '#delete', del);
    $(document).on('click', '.done', done);

});
