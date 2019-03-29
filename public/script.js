jQuery(document).ready(function(){
  const sendBtn = jQuery('#sendBtn');
  const chatWindow = jQuery('.chatInterface__window');
  const chatArea = jQuery('#chatArea');
  sendBtn.click(function(){
    let chatMessage = jQuery('#chatArea').val();
    let roomId = jQuery('#roomId').val();
    let user = jQuery('#userName').val();
    let userid = jQuery('#userId').val();

    // clear chat message box
    chatArea.val("");

    var chatObjects = {
      rId: roomId,
      uname: user,
      uId: userid,
      message: chatMessage
    };
    // post message via jquery
    jQuery.post("lib/send-message.php", chatObjects, function(chatmsg){
      var res = JSON.parse(chatmsg);
      console.log(res);
      var chat = "";
      jQuery.each(res, function(key, val){
          chat += "<span class='chatmsg'>" + val.username + " : " + val.message + "</span>";
      });
      chatWindow.html(chat);
    });
  });
});
