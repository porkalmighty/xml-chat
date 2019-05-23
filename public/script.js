jQuery(document).ready(function(){
  const sendBtn = jQuery('#sendBtn');
  const chatWindow = jQuery('.chatInterface__window');
  const chatArea = jQuery('#chatArea');

  // scroll to the latest message
  // reference https://stackoverflow.com/questions/10503606/scroll-to-bottom-of-div-on-page-load-jquery/11551414#11551414
  if(chatWindow.length){ // if the chat window element exists...
    chatWindow.scrollTop(chatWindow[0].scrollHeight);
  }

  sendBtn.click(function(){
    let chatMessage = jQuery('#chatArea').val();
    let roomId = jQuery('#roomId').val();
    let user = jQuery('#userName').val();
    let userid = jQuery('#userId').val();

    // clear chat message box
    chatArea.val("");

    // check if the message is empty
    if(chatMessage !== "")
    {
      var chatObjects = {
        rId: roomId,
        uname: user,
        uId: userid,
        message: chatMessage
      };
      // post message via jquery
      jQuery.post("lib/send-message.php", chatObjects, function(chatmsg){
        chatWindow.html(chatmsg);
        // scroll to the latest message
        // reference https://stackoverflow.com/questions/10503606/scroll-to-bottom-of-div-on-page-load-jquery/11551414#11551414
        chatWindow.scrollTop(chatWindow[0].scrollHeight);
      });
    }
  });

  var refresh = setInterval(function(){
    let roomId = jQuery('#roomId').val();
    console.log('refreshing');
        // check if the message is empty
          var chatObjects = {
            rId: roomId
          };
          // post message via jquery
          jQuery.post("lib/refresh.php", chatObjects, function(chatmsg){
            chatWindow.html(chatmsg);
            // scroll to the latest message
            // reference https://stackoverflow.com/questions/10503606/scroll-to-bottom-of-div-on-page-load-jquery/11551414#11551414
            chatWindow.scrollTop(chatWindow[0].scrollHeight);
          });
    }, 500);
});

function onSignIn(googleUser) {
  // Useful data for your client-side scripts:
  var profile = googleUser.getBasicProfile();
  var user = profile.getGivenName();
  // The ID token you need to pass to your backend:
  var id_token = googleUser.getAuthResponse().id_token;
  if(id_token.length)
  {
    var auth2 = gapi.auth2.getAuthInstance();
    jQuery.post("lib/google-login.php", {"username": user},function(data){
      console.log(data);
      if(data === "loggedin")
      {
        location.href = "server.php";
      }else {
        location.href = "index.php?login=failed";
      }
    });
  }
}

// function signOut() {
//   var auth2 = gapi.auth2.getAuthInstance();
//   auth2.signOut().then(function () {
//   });
//   auth2.disconnect();
//   jQuery.post("logout.php");
//   // location.reload(true);
// }
