$(() => {
    let isCorrectValue = false;
    let isCorrectBlank = false;
    let checkValue = function() {
        const val = $('#email').val();
        if(!val.match(/.+@.+\..+/)) {
            $('#mail').remove();
            $('#mes').append(`<span id="mail" class="error">メールアドレスを正しい形式で入力してください
                （例）test@example.com</span>`);
            isCorrectValue = false;
        } else {
            $('#mail').remove();
            isCorrectValue = true;
        }
    }

    let checkBlank = function() {
        if ($('#email').val() === ""
        && $('#passwd').val() === "") {
            alert("メールアドレスおよびパスワードを入力してください");
            isCorrectBlank = false;
        } else if($('#email').val() === "") {
            alert("メールアドレスを入力してください");
            isCorrectBlank = false;
        } else if($('#passwd').val() === "") {
            alert("パスワードを入力してください");
            isCorrectBlank = false;
        } else {
            isCorrectBlank = true;
        }
    };
    
    let sendData = function() {
        checkBlank();
	    if (!isCorrectBlank) {
		    return false;
	    }
        checkValue();
        if (!isCorrectValue) {
            return false;
        }
        let jsonString = {
            'email': $('#email').val(),
            'passwd': $('#passwd').val(),
            'csrf_token': $('#csrf_token').val()
        };
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: JSON.stringify(jsonString),
            contentType: 'application/json',
            dataType: 'json',
        }).done(function(data) {
            if (data.is_success === true) {
                window.location.href = '/welcome.php';
            } else if (data.is_invalid_request === true) {
                $('#mail_passwd').remove();
                $('#request').remove();
                $('#mes').append('<span id="request" class="error">不正なリクエストです</span>');
            } else {
                $('#request').remove();
                $('#mail_passwd').remove();
                $('#mes').append('<span id="mail_passwd" class="error">メールアドレスまたはパスワードが違います</span>');
            }
        }).fail(function (data) {
            alert("エラー：通信に失敗しました");
        });
    };
    
    $('#submit_btn').on('click', sendData);

    const form = document.getElementById('main_form');

    form.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            sendData(); // フォームを送信
        }
        return false;
    });

});