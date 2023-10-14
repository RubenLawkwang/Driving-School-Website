
function fetchLS(){
    document.querySelector("#txtemail").value = localStorage.getItem("svem");
    document.querySelector("#txtpass").value = localStorage.getItem("svpwd");
    }
    window.addEventListener("load", fetchLS);
    function remem(){
    var chk = document.querySelector("#chkrem");
    if (chk.checked){
    var em = document.querySelector("#txtemail").value;
    var pwd = document.querySelector("#txtpass").value;
    localStorage.setItem("svem", em);
    localStorage.setItem("svpwd", pwd);
    }
    else{
    localStorage.removeItem("svem");
    localStorage.removeItem("svpwd");
    }
    }