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

let approveDialog = document.querySelector('.approveDialog')

let rejectDialog = document.querySelector('.rejectDialog')

document.querySelectorAll('.approveBtn').forEach(occurence => {
    occurence.addEventListener('click', function() {
        approveDialog.showModal()
    } )
})

document.querySelectorAll('.rejectBtn').forEach(occurence => {
    occurence.addEventListener('click', function() {
        rejectDialog.showModal()
    } )
})

document.querySelectorAll('.closeApproveDialog').forEach(occurence => {
    occurence.addEventListener('click', function() {
        approveDialog.classList.add('hide')
        approveDialog.addEventListener('webkitAnimationEnd', function(){
            approveDialog.classList.remove('hide');
            approveDialog.close();
            approveDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
      }, false)
    } )
})

document.querySelectorAll('.closeRejectDialog').forEach(occurence => {
    occurence.addEventListener('click', function() {
        rejectDialog.classList.add('hide')
        rejectDialog.addEventListener('webkitAnimationEnd', function(){
            rejectDialog.classList.remove('hide');
            rejectDialog.close();
            rejectDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
      }, false)
    } )
})

let viewLeavesBtn = document.querySelector('.viewLeavesBtn')
let viewLeavesDialog = document.querySelector('.viewLeavesDialog')
let closeViewDialog = document.querySelector('.closeViewDialog')

if(viewLeavesBtn) {
    viewLeavesBtn.addEventListener('click', function() {
        viewLeavesDialog.showModal()
    })
}

closeViewDialog.addEventListener('click', function() {
    viewLeavesDialog.classList.add('hide')
        viewLeavesDialog.addEventListener('webkitAnimationEnd', function(){
            viewLeavesDialog.classList.remove('hide');
            viewLeavesDialog.close();
            viewLeavesDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
      }, false)
})

let viewEmployeesBtn = document.querySelector('.viewEmployeesBtn')
let viewEmployeesDialog = document.querySelector('.viewEmployeesDialog')
let closeViewEmployeesDialog = document.querySelector('.closeViewEmployeesDialog')

viewEmployeesBtn.addEventListener('click', function() {
    viewEmployeesDialog.showModal()
})

closeViewEmployeesDialog.addEventListener('click', function() {
    viewEmployeesDialog.classList.add('hide')
        viewEmployeesDialog.addEventListener('webkitAnimationEnd', function(){
            viewEmployeesDialog.classList.remove('hide');
            viewEmployeesDialog.close();
            viewEmployeesDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
      }, false)
})

let addEmployeesBtn = document.querySelector('.addEmployeesBtn')
let addEmployeesDialog = document.querySelector('.addEmployeesDialog')
let closeAddEmployeesDialog = document.querySelector('.closeAddEmployeesDialog')

addEmployeesBtn.addEventListener('click', function() {
    addEmployeesDialog.showModal()
})

closeAddEmployeesDialog.addEventListener('click', function() {
    addEmployeesDialog.classList.add('hide')
        addEmployeesDialog.addEventListener('webkitAnimationEnd', function(){
            addEmployeesDialog.classList.remove('hide');
            addEmployeesDialog.close();
            addEmployeesDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
      }, false)
})

let deleteDialog = document.querySelector('.deleteDialog')

document.querySelectorAll('.deleteBtn').forEach(occurence => {
    occurence.addEventListener('click', function() {
        deleteDialog.showModal()
    } )
})

document.querySelectorAll('.closeDeleteDialog').forEach(occurence => {
    occurence.addEventListener('click', function() {
        deleteDialog.classList.add('hide')
        deleteDialog.addEventListener('webkitAnimationEnd', function(){
            deleteDialog.classList.remove('hide');
            deleteDialog.close();
            deleteDialog.removeEventListener('webkitAnimationEnd',  arguments.callee, false);
      }, false)
    } )
})

function validateForm() {
    let email = document.addEmpForm.email.value
    let contactNo = document.addEmpForm.contactNo.value

    // Regular expressions for email and contact number validation
    let emailRegex = /^\w+@company\.com$/
    let contactNoRegex = /^01\d{8}$/

    // Validate email and contactNo
    if (!emailRegex.test(email) || !contactNoRegex.test(contactNo)) {
        addEmployeesDialog.close()
        Swal.fire({
            icon: 'error',
            text: 'Invalid email or contact number format. Please try again',
            showConfirmButton: true,
            allowOutsideClick: false
        })
        return false
    }
    else {
        return true
    }
}