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

