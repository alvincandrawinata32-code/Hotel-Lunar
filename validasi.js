document.addEventListener("DOMContentLoaded",()=>{
    const form=document.getElementById("passwordForm");

    if(form){
        form.addEventListener("submit",function(event){
            const passInput=document.getElementById("password");
            const confirmInput=document.getElementById("confirm_password");

            const passError=document.getElementById("passError");
            const confirmError=document.getElementById("confirmError");

            let isValid=true;

            if(passInput.value.length<8){
                passError.innerText="Password minimal 8 karakter";
                isValid=false;
            } else {
                passError.innerText="";
            }

            if(passInput.value!==confirmInput.value){
                confirmError.innerText="Konfirmasi password tidak cocok";
                isValid=false;
            } else {
                confirmError.innerText="";
            }

            if(!isValid){
                event.preventDefault();
            }
        });
    }
});