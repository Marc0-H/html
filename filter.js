let subjectEl = document.getElementById('filter-option-subject');
let subjectDropdownEl = document.getElementById('dropdown-subject');
let sortbyEl = document.getElementById('filter-option-sortby');
let sortbyDropdownEl = document.getElementById('dropdown-sortby');
let userRoleEl = document.getElementById('filter-option-user-role');
let userRoleDropdownEl = document.getElementById('dropdown-user-role');

let actionBtnEl = document.getElementById('action-button');
let actionDropdownEl = document.getElementsByClassName('action-options')[0];

subjectEl.addEventListener("click", () => {
    toggleDropdown(subjectEl, subjectDropdownEl)
});

sortbyEl.addEventListener("click", () => {
    toggleDropdown(sortbyEl, sortbyDropdownEl)
});

userRoleEl.addEventListener("click", () => {
    toggleDropdown(userRoleEl, userRoleDropdownEl)
});

actionBtnEl.addEventListener("click", () => {
    if (actionDropdownEl.style.display === "block") {
        actionDropdownEl.style.display = "none";
    } else {
        actionDropdownEl.style.display = "block";
    }
});

function toggleDropdown(buttonEl, dropdownEl) {
    if (dropdownEl.style.display === "block") {
        buttonEl.getElementsByClassName('dropdown-button-icon')[0].style.transform = 'rotate(0deg)';
        dropdownEl.style.display = "none";
    } else {
        dropdownEl.style.display = 'block';
        buttonEl.getElementsByClassName('dropdown-button-icon')[0].style.transform = 'rotate(180deg)';
    }
}