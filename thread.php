<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forumsite</title>
  <link rel="stylesheet" href="style.css">


</head>
<body>
  <header>
    <div class="inner__header">

        <div class="logo__container">
            <h1 class="logo">LOGO</h1>
        </div>

        <div class="header-content-right">
            <div class="search-bar__container">
                <input class="search-bar" type="text" placeholder="Search topic..">
            </div>
            <div class="notification-button__container">
                <button class="notification-button">
                    <svg data-name="Layer 1" id="Layer_1" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><title/><path d="M40.62,28.34l-.87-.7A2,2,0,0,1,39,26.08V18A15,15,0,0,0,26.91,3.29a3,3,0,0,0-5.81,0A15,15,0,0,0,9,18v8.08a2,2,0,0,1-.75,1.56l-.87.7a9,9,0,0,0-3.38,7V37a4,4,0,0,0,4,4h8.26a8,8,0,0,0,15.47,0H40a4,4,0,0,0,4-4V35.36A9,9,0,0,0,40.62,28.34ZM24,43a4,4,0,0,1-3.44-2h6.89A4,4,0,0,1,24,43Zm16-6H8V35.36a5,5,0,0,1,1.88-3.9l.87-.7A6,6,0,0,0,13,26.08V18a11,11,0,0,1,22,0v8.08a6,6,0,0,0,2.25,4.69l.87.7A5,5,0,0,1,40,35.36Z"/></svg>
                </button>
            </div>
            <div class="action-button__container">
                <button id="action-button" class="action-button">
                    <svg id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M28,14H18V4c0-1.104-0.896-2-2-2s-2,0.896-2,2v10H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h10v10c0,1.104,0.896,2,2,2  s2-0.896,2-2V18h10c1.104,0,2-0.896,2-2S29.104,14,28,14z"/></svg>
                </button>
                <div class="action-options">
                    <button class="create-post-btn">Create post</button>
                    <button class="start-chat-btn">Start chat</button>
                </div>
            </div>

            <div class="profile__container">
                <img src="./images/profile.jpg" alt="profile" class="profile">
                <div class="online_status"></div>
            </div>
        </div>
    </div>
</header>

  <main>
    <div class="inner__main">
      <div class="side-bar__container">
          <div class="side-bar">

          </div>
      </div>
      <div class="main-content__container">
        <div class="thread_main-content">
          <div class="thread_post">
            <div class="card-content">
              <div class="thread-title-container">
                <h3 class="thread-title"><span class="tag tag-math">Math</span >first thread</h3>
              </div>
              <hr>
              <p class="card-text">Consectetur adipisicing elit. Error, commodi? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore ullam quaerat iure sed ipsum nisi illum nemo accusantium beatae deleniti...</p>
              <button id="thread-minimize-button">-</button>
              <div id='thread-image'> </div>
              <script src="minimize.js"></script>
              <hr>
              <div class="card-bottom">
                <div class="author">
                  <p class="author-name">John Smithus</p>
                  <div class="tag__container">
                    <p class="tag">TA</p>
                  </div>
                </div>
                <p class="comment-count">5 comments </p>
                <p class="date">12/01/2023</p>
              </div>
            </div>
          </div>
          <div class="thread_new_comment">
            <textarea class="thread_textarea" ></textarea>
            <button class="thread_comment_button">add comment</button>
          </div>
          <div class="thread_comment">
            <p class="user">
              Anonymous
            </p>
            <p class="comment-date">
              12/01/2023
            </p>
            <div class="comment-content">
              Content of comment Content of comment Content of comment Content of comment Content of comment Content of comment Content of comment 
            </div>
          </div>
          <div class="thread_comment">
            <p class="user">
              Anonymous2
            </p>
            <p class="comment-date">
              13/01/2023
            </p>
            <div class="comment-content">
              Content of comment Content of comment Content of comment Content of comment Content of comment Content of comment Content of comment 
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
