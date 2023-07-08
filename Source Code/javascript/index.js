let usrBtn = document.querySelector('.usrBtn')
let adBtn = document.querySelector('.adBtn')

let userLoginForm = document.querySelector('.userLoginForm')
let managerLoginForm = document.querySelector('.managerLoginForm')

adBtn.addEventListener('click', function(){
    userLoginForm.style.transform = "translateX(-400px)"
    managerLoginForm.style.transform = "translateX(0px)"

    usrBtn.style.padding = "10px"
    adBtn.style.padding = "15px"
})

usrBtn.addEventListener('click', function() {
    managerLoginForm.style.transform = "translateX(400px)"
    userLoginForm.style.transform = "translateX(0px)"

    usrBtn.style.padding = "15px"
    adBtn.style.padding = "10px"
})