function controller(){
    let password = document.getElementById("password");
    let passwordConfirm = document.getElementById("password-confirm");

    let error = document.getElementById("error");

    if(password.value!=passwordConfirm.value){
        error.innerHTML="**Le due Password non coincidono";
        return false;
    }else if(password.value.length<8){
        error.innerHTML="**La password è troppo corta<br>(Almeno 8 caratteri)";
        return false;
    }else if(password.value.match(/\d/)==null){
        error.innerHTML="**La password deve contenere un valore numerico";
        return false;
    }else if(password.value.match(/[A-Z]/)==null){
        error.innerHTML="**La password deve contenere un carattere maiuscolo";
        return false;
    }else if(password.value.match(/\s/)!=null){
        error.innerHTML="**La password non deve contenere spazi";
        return false;
    }else if(password.value.match(/[*.!@#%$&_]/)==null){
        error.innerHTML="**La password deve contenere un carattere speciale<br>(* @ # ! % & _ $)";
        return false;
    }else{
        return true;
    }
}