$(document).ready(function () {
			var socket = new WebSocket("WS://localhost:8080/");

			socket.onopen = function() {
				$('.status').text("Соединение установлено.");
				var timestamp = $.now()
			};

			socket.onclose = function(event) {
			  if (event.wasClean) {
			    $('.status').text('Соединение закрыто чисто');
			  } else {
			    $('.status').text('Обрыв соединения');
			  }
			 $('.status').text('Код: ' + event.code + ' причина: ' + event.reason);
			};

			socket.onmessage = function(event) {
				var data = event.data;
				var messages = $('.messages');
				
				messages.append('<p class="msg-block">' + data + '</p>');
				//	messages.scrollTop(messages[0].scrollHeight);
				messages.stop().animate({
 						scrollTop: messages[0].scrollHeight
				}, 800);
			};

			socket.onerror = function(error) {
			  alert("Ошибка " + error.message);
			};
			$('.send-all').click(function(event) {
				var _name = $('.name').val();
				var _msg = $('.msg-all').val();
				var data = {
					name: _name,
					receiver: false,
					message: _msg,
					type: "message_all"

				};
				socket.send(JSON.stringify(data));
			});
			$('.change-name').click(function(event) {
				var name = $('.name').val();
				if(name.lenght !== 0){
					$.cookie('chat_username', name);
					var data = {
						message: name,
						type: "change_name"
					};
					socket.send(JSON.stringify(data));
				}else
					alert('Введите имя!');
			});
});
