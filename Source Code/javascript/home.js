let dropdownContent = document.querySelector('.dropdown-content')
let dropdown = document.querySelector('header button')
let dropbtn = document.querySelector('.fa-caret-down')

function showMenu() {

    dropbtn.style.transition = '0.4s'

    if(dropbtn.style.transform === 'rotate(90deg)' || dropdownContent.style.display === 'block') {
        dropbtn.style.transform = 'rotate(0deg)'
        dropdownContent.style.display = 'none'
    }
    else {
        dropbtn.style.transform = 'rotate(90deg)'
        dropdownContent.style.display = 'block'
    }
}

let editDialog = document.querySelector('.editDialog')

document.querySelectorAll('.editBtn').forEach(occurence => {
    occurence.addEventListener('click', function() {
        editDialog.showModal()
    } )
})

document.querySelectorAll('.closeEditDialog').forEach(occurence => {
    occurence.addEventListener('click', function() {
        editDialog.classList.add('hide')
        editDialog.addEventListener('webkitAnimationEnd', function(){
            editDialog.classList.remove('hide');
            editDialog.close();
            editDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
      }, false)
    } )
})

let applyDialog = document.querySelector('.applyDialog')
let closeApplyDialog = document.querySelector(".closeApplyDialog")
let newBtn = document.querySelector('.newBtn')

newBtn.addEventListener('click', function() {
    applyDialog.showModal()
})

closeApplyDialog.addEventListener('click', function(){
    applyDialog.classList.add('hide')
      applyDialog.addEventListener('webkitAnimationEnd', function(){
          applyDialog.classList.remove('hide');
          applyDialog.close();
          applyDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
    }, false)
})
