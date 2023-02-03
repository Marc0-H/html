let sortbyEl = document.getElementById('filter-option-sortby');
let sortbyDropdownEl = document.getElementById('dropdown-sortby');
let userRoleEl = document.getElementById('filter-option-user-role');
let userRoleDropdownEl = document.getElementById('dropdown-user-role');

sortbyEl.addEventListener("click", () => {
    toggleDropdown(sortbyEl, sortbyDropdownEl)
});

userRoleEl.addEventListener("click", () => {
    toggleDropdown(userRoleEl, userRoleDropdownEl)
});

function toggleDropdown(buttonEl, dropdownEl) {
    if (dropdownEl.style.display == "block") {
        buttonEl.getElementsByClassName('dropdown-button-icon')[0].style.transform = 'rotate(0deg)';
        dropdownEl.style.display = "none";
    } else {
        dropdownEl.style.display = 'block';
        buttonEl.getElementsByClassName('dropdown-button-icon')[0].style.transform = 'rotate(180deg)';
    }
}

$(".filter_form_thread").submit(function(event) {
    const url = window.location.href;
    const params = new URLSearchParams(new URL(url).search);
    const v = params.get("v");

    event.preventDefault();  // prevent the form from submitting
    $.ajax({
        type: "GET",
        url: "filtered_results_thread.php?v=" + v,
        data: $(this).serialize(),
        success: function (data) {
            $(".thread_content_container").html(data);
            let sidebarContainer = document.querySelector(".sidebar_container");
            sidebarContainer.classList.toggle("sidebar_active");
            $.getScript("thread.js");
        }
    });
});