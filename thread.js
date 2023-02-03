function thread_buttons() {
    /*Verberg of toon de comment invoer*/
    let replyButtons = document.querySelectorAll('.reply_button');

    replyButtons.forEach(reply_button => {
        reply_button.addEventListener("click", () => {
            let form = document.querySelector('#form-' + reply_button.id);

            if (form.style.display != "flex") {
                form.style.display = "flex";
            } else {
                form.style.display = "none";
            }

            const collection = form.children;

            if (collection[0].style.height == "0px") {
                collection[0].style.height = "30px";
            }
        });
    });

    /*Verberg of toon de subcomments onder een comment*/
    let hideRepliesButtons = document.querySelectorAll('.hide_replies');

    hideRepliesButtons.forEach(hide_button => {
        hide_button.addEventListener("click", () => {
            let subcomments = document.querySelectorAll('.' + hide_button.id);
            subcomments.forEach(subcomment => {
                if (subcomment.style.display != "none") {
                    subcomment.style.display = "none";
                } else {
                    subcomment.style.display = "flex";
                }
            })

            const collection = hide_button.children;
            if (collection[0].innerHTML == "Show replies") {
                collection[0].innerHTML = "Hide replies";
            } else {
                collection[0].innerHTML = "Show replies";
            }
        });
    });

    function hideSubComments(subComments) {
        console.log(subComments);

        for (i = 0; i < subComments.length; i++) {
            var subComment = document.getElementById(subComments[i]);
            subComment.style.display = "none";
        }
    }

    /*Voer php script bij klik op like button*/
    let likeButtons = document.querySelectorAll('.like_button');
    likeButtons.forEach(like_button => {
        like_button.addEventListener("click", () => {
            var id = like_button.id;
            var url = 'like.php' + window.location.search;
            if (id.slice(0,9) == "post-like") {
                var form = $('<form action="' + url + '" method="post" style="display: none;">' + '<input type="text" name="post_id" value="' + id + '" />' + '<input type="hidden" name="comment_id" value=""/></form>');
            } else {
                var form = $('<form action="' + url + '" method="post" style="display: none;">' + '<input type="text" name="comment_id" value="' + id + '" />' + '<input type="text" name="post_id" value=""/></form>');
            }

            var subCommentArray = $('.subcomment_container[style="display: none;"]').map(function() {
                return this.id;
            }).get();

            $.ajax({
                type: "POST",
                url: 'like.php' + window.location.search,
                data: form.serialize(),
                success: function (data) {
                    $(".thread_content_container").html(data);
                    $.getScript("thread.js");
                    $.getScript("textarea_resize.js");
                },
                complete: function(jqXHR){
                    if(jqXHR.status == 409) {
                        window.location.href = "login_signup/login_page.php";
                    }
                    hideSubComments(subCommentArray);
                }
            });
        });
    });

    /*Delete post knop*/
    let deletePostButton = document.querySelector('.delete_post');

    if (deletePostButton != null) {
        deletePostButton.addEventListener("click", () => {
            if (confirm("Are you sure you want to delete this post?") == true) {
                var id = deletePostButton.id;
                var url = 'delete_post.php';
                var form = $('<form action="' + url + '" method="post" style="display: none;">' + '<input type="text" name="post_id" value="' + id + '" />' + '</form>');
                $('body').append(form);
                form.submit();
            }
        });
    }

    /*Delete comment knop*/
    let deleteCommentButtons = document.querySelectorAll('.delete_comment');

    if (deleteCommentButtons != null) {
        deleteCommentButtons.forEach(delete_button => {
            delete_button.addEventListener("click", () => {
                if (confirm("Are you sure you want to delete this comment?") == true) {
                    var id = delete_button.id;
                    var url = 'delete_comment.php' + window.location.search;
                    var form = $('<form action="' + url + '" method="post" style="display: none;">' + '<input type="text" name="comment_id" value="' + id + '" />' + '</form>');
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    }

    /*Markeer oplossing knop*/
    let solutionButtons = document.querySelectorAll('.solution_button');

    if (solutionButtons != null) {
        solutionButtons.forEach(solution_button => {
            solution_button.addEventListener("click", () => {
                if (confirm("Are you sure you want to mark this comment as solution?") == true) {
                    var id = solution_button.id;
                    var url = 'mark_solution.php' + window.location.search;
                    var form = $('<form action="' + url + '" method="post" style="display: none;">' + '<input type="text" name="comment_id" value="' + id + '" />' + '</form>');
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    }

    let subjectEl = document.getElementById('filter-option-subject');
    let subjectDropdownEl = document.getElementById('dropdown-subject');
    let sortbyEl = document.getElementById('filter-option-sortby');
    let sortbyDropdownEl = document.getElementById('dropdown-sortby');
    let userRoleEl = document.getElementById('filter-option-user-role');
    let userRoleDropdownEl = document.getElementById('dropdown-user-role');
    
    if (typeof(subjectEl) != 'undefined' && subjectEl != null)
    {
        // This dropdown doesn't exist inside thread.php
        subjectEl.addEventListener("click", () => {
            toggleDropdown(subjectEl, subjectDropdownEl)
        });
    }
    
    
    sortbyEl.addEventListener("click", () => {
        toggleDropdown(sortbyEl, sortbyDropdownEl)
    });
    
    userRoleEl.addEventListener("click", () => {
        toggleDropdown(userRoleEl, userRoleDropdownEl)
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
}

thread_buttons();