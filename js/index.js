$(document).ready(()=>{
const titlefield = $("#title"),
  notifications = $("#notifications"),
  inputfields = $("input"),
  usernamefield = $("#username"),
  passwordfield = $("#password"),
  forgotpasswordfield = $("#forgotpassword"),
  signinbutton=$("#signin")

  let currentmenu="signin"

  inputfields.on("input",()=>{
    notifications.html("")
  })

  usernamefield.focus()

  usernamefield.on("keydown",function(e){
    //console.log(e)
    if(e.keyCode==13){
        passwordfield.focus()
    }
  })

  passwordfield.on("keypress",function(e){
    if(e.keyCode==13){
        signinbutton.trigger("click")
    }
  })

titlefield.html("System Login")
signinbutton.removeClass("disabled")


  signinbutton.on("click",()=>{
    notifications.html("")
    if(currentmenu=="signin"){
        usernamefield.focus()
        const username=(usernamefield.val()),
        password=(passwordfield.val())
    let errors=""
    if(username==""){
        errors="Please provide username"
        usernamefield.focus()
    } else if (password==""){
        errors="Please provide password"
        passwordfield.focus()
    }

    if(errors==""){
        notifications.html(showAlert("processing","Processing.Please wait ..."))
        $.post(
            "apis/controllers/useroperations.php",
            {
                loginuser:true,
                username,
                pwd
            },
            (data)=>{
                if(isJSON(data)){
                    data=JSON.parse(data)
                    if(data.status=="success"){
                        window.location.href="views/dashboard.php"
                    }else if(data.status=="invalid"){
                      notifications.html(showAlert("info",`Invalid username or password`))  
                    }else if(data.status=="inactive"){
                     notifications.html(showAlert("info",`Account inactive.Contact system administrator`))   
                    }/*else if(data.status=="change password"){
                     notifications.html(showAlert("info","Please change your password before proceeding",1))   
                    } */
                }else{
                    notifications.html(showAlert("danger",`Sorry an error occurred ${data}`))
                }
            
            }
        )
    }else{
        notifications.html(showAlert("info",errors))
    }
    }
  })

})