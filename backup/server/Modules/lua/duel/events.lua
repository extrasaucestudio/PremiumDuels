---
--- Copyright (c) 2019 Skrypt - All Rights Reserved.
---

function onPlayerJoin()
	local player = getTriggerParam(1)


	--sendMessageToServer("Player ID: " .. player)

	game.str_store_player_username(1, player)
	local username = game.sreg[1]
	local uid = game.player_get_unique_id(1, player)
	--sendMessageToServer("Player " .. username .. " (" .. uid .. ") joined.")
	--sendMessageToServer("Player Joined")
	game.player_set_slot(player, player_slot_ft7_opponent, -1)
	game.player_set_slot(player, player_slot_ft7_score, 0)
	game.player_set_slot(player, player_slot_account_state, account_state_inactive)
	game.player_set_slot(player, player_slot_rank, player_rank_invalid)
	game.player_set_slot(player, player_slot_custom_equipment_head, -1)
	game.player_set_slot(player, player_slot_custom_equipment_body, -1)
	game.player_set_slot(player, player_slot_custom_equipment_hand, -1)
	game.player_set_slot(player, player_slot_custom_equipment_foot, -1)
	game.player_set_slot(player, player_slot_custom_equipment_weapon, -1)
	game.player_set_slot(player, player_slot_duel_interrupt_time, -1)
	game.player_set_slot(player, player_slot_respawn_pos_x, -1)
	game.player_set_slot(player, player_slot_respawn_pos_y, -1)
	game.player_set_slot(player, player_slot_respawn_pos_z, -1)
	
	
	sendGetRequest("useragent", "check", {
		["player_id"] = player,
		["uid"] = uid,
		["username"] = username
	})
end

function onPlayerQuit()
	local player = getTriggerParam(1)

	--game.server_add_message_to_log("Player ID: " .. player)

	local agent = game.player_get_agent_id(1, player)

	--game.server_add_message_to_log("Agent ID: " .. agent)

	--sendMessageToServer("Quit")
	if not game.agent_is_active() then
		--game.server_add_message_to_log("Not Active")
		
		if game.player_slot_eq(player, player_slot_duel_mode, duel_mode_ft7) and not game.player_slot_eq(player, player_slot_ft7_opponent, -1) then
			local otherPlayer = game.player_get_slot(1, player, player_slot_ft7_opponent)
			
			-- Update Slots
			game.player_set_slot(otherPlayer, player_slot_ft7_score, 0)
			game.player_set_slot(player, player_slot_ft7_score, 0)
			game.player_set_slot(otherPlayer, player_slot_ft7_opponent, -1)
			game.player_set_slot(player, player_slot_ft7_opponent, -1)
			
			-- Store Usernames
			game.str_store_player_username(1, otherPlayer)
			game.str_store_player_username(2, player)
			local killerUsername = game.sreg[1]
			local victimUsername = game.sreg[2]
			
			-- Store scores
			local killerScore = 7
			local victimScore = game.player_get_slot(2, player, player_slot_ft7_score)
			
			local killerUID = game.player_get_unique_id(1, otherPlayer)
			local victimUID = game.player_get_unique_id(2, player)
			
			-- Send HTTP Request to Webserver
			sendGetRequest("useragent", "ft7", {
				["winner_id"] = otherPlayer,
				["loser_id"] = player,
				["winner_uid"] = killerUID,
				["loser_uid"] = victimUID,
				["winner_score"] = killerScore,
				["loser_score"] = victimScore
			})
			
			-- Send Message
			sendMessageToServer(string.gsub(string.gsub(string.gsub(string.gsub(str_ft7_broadcast, "%%%%winner%%%%", killerUsername), "%%%%opponent%%%%", victimUsername), "%%%%winnerScore%%%%", killerScore), "%%%%opponentScore%%%%", victimScore), true)
		end
	end
end

function onPlayerBuyAgentEquipment(player)
	local tunic = game.player_get_slot(1, player, player_slot_rank)
	
	local head = game.player_get_slot(2, player, player_slot_custom_equipment_head)
	local body = game.player_get_slot(3, player, player_slot_custom_equipment_body)
	local hand = game.player_get_slot(4, player, player_slot_custom_equipment_hand)
	local foot = game.player_get_slot(5, player, player_slot_custom_equipment_foot)
	local weapon = game.player_get_slot(6, player, player_slot_custom_equipment_weapon)
	
	if head == -1 then head = itm_no_item end
	if body == -1 then body = tunic end
	if hand == -1 then hand = itm_no_item end
	if foot == -1 then foot = itm_ankle_boots end
	
	
	game.player_add_spawn_item(player, item_head, head)
	game.player_add_spawn_item(player, item_body, body)
	game.player_add_spawn_item(player, item_hand, hand)
	game.player_add_spawn_item(player, item_foot, foot)
	if weapon > 0 then
		game.player_add_spawn_item(player, item_slot_4, weapon)
	end
end

function onPlayerOfferDuel(player, otherAgent)
	
	-- Other agent is player.
	if not game.agent_is_non_player(otherAgent) then
		
		local otherPlayer = game.agent_get_player_id(1, otherAgent)
		
		-- Both players are in normal mode.
		if game.player_slot_eq(player, player_slot_duel_mode, duel_mode_normal) and game.player_slot_eq(otherPlayer, player_slot_duel_mode, duel_mode_normal) then
			-- TODO: Do something in normal mode?
		-- Both players are in ft7 mode.
		elseif game.player_slot_eq(player, player_slot_duel_mode, duel_mode_ft7) and game.player_slot_eq(otherPlayer, player_slot_duel_mode, duel_mode_ft7) then
			if ft7onPlayerOfferDuel(player, otherPlayer) then
				return
			else
				game.fail()
			end
			-- Code get's stuck here if valid. It's perfectly normal.
		-- Players are in different modes.
		else
			game.fail()
		end
		
	end
end

function onAgentAcceptDuel(agent, otherAgent)
	
	-- Agent and other agent are players.
	if not game.agent_is_non_player(agent) and not game.agent_is_non_player(otherAgent) then
		local player = game.agent_get_player_id(1, agent)
		local otherPlayer = game.agent_get_player_id(2, otherAgent)
		
		-- Both players are in normal mode.
		if game.player_slot_eq(player, player_slot_duel_mode, duel_mode_normal) and game.player_slot_eq(otherPlayer, player_slot_duel_mode, duel_mode_normal) then
			-- TODO: Do something in normal mode?
			-- Both players are in ft7 mode.
		elseif game.player_slot_eq(player, player_slot_duel_mode, duel_mode_ft7) and game.player_slot_eq(otherPlayer, player_slot_duel_mode, duel_mode_ft7) then
			if ft7onPlayerAcceptDuel(player, otherPlayer) then
				return
			else
				game.fail()
			end
			-- Code get's stuck here if valid. It's perfectly normal.
			-- Players are in different modes.
		else
			game.fail()
		end
	end
end

function onAgentKilled(killerAgent, victimAgent)
	
	
	-- Death Cause Unknown (Quit, Faction / Spectator Swap, ...)
	-- Victim Agent is always the right one.
--	sendMessageToServer("Killer: " .. killerAgent)
--	sendMessageToServer("Victim: " .. victimAgent)
--	game.server_add_message_to_log("Killer: " .. killerAgent)
--	game.server_add_message_to_log("Victim: " .. victimAgent)

	if killerAgent == -1 or (killerAgent == victimAgent) then
	--if killerAgent == victimAgent then

		-- Victim is player
		if not game.agent_is_non_player(victimAgent) then
			local victimPlayer = game.agent_get_player_id(1, victimAgent)
			
			local dm = game.player_get_slot(1, victimPlayer, player_slot_duel_mode)
			local op = game.player_get_slot(1, victimPlayer, player_slot_ft7_opponent)
			
--			sendMessageToServer("Duel Mode: " .. dm)
--			sendMessageToServer("Opponent: " .. op)
			
			if game.player_slot_eq(victimPlayer, player_slot_duel_mode, duel_mode_ft7) and not game.player_slot_eq(victimPlayer, player_slot_ft7_opponent, -1) then
				local killerPlayer = game.player_get_slot(2, victimPlayer, player_slot_ft7_opponent)
				
				if killerAgent == -1 then
					game.player_set_slot(killerPlayer, player_slot_ft7_score, 7)
				end
				
				--sendMessageToServer("Killer Changed to Victim's Opponent")
				killerAgent = game.player_get_agent_id(1, killerPlayer)
				victimAgent = game.player_get_agent_id(2, victimPlayer)
				
			end
		end
	end


--	game.server_add_message_to_log("New Killer: " .. killerAgent)
--	game.server_add_message_to_log("New Victim: " .. victimAgent)
--	sendMessageToServer("NEW Killer: " .. killerAgent)
--	sendMessageToServer("NEW Victim: " .. victimAgent)

	if killerAgent == -1 then
		return
	end

	-- Killer and victim are players.
	if not game.agent_is_non_player(killerAgent) and not game.agent_is_non_player(victimAgent) then
		local killerPlayer = game.agent_get_player_id(1, killerAgent)
		local victimPlayer = game.agent_get_player_id(2, victimAgent)
		
		if not game.agent_slot_eq(killerAgent, slot_agent_in_duel_with, -1) and not game.agent_slot_eq(victimAgent, slot_agent_in_duel_with, -1) then
			
			-- Heal
			game.agent_set_hit_points(killerAgent, 100, 0)
			
			-- Set Respawn Position
			game.set_fixed_point_multiplier(1)
			game.agent_get_position(1, killerAgent)
			local posX = game.position_get_x(1, game.preg[1])
			local posY = game.position_get_y(2, game.preg[1])
			local posZ = game.position_get_z(3, game.preg[1])
			local pos = game.pos.new({o = {x=posX,y=posY,posZ}})
			local mult = -1
			if math.random(1, 2) == 1 then mult = 1 end
			pos.o.x = pos.o.x + (math.random(3, 5) * mult)
			pos.o.y = pos.o.y + (math.random(3, 5) * mult)
			pos.o.z = pos.o.z + (math.random(3, 5) * mult)

--			sendMessageToServer("X: " .. posX .. ", Y: " .. posY .. ", Z: " .. posZ)
--			sendMessageToServer("[New] X: " .. pos.o.x .. ", Y: " .. pos.o.y .. ", Z: " .. pos.o.z)
			
			game.player_set_slot(victimPlayer, player_slot_respawn_pos_x, pos.o.x)
			game.player_set_slot(victimPlayer, player_slot_respawn_pos_y, pos.o.y)
			game.player_set_slot(victimPlayer, player_slot_respawn_pos_z, pos.o.z)
			
			if game.player_slot_eq(killerPlayer, player_slot_duel_mode, duel_mode_ft7) and game.player_slot_eq(victimPlayer, player_slot_duel_mode, duel_mode_ft7) then
				if game.player_slot_eq(killerPlayer, player_slot_ft7_opponent, victimPlayer) and game.player_slot_eq(victimPlayer, player_slot_ft7_opponent, killerPlayer) then
					local killerScore = game.player_get_slot(1, killerPlayer, player_slot_ft7_score)
					local victimScore = game.player_get_slot(2, victimPlayer, player_slot_ft7_score)
					
					killerScore = killerScore + 1
					
					-- Victory
					if killerScore >= 7 then
						killerScore = 7
						
						-- Update Slots
						game.player_set_slot(killerPlayer, player_slot_ft7_score, 0)
						game.player_set_slot(victimPlayer, player_slot_ft7_score, 0)
						game.player_set_slot(killerPlayer, player_slot_ft7_opponent, -1)
						game.player_set_slot(victimPlayer, player_slot_ft7_opponent, -1)
						
						-- Store Usernames
						game.str_store_player_username(1, killerPlayer)
						game.str_store_player_username(2, victimPlayer)
						local killerUsername = game.sreg[1]
						local victimUsername = game.sreg[2]
						
						local killerUID = game.player_get_unique_id(1, killerPlayer)
						local victimUID = game.player_get_unique_id(2, victimPlayer)

						--sendMessageToServer("Before Send")
						-- Send HTTP Request to Webserver
						sendGetRequest("useragent", "ft7", {
							["winner_id"] = killerPlayer,
							["loser_id"] = victimPlayer,
							["winner_uid"] = killerUID,
							["loser_uid"] = victimUID,
							["winner_score"] = killerScore,
							["loser_score"] = victimScore
						})
						--sendMessageToServer("After Send")
						
						-- Send Message
						sendMessageToServer(string.gsub(string.gsub(string.gsub(string.gsub(str_ft7_broadcast, "%%%%winner%%%%", killerUsername), "%%%%opponent%%%%", victimUsername), "%%%%winnerScore%%%%", killerScore), "%%%%opponentScore%%%%", victimScore), true)
					else
						-- Update Slots
						game.player_set_slot(killerPlayer, player_slot_ft7_score, killerScore)
						
						-- Send Message
						sendMessageToPlayer(killerPlayer, string.gsub(string.gsub(str_ft7_status, "%%%%yourScore%%%%", killerScore), "%%%%opponentScore%%%%", victimScore), false)
						sendMessageToPlayer(victimPlayer, string.gsub(string.gsub(str_ft7_status, "%%%%yourScore%%%%", victimScore), "%%%%opponentScore%%%%", killerScore), false)
					end
				end
			
			end
			
		end
	end
end

function onAgentSpawn()
	local agent = getTriggerParam(1)
	
	-- Agent is player
	if not game.agent_is_non_player(agent) then
		local player = game.agent_get_player_id(1, agent)
		
		local x = game.player_get_slot(1, player, player_slot_respawn_pos_x)
		local y = game.player_get_slot(2, player, player_slot_respawn_pos_y)
		local z = game.player_get_slot(3, player, player_slot_respawn_pos_z)
		
		if x ~= -1 and y ~= -1 and z ~= -1 then
			local pos = game.pos.new()
			pos.o.x = x
			pos.o.y = y
			pos.o.z = z


			--(agent_get_horse,<destination>,<agent_id>),
			local horse = game.agent_get_horse(1, agent)

			if horse == -1 then
				game.agent_set_position(agent, pos)
			else
				game.agent_set_position(horse, pos)
			end

			game.player_set_slot(player, player_slot_respawn_pos_x, -1)
			game.player_set_slot(player, player_slot_respawn_pos_y, -1)
			game.player_set_slot(player, player_slot_respawn_pos_z, -1)
		end
	end
end

function onAgentUnwieldedItem()
	local agent = getTriggerParam(1)
	local item = getTriggerParam(2)
	
	if game.agent_is_human(agent) and game.agent_is_active(agent) and game.agent_is_alive(agent) and not game.agent_is_non_player(agent) then
		if not game.agent_slot_eq(agent, slot_agent_in_duel_with, -1) then
			table.insert(unwieldAgents, agent)
		end
	
	end
end