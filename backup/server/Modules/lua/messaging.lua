---
--- Copyright (c) 2019 Skrypt - All Rights Reserved.
---
--- Messaging related stuff goes here.
---


--- Send a message to a specific player.
---
--- player: the player to send the message to.
--- message: the message to send.
--- addToLog: false/true whether to also add the message to the logs or not.
function sendMessageToPlayer(player, message, addToLog)
	local log = 0
	if addToLog == true then
		log = 1
	end
	
	game.sreg[0] = message
	local scriptNo = game.getScriptNo("pd_send_message")
	game.call_script(scriptNo, player, log)
end

--- Sends a message to the whole server (every player).
---
--- message: the message to send.
--- addToLog: false/true whether to also add the message to the logs or not.
function sendMessageToServer(message, addToLog)
	sendMessageToPlayer(-1, message, addToLog)
end

--- Sends a message to the specified group of players.
---
--- players: a table of players to send the message to.
--- message: the message to send.
--- addToLog: false/true whether to also add the message to the logs or not.
function sendMessageToPlayers(players, message, addToLog)
	for key,value in ipairs(players) do
		sendMessageToPlayer(value, message, addToLog)
	end
end