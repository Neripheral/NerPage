function addMessage(message){
	var newElement = `
		<div class="p-1">
			<div id="chatMessage-`+message.id+`" class="chatMessage container bg-light rounded p-2">
				<p class="m-0">
					<strong class="text-secondary">`+message.username+`</strong>
					<br>
					`+message.content+`
				</p>
			</div>
		</div>`;
	console.log(newElement);
	$("#chatMessages").prepend(newElement);
}

function getLastMessageId(){
	var elementId = $(".chatMessage").first().attr("id");
	var pattern = /chatMessage\-(\d+)/;
	var id = pattern.exec(elementId);
	if(id === null)
		return false;
	id = parseInt(id[1]);
	return id;
}

function getMessages(){
	var messageId = { lastMessageId: getLastMessageId() };
	console.log(messageId);
	$.post("http://[::1]/www/NerPage/index.php/chat/ajaxGetMessages", messageId, function(dataJson, success){
		console.log("dane:"+dataJson);
		var data = JSON.parse(dataJson);
		data.forEach(addMessage);
	});
}

function loadMessages(){
	getMessages();
	console.log("refreshed");
	//window.setTimeout(function(){loadMessages()}, 4000);
}



function composeMessage(){
	return {
		"content": $("#inputMessage").val()	
	};
}

function sendAjaxMessage(message){
	$.post("http://[::1]/www/NerPage/index.php/chat/sendMessage", message);
}

function clearChatInput(){
	$("#inputMessage").val("");
}

function setSendMessageHandle(){
	$("#chatInput").submit(function(e){
		e.preventDefault();
		sendAjaxMessage(composeMessage());
		getMessages();
		clearChatInput();
	});
}

$(document).ready(function(){
	setSendMessageHandle();
	loadMessages();
});
