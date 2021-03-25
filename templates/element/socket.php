<!-- <script src="<?= $this->Url->build('/plugins/socket.io-client/socket.io.js', ['fullBase' => true]); ?>"></script> -->
<!-- <script src="main.js"></script> -->

<?php if (!empty($first_conversation_user)) : ?>
    <script>
        <?php echo $this->Custom->jsMinify($this->element('socketjs')) ?>
    </script>
    <script>
        var host = window.location.hostname;

        $(document).ready(function() {


            var FADE_TIME = 150; // ms
            var TYPING_TIMER_LENGTH = 400; // ms

            // Initialize varibles
            var $window = $(window);
            var $usernameInput = $('.usernameInput'); // Input for username
            // var $messages = $('.messages'); // Messages area
            var $messages = $('#chat-scroll-list');
            var $slimScroll = $('.chat-widget');



            var $inputMessage = $('.chat_message'); // Input message input box

            var $loginPage = $('.login.page'); // The login page
            var $chatPage = $('.chat.page'); // The chatroom page

            // Prompt for setting a username
            var user_id = parseInt("<?= $currentUser->id ?>");
            var user_full_name = "<?= $currentUser->name_desc ?>";
            var receiverid = parseInt("<?= !empty($active_chat_user) ? $active_chat_user->id : '' ?>");
            var receiver_username;
            var receiver_full_name;
            var username = "<?= $currentUser->username ?>";
            var connected = false;
            var typing = false;
            var lastTypingTime;
            // var $currentInput = $usernameInput.focus();


            // var protocol = window.location.protocol;
            // var socketUrl = protocol +'//'+ host;
            // var socket = io( socketUrl + ':2020');

            var socket = io('<?= $this->Custom->getHost() ?>');

            // console.log('<?= $this->Custom->getHost() ?>');

            // console.log(host);

            // <?php //if (strtolower($this->request->getParam('controller')) == 'messages'): 
                ?>
            <?php if (!empty($first_conversation_user)) : ?>

                $slimScroll = $('.chat-history');
                var currentchatuser = "<?= $this->Custom->getUserDisplayName($first_conversation_user) ?>";
                receiver_username = "<?= $first_conversation_user->username ?>";
                receiver_full_name = "<?= $first_conversation_user->name_desc ?>";
                receiverid = parseInt("<?= $first_conversation_user->id ?>");
                // console.log(receiverid);
                // connectToReceiver(receiverid);
                getMessengerLastmessages();
                startGettingMessageUpdates();


                $(".chat_list").on('click', function() {
                    // $(".chat_list").removeClass("active");
                    $(this).siblings('.chat_list').removeClass("active_chat");
                    $(this).addClass("active_chat");

                    receiverid = $(this).data("receiverid");
                    receiver_username = $(this).data("receiver_username");
                    receiver_full_name = $(this).data("receiver_full_name");

                    var profilelink = "<?= $this->Url->build(['prefix'=>false,'controller' => 'user', 'action' => 'index']); ?>";
                    var user_profile = profilelink + "/" + receiver_username;

                    getBlockUnblockBox(receiverid);
                    $(".target_user_link").attr("href", user_profile);
                    $(".receievername").html(receiver_full_name);
                    // $(".targetuser").html(receiver_full_name);

                    // $('.report_profile').each(function() {
                    //     $(this).attr('data-receievername', receiver_full_name);
                    //     $(this).attr('data-receieverid', receiverid);
                    // });
                    // $('.block_unblock').each(function() {
                    //     $(this).attr('data-targetuser_id', receiverid);
                    //     $(this).attr('data-user', receiver_full_name);
                    // });

                    // console.log(receiverid);
                    connectToReceiver();


                    var name = $(this).data("user");
                    var image = $(this).data("userimage");

                    currentchatuser = name;

                    $("#chat_user").html(name);
                    $("#chat_user_image").attr("src", image);

                    // getMessengerLastmessages();

                });


                var $messages = $('#chat-history-list');


            <?php endif; ?>



            $('#chatSubmitBtn').on('click', function(event) {
                // console.log("clicked submit button");
                event.preventDefault();
                submitChat();
            });

            $("#chatform").submit(function(event) {
                event.preventDefault();
                submitChat();
            });

            function emitgetLastMessages() {
                socket.emit('getlastMessages', {
                    user_id: user_id,
                    receiver_id: receiverid
                });
            }


            function startGettingMessageUpdates() {
                setInterval(function() {
                    emitgetLastMessages();
                }, 60000);
            }

            function getMessengerLastmessages() {
                $('#chat-history-list').html('');
                block($(".chat-history"));
                emitgetLastMessages();

                // startGettingMessageUpdates();
                // connectToReceiver(receipient_id);
            }

            socket.on('connected', function(data) {
                connected = true;
                setUsername();
            });

            function connectToReceiver() {
                // console.log("connecting to receiver");
                socket.emit('connectToReceiver', {
                    user_id: user_id,
                    receiver_id: receiverid
                });


            }

            socket.on('connectedToReceiver', function(data) {
                getMessengerLastmessages();
            });

            socket.on('gotlastMessages', function(data) {
                // console.log("got last", data);
                unblock($(".chat-widget")); //normal view
                unblock($(".chat-history")); //messenger view
                // $inputMessage.focus();
                
                if (data.success) {
                    $messages.html('');
                    data.body.forEach(function(element) {
                        addChatMessage(element);
                    });
                }
                scrollToBottom();
            });

            function scrollToBottom() {
                <?php //if (strtolower($this->request->getParam('controller')) == 'messages') : 
                ?>
                <?php if (1 == 1) : ?>
                    // $slimScroll[0].scrollTop = $slimScroll[0].scrollHeight;
                    // $messages.scrollTop(1000000);
                    // $slimScroll.scrollTop(1000000);
                    $('#message_panel').scrollTop(1000000);
                <?php endif; ?>
            }


            // Sends a chat message
            function submitChat() {

                // var message = cleanInput($("input[name=chat_message]").val());
                var message = cleanInput($(".chat_message").val());

                // if there is a non-empty message and a socket connection
                if (message && connected) {
                    $inputMessage.val('');
                    $inputMessage.focus();
                    var msgObj = {
                        user_id: user_id,
                        receiver_id: receiverid,
                        message: message
                    }
                    // addChatMessage(msgObj);
                    // tell server to execute 'new message' and send along one parameter
                    socket.emit('newMessage', msgObj);
                }
            }

            // Whenever the server emits 'new message', update the chat body
            socket.on('blockedFromSendingToThisUser', function(data) {
                toastr.error("You can't send a message to this user at this time");
            });

            // Whenever the server emits 'new message', update the chat body
            socket.on('newMessageFromServer', function(data) {
                if (data) { //if data is not empty
                    addChatMessage(data);
                }
            });


            // Sets the client's username
            function setUsername() {
                // username = cleanInput($usernameInput.val().trim());
                // If the username is valid
                if (username) {
                    // Tell the server your username
                    socket.emit('add user', {
                        username: username,
                        user_id: user_id,
                    });
                }
            }


            // Log a message
            function log(message, options) {
                var $el = $('<li>').addClass('log').text(message);
                addMessageElement($el, options);
            }

            // Adds the visual chat message to the message list
            function addChatMessage(data, options) {
                // Don't fade the message in if there is an 'X was typing'
                var $typingMessages = getTypingMessages(data);
                options = options || {};
                if ($typingMessages.length !== 0) {
                    options.fade = false;
                    $typingMessages.remove();
                }
                var typingClass = data.typing ? 'typing' : data.chatclass;

                // <li class="undefined" style=""><div class="chat-info"><span class="datetime">undefined</span><span class="message">is typing</span></div></li>

                <?php //if (strtolower($this->request->getParam('controller')) == 'messages') : 
                ?>
                <?php if (1 == 1) : ?>

                    var html = '';
                    if (user_id == data.userid) {

                        html += '<li class="right clearfix"><span class="chat-img pull-right">';
                        html += '<img src="' + data.avatar + '" alt="User Avatar" class="img-circle" />';
                        html += '</span>';
                        html += '<div class="chat-body">';
                        html += '<div class="header">';
                        html += '<small class="text-muted"><i class="fas fa-clock-o"></i> ' + data.time + '</small>';
                        html += '<strong class="pull-right primary-font">' + user_full_name + '</strong>';
                        html += '</div>';
                        html += '<p>' + data.message + '</p>';
                        html += '</div>';
                        html += '</li>';
                    } else {

                        html += '<li class="left clearfix ' + typingClass + '" data-username="' + (data.typing ? data
                            .username : '') + '"><span class="chat-img pull-left">';
                        html += data.typing ? '' : '<img src="' + data.avatar + '" alt="User Avatar" class="img-circle" />';
                        html += '</span>';
                        html += '<div class="chat-body">';
                        html += '<div class="header">';
                        html += '<strong class="primary-font">' + receiver_full_name + '</strong>';
                        html += '<small class="pull-right text-muted"><i class="fas fa-clock-o"></i> ' + (data.typing ? "" : data.time) + '</small>';
                        html += '</div>';
                        html += '<p>' + data.message + '</p>';
                        html += '</div>';
                        html += '</li>';
                    }

                    // $('#chat-history-list').append(html);

                <?php endif; ?>

                addMessageElement(html, options);

            }

            // Adds the visual chat typing message
            function addChatTyping(data) {
                data.typing = true;
                data.message = 'is typing..';
                <?php //if (strtolower($this->request->getParam('controller')) == 'messages') : 
                ?>
                <?php if (1 == 1) : ?>
                    if (data.username == receiver_username) {
                        addChatMessage(data);
                    }
                <?php else : ?>
                    addChatMessage(data);
                <?php endif; ?>

            }

            // Removes the visual chat typing message
            function removeChatTyping(data) {
                // console.log("removing typing messages", data);
                getTypingMessages(data).fadeOut(function() {
                    $(this).remove();
                });
            }

            // Adds a message element to the messages and scrolls to the bottom
            // el - The element to add as a message
            // options.fade - If the element should fade-in (default = true)
            // options.prepend - If the element should prepend
            //   all other messages (default = false)
            function addMessageElement(el, options) {
                var $el = $(el);

                // Setup default options
                if (!options) {
                    options = {};
                }
                if (typeof options.fade === 'undefined') {
                    options.fade = true;
                }
                if (typeof options.prepend === 'undefined') {
                    options.prepend = false;
                }

                // Apply options
                if (options.fade) {
                    $el.hide().fadeIn(FADE_TIME);
                }
                if (options.prepend) {
                    $messages.prepend($el);
                } else {
                    $messages.append($el);
                }
                // $('#chat-scroll-list').append(html);

                // $(".chat-widget").slimscroll({
                //     scrollBy: '9600px'
                // });


                scrollToBottom();

            }

            // Prevents input from having injected markup
            function cleanInput(input) {
                return $('<div/>').text(input).text();
            }

            // Updates the typing event
            function updateTyping() {
                // console.log("update typing");
                // console.log("connected", connected);
                if (connected) {
                    if (!typing) {
                        typing = true;
                        socket.emit('typing', {
                            receiver_id: receiverid
                        });
                    }
                    lastTypingTime = (new Date()).getTime();

                    setTimeout(function() {
                        var typingTimer = (new Date()).getTime();
                        var timeDiff = typingTimer - lastTypingTime;
                        if (timeDiff >= TYPING_TIMER_LENGTH && typing) {
                            socket.emit('stop typing', {
                                receiver_id: receiverid
                            });
                            typing = false;
                        }
                    }, TYPING_TIMER_LENGTH);
                }
            }

            // Gets the 'X is typing' messages of a user
            function getTypingMessages(data) {
                // return $('.typing.message').filter(function (i) {
                return $('.typing').filter(function(i) {
                    return $(this).data('username') === data.username;
                });
            }

            // Keyboard events
            $window.keydown(function(event) {
                // Auto-focus the current input when a key is typed
                // if (!(event.ctrlKey || event.metaKey || event.altKey)) {
                if (!(event.metaKey || event.altKey)) {
                    // $inputMessage.focus();//this line is what is causing the status update loosing focus bug
                }

                // When the client is pressing the Ctrl Key and enter key on their keyboard
                if (event.ctrlKey && event.keyCode === 13) {
                    if (username) {
                        // sendMessage();
                        submitChat();
                        // socket.emit('stop typing');
                        socket.emit('stop typing', {
                            receiver_id: receiverid
                        });
                        typing = false;
                    } else {
                        setUsername();
                    }
                }

            });

            $inputMessage.on('input', function() {
                console.log('on input');
                updateTyping();
            });

            // Click events

            // Focus input when clicking anywhere on login page
            // $loginPage.click(function () {
            //     $currentInput.focus();
            // });

            // Focus input when clicking on the message input's border
            $inputMessage.click(function() {
                $inputMessage.focus();
            });

            // Socket events

            // Whenever the server emits 'login', log the login message
            socket.on('login', function(data) {
                // console.log("logged in");
                connected = true;
                <?php //if (strtolower($this->request->getParam('controller')) == 'messages') : 
                ?>
                <?php if (1 == 1) : ?>
                    connectToReceiver();
                    // socket.emit('getlastMessages', {
                    //     user_id: user_id,
                    //     receiver_id: receiverid
                    // });
                <?php endif; ?>
            });

            // Whenever the server emits 'user joined', log it in the chat body
            // socket.on('user joined', function (data) {
            // log(data.username + ' joined');
            // addParticipantsMessage(data);
            // });

            // Whenever the server emits 'user left', log it in the chat body
            socket.on('user left', function(data) {
                // log(data.username + ' left');
                // addParticipantsMessage(data);
                // removeChatTyping(data);
            });

            // Whenever the server emits 'typing', show the typing message
            socket.on('typing', function(data) {
                addChatTyping(data);
            });

            // Whenever the server emits 'stop typing', kill the typing message
            socket.on('stop typing', function(data) {
                removeChatTyping(data);
            });

            // socket.listen(); //used with the unreliable websocket library
        });
    </script>
<?php endif; ?>