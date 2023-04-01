let btnReg=document.querySelector('#btn-reg');
let form=document.querySelector('form');
let message=document.querySelector('#message');
function reg(e){
    e.preventDefault();

    //УСТАНАВЛИВАЕМ ПЕРЕДАВАЕМЫЕ ДАННЫЕ
    const data=new FormData(form);

    //ДЕЛАЕМ ЗАПРОС
    let xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            let response=xhttp.response;
            if (response.status==='success'){
                location.href='/Project_AJAX_Login_Register/index.php';
            }else if(response.status==='error'){
                message.textContent=response.message;
                message.classList.remove('hidden');
                message.classList.add('err');
                let elemRed=document.querySelector(`input[name="${response.where}"]`);
                elemRed.classList.add('redinput');
                elemRed.addEventListener('change',()=>{
                    elemRed.classList.remove('redinput')
                    message.classList.add('hidden')
                })
            }
        }
    }
    xhttp.open('POST','/Project_AJAX_Login_Register/signup.php', true);
    xhttp.responseType='json';
    xhttp.send(data);
}
btnReg.addEventListener("click", reg);