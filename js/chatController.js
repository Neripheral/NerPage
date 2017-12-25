function composeMessage(){
	return {
		"message": $("#inputMessage").val()	
	};
}

function sendAjaxMessage(message){
	$.post("http://[::1]/www/NerPage/index.php/chat/sendMessage", message);
}

function setSendMessageHandle(){
	$("#chatInput").submit(function(e){
		e.preventDefault();
		sendAjaxMessage(composeMessage());
	});
}

$(document).ready(function(){
	setSendMessageHandle();
});
