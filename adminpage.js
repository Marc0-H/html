let delete_admin_button = document.querySelectorAll('.admin_submit');

    if (delete_admin_button != null) {
      delete_admin_button.forEach(delete_admin_button => {

        delete_admin_button.addEventListener("click", (event) => {
            if(confirm('Are you sure?') !=true) {
              event.preventDefault();
            }
        });
      });
    }
