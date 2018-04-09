function UserDelete(ItemNumber) {

    let ItemInput = document.getElementById('idInput'+ItemNumber);

    SendRequestGet(
        '?r=second/userdelete&id='+ItemInput.attributes['idItem'].value,
        ''
        ,
        function UserDelete(respond) {

            document.location.reload();

        }
    );

}


function UserAdd(ItemNumber) {

    let ItemInputLogin = document.getElementById('idInputAddLogin');
    let ItemInputPassword = document.getElementById('idInputAddPassword');

    SendRequestGet(
        '?r=second/useradd&login='+encodeURIComponent(ItemInputLogin.value)+
        '&password='+encodeURIComponent(ItemInputPassword.value),
        '',
        function UserAdd(respond) {

            document.location.reload();

        }
    );

}


function PasswordWrite(ItemNumber) {

    let ItemInput = document.getElementById('idInput'+ItemNumber);

    SendRequestGet(
        '?r=second/passwordchange&id='+ItemInput.attributes['idItem'].value+
        '&password='+encodeURIComponent(ItemInput.value),
        '',
        function UserAdd(respond) {

            document.location.reload();

        }
    );

}
function PasswordChange(ItemNumber, KeyCode) {

    if ((KeyCode === 9 ) || (KeyCode >= 37 && KeyCode <= 40)) return;

    if (KeyCode === 13) {
        PasswordWrite(ItemNumber);
        return;
    }

    let ItemInput = document.getElementById('idInput'+ItemNumber);

    ItemInput.style.borderColor = 'red';

    document.getElementById('idButton'+ItemNumber).style.display = 'block';
}

function PhoneWrite(ItemNumber) {

    let ItemInput = document.getElementById('idInput'+ItemNumber);

    SendRequestPost(
        '/ats/phone_change',
        'idUser='+encodeURIComponent(ItemInput.attributes['idItem'].value)
        +"&Phone="+encodeURIComponent(ItemInput.value),
        function ChangePhoneItem(respond) {
            let Result = JSON.parse(respond.responseText);
            if( Result.response === 200 ){
                ItemInput.style.borderColor = '';
                document.getElementById('idButton'+ItemNumber).style.display = 'none';
                return true;

            }
            else {
                alert('ОШИБКА: ' + Result.text );
            }

        }
    );


}
