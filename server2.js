let title = documentq.getElemtbyId('user')
inputUname.addEventListener('input',function(){

    if(inputUname.value != ""){

        user.innerText = inputUname.value
    
    }else{
        user.innerText = 'NOM'
    }

})