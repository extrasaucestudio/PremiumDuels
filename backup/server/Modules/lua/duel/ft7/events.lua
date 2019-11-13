---
--- Copyright (c) 2019 Skrypt - All Rights Reserved.
---
--- Triggered events related to the first to 7 module are located here.
--- For easy recognition across other modules, all functions are prefixed with 'ft7_'.
---

--- Triggered when any agent hits an anvil.
---
--- instance: The instance ID of the anvil scene prop.
--- agent: The ID of the agent who performed the hit.
function ft7onAnvilHit(instance, agent)
	
	--sendMessageToServer("Agent: " .. agent)
	--
	--if game.agent_is_active(agent) then
	--	sendMessageToServer("Agent is active")
	--else
	--	sendMessageToServer("Agent is not active")
	--end
	--
	--if game.agent_is_alive(agent) then
	--	sendMessageToServer("Agent is alive")
	--else
	--	sendMessageToServer("Agent is not alive")
	--end
	
	-- Agent is not active or alive. Just a precaution.
	if not game.agent_is_active(agent) or not game.agent_is_alive(agent) then
		game.fail()
		--sendMessageToServer("Agent not active or alive.")
		return false
	end
	-- Agent is active and alive further on.
	
	-- Agent is human and a player.
	if game.agent_is_human(agent) and not game.agent_is_non_player(agent) then
		local player = game.agent_get_player_id(1, agent)   -- Stored in modsys in reg1.
		
		-- Player is not active. Precaution.
		if not game.player_is_active(player) then
			game.fail()
			--sendMessageToServer("Player not active.")
			return false
		end
		-- Player is active further on.
		
		-- Player account is activate.
		if game.player_slot_eq(player, player_slot_account_state, account_state_active) then
			
			-- Player is in duel mode.
			if game.player_slot_eq(player, player_slot_duel_mode, duel_mode_normal) then
				-- Update Slots
				game.player_set_slot(player, player_slot_duel_mode, duel_mode_ft7)
				
				-- Send Message
				sendMessageToPlayer(player, str_player_enter_ft7, false)
				-- Player is in first to seven mode.
			elseif game.player_slot_eq(player, player_slot_duel_mode, duel_mode_ft7) then
				if game.player_slot_eq(player, player_slot_ft7_opponent, -1) then
					-- TODO: Check whether the player is in a match or not.
					-- Update Slots
					game.player_set_slot(player, player_slot_duel_mode, duel_mode_normal)
					
					-- Send Message
					sendMessageToPlayer(player, str_player_exit_ft7, false)
				end
			end
		-- Player account is inactive.
		else
			sendMessageToPlayer(player, str_account_inactive, false)
		end
	end
end

--- Triggered when a player in ft7 mode offers a duel to another player also in ft7 mode.
---
--- player: player who sent the duel offer.
--- otherPlayer: player who received the duel offer.
---
--- Returns true if offer was valid, false if offer was invalid.
function ft7onPlayerOfferDuel(player, otherPlayer)
	
	-- Sending player has no valid opponent yet.
	if game.player_slot_eq(player, player_slot_ft7_opponent, -1) then
		
		-- Receiving player has no valid opponent yet.
		if game.player_slot_eq(otherPlayer, player_slot_ft7_opponent, -1) then
			-- Send Message
			sendMessageToPlayer(player, str_offer_ft7_send, false)
			sendMessageToPlayer(otherPlayer, str_offer_ft7_receive, false)
			
			return true
		else
			-- Send Message
			sendMessageToPlayer(player, str_offer_ft7_send_invalid, false)
			
			return false
		end
	-- Sender send offer to valid opponent.
	elseif game.player_slot_eq(player, player_slot_ft7_opponent, otherPlayer) then
		return true
	-- Sender sent offer to invalid opponent.
	else
		sendMessageToPlayer(player, str_invalid_ft7_opponent, false)
		return false
	end
end

--- Triggered when a player in ft7 mode accepts a duel from another player also in ft7 mode.
---
--- player: player who accepted the duel offer.
--- otherPlayer: player who send the duel offer.
---
--- Returns true if duel is valid, false if duel is invalid.
function ft7onPlayerAcceptDuel(player, otherPlayer)
	-- Accepting player has no valid opponent yet.
	if game.player_slot_eq(player, player_slot_ft7_opponent, -1) then
		
		-- Offerer has no valid opponent yet.
		if game.player_slot_eq(otherPlayer, player_slot_ft7_opponent, -1) then
			game.player_set_slot(player, player_slot_ft7_opponent, otherPlayer)
			game.player_set_slot(player, player_slot_ft7_score, 0)
			game.player_set_slot(otherPlayer, player_slot_ft7_opponent, player)
			game.player_set_slot(otherPlayer, player_slot_ft7_score, 0)
			
			-- Send Message
			sendMessageToPlayer(player, str_offer_ft7_accept, false)
			sendMessageToPlayer(otherPlayer, str_offer_ft7_accept_other, false)
			
			return true
		-- The offerer somehow got into another ft7 match before this one.
		else
			sendMessageToPlayer(player, str_offer_ft7_accept_invalid, false)
			return false
		end
	-- Sender send offer to valid opponent.
	elseif game.player_slot_eq(player, player_slot_ft7_opponent, otherPlayer) then
		--sendMessageToServer("Valid")
		return true
	-- Sender sent offer to invalid opponent.
	else
		sendMessageToPlayer(player, str_invalid_ft7_opponent, false)
		return false
	end
end
