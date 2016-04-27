function add() {
    // if input textbox has nothing = do nothing
    if ($('#userInput').val() != "") {
        $('ul#toDoList').prepend(
            '<li style="line-height: 50px;"><input type="checkbox" class="finish">' +
            $('input#userInput').val() +
            '<button type="button" class="btn btn-danger" id="delete">刪除</button></li>'
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
        $(this).parent().css('textDecoration', 'none');
    } else {
        $(this).parent().css('textDecoration', 'line-through');
    }
}

// after document had totally loaded
$(document).ready(function() {

    // if click add btn
    $("#add").on('click', add);
    $(document).on('click', '#delete', del);
    $(document).on('click', '.finish', done);

});
