jQuery(document).ready(function(){
  const chatlist = jQuery('.chatroom__list');

  // load the chatroom via jquery post
  jQuery.post("server.php", function(data){
    chatlist.append(data);
  })

  jQuery(document).on("click", '.roomList', function(){
    const $serverId = jQuery(this).val();
    const $serverName = jQuery(this).text();
    alert('server: ' + $serverId + '\nserver name:' + $serverName);
  });

});
