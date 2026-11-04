function changeInput(idI, idL){

    let input = document.getElementById(idI);
    let label = document.getElementById(idL);
    if(!input.classList.contains('active') && !label.classList.contains('active')){
        input.classList.add('active');
        label.classList.add('active');
    }else if(input.value==""){
        input.classList.remove('active');
        label.classList.remove('active');
    }

}

function changeType(id){

    let input=document.getElementById(id);
    if(input.type=="password"){
        input.type="text";
    }else{
        input.type="password";
    }

}