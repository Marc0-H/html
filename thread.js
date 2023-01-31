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
            if (subcomment.style.display != "flex") {
                subcomment.style.display = "flex";
            } else {
                subcomment.style.display = "none";
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

        $('body').append(form);
        form.submit();
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