
function addRow(data){
    return '<tr><td>' + data.url + '</td><td>' + '<a href="/' + data.url_short + '">' + data.url_short + '</a></td></tr>';
}

$("#form").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        dataType: 'JSON',
        url: '/',
        data: $('#form').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $('tbody').find('tr:first').before(addRow(data));
            $('#validationServerUsernameFeedback').css("display","none");
            $('#noLinks').remove();
        },
        error:  function(xhr, str){
            $('#validationServerUsernameFeedback').css("display","block");
        }
    });
});
