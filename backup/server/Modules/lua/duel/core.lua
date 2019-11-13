---
--- Copyright (c) 2019 Skrypt - All Rights Reserved.
---
require("duel.ft7.core")
require("duel.events")

function onURLResponseSucceeded(response)
	local parsed = split(response, "|")
	
	--sendMessageToServer("Response: " .. response)
	--local parsed = "test"
	local id = tonumber(parsed[1])
	local status = tonumber(parsed[2])
	
	-- CHECK Response
	if id == 1 then
		local player = tonumber(parsed[3])
		
		if status ~= -2 then
			local uid = tonumber(parsed[4])
			local password = parsed[5]
			
			if game.player_is_active(player) then
				-- Account Creation
				if status == 1 then
					sendMessageToPlayer(player, "Your account has been created, UID: " .. tostring(uid) .. ", Password: " .. password)
					-- Inactive Account
				elseif status == 2 then
					sendMessageToPlayer(player, "Your account is inactive, UID: " .. tostring(uid) .. ", Password: " .. password)
					-- Active Account
				elseif status == 3 then
					local elo = tonumber(parsed[6])
					local head = tonumber(parsed[7])
					local body = tonumber(parsed[8])
					local hand = tonumber(parsed[9])
					local foot = tonumber(parsed[10])
					local weapon = tonumber(parsed[11])
					local message = parsed[12]
					sendMessageToPlayer(player, "Your ELO: " .. elo)
					sendMessageToServer(message)
					
					game.player_set_slot(player, player_slot_account_state, account_state_active)
					game.player_set_slot(player, player_slot_rank, getRankByELO(elo))
					
					game.player_set_slot(player, player_slot_custom_equipment_head, head)
					game.player_set_slot(player, player_slot_custom_equipment_body, body)
					game.player_set_slot(player, player_slot_custom_equipment_hand, hand)
					game.player_set_slot(player, player_slot_custom_equipment_foot, foot)
					game.player_set_slot(player, player_slot_custom_equipment_weapon, weapon)
				end
			end
		end
	elseif id == 2 and status == 5 then
		
		local winner = tonumber(parsed[3])
		local loser = tonumber(parsed[4])
		local winnerUID = tonumber(parsed[5])
		local loserUID = tonumber(parsed[6])
		local winnerELOChange = tonumber(parsed[7])
		local loserELOChange = tonumber(parsed[8])
		local winnerELO = tonumber(parsed[9])
		local loserELO = tonumber(parsed[10])
		
		
		if game.player_is_active(winner) and game.player_is_active(loser) then
			game.player_set_slot(winner, player_slot_rank, getRankByELO(winnerELO))
			game.player_set_slot(loser, player_slot_rank, getRankByELO(loserELO))
			
			sendMessageToPlayer(winner, "Your ELO: " .. winnerELO .. "(+"..  winnerELOChange .. ")")
			sendMessageToPlayer(loser, "Your ELO: " .. loserELO .. "("..  loserELOChange .. ")")
			
		end
	end
end

function onURLResponseFailed(response)
	sendMessageToServer("An unexpected error occured while trying to communicate with the web API!")
--	sendMessageToServer("Response: '" .. response .. "'")
end

function loop1s()
	-- Sheathing Cancel
	for key,agent in ipairs(unwieldAgents) do
		if game.agent_is_active(agent) and game.agent_is_alive(agent) then
			local wieldedItem = game.agent_get_wielded_item(1, agent, 0)

			if wieldedItem == -1 then
				local otherAgent = game.agent_get_slot(1, agent, slot_agent_in_duel_with)

				if not game.agent_is_non_player(agent) and not game.agent_is_non_player(otherAgent) then
					local player = game.agent_get_player_id(1, agent)
					local otherPlayer = game.agent_get_player_id(1, otherAgent)

					-- Cancel Event
					game.multiplayer_send_int_to_player(player, multiplayer_event_cancel_duel, otherPlayer)
					game.multiplayer_send_int_to_player(otherPlayer, multiplayer_event_cancel_duel, agent)

					-- Clear Relations
					game.agent_set_slot(agent, slot_agent_in_duel_with, -1)
					game.agent_set_slot(otherAgent, slot_agent_in_duel_with, -1)
					game.agent_clear_relations_with_agents(agent)
					game.agent_clear_relations_with_agents(otherAgent)

					-- Send Message
					sendMessageToPlayer(player, str_duel_cancel)
					sendMessageToPlayer(otherPlayer, str_duel_cancel)
				end
			end
		end
	end
	unwieldAgents = {}
	
	-- Teleport Interruption
	for curPlayer in game.playersI(1) do
		if game.player_is_active(curPlayer) then
			local curAgent = game.player_get_agent_id(1, curPlayer)
			
			if game.agent_is_active(curAgent) and game.agent_is_alive(curAgent) and game.agent_slot_eq(curAgent, slot_agent_in_duel_with, -1) then
				
				--(agent_get_position,<position_no>,<agent_id>),
				
				for nearbyPlayer in game.playersI(1) do
					if game.player_is_active(nearbyPlayer) then
						local nearbyAgent = game.player_get_agent_id(1, nearbyPlayer)
						
						if nearbyAgent ~= curAgent then
							if game.agent_is_active(nearbyAgent) and game.agent_is_alive(nearbyAgent) then
								
								if not game.agent_slot_eq(nearbyAgent, slot_agent_in_duel_with, -1) then
									if game.agent_slot_eq(nearbyAgent, slot_agent_in_duel_with, curAgent) and game.agent_slot_eq(curAgent, slot_agent_in_duel_with, curAgent) then
									
									else
										
										game.agent_get_position(1, curAgent)
										game.agent_get_position(2, nearbyAgent)
										
										--sendMessageToServer("CurAgent: " .. curAgent)
										--sendMessageToServer("Nearby Agent: " .. nearbyAgent)
										local distance = game.get_distance_between_positions_in_meters(1,1,2)
										
										--sendMessageToServer("Distance: " .. distance)
										if distance <= 3 and distance >= 2 then
											sendMessageToPlayer(curPlayer, str_teleport_warning)
										elseif distance < 2 then
											-- TODO: Teleport
											local smallestDist = 99999
											local pos = game.preg[1]
											for entry=1,32,1 do
												game.entry_point_get_position( 3, entry)
												local dist = game.get_distance_between_positions_in_meters(1,1,3)
												if dist < smallestDist then
													pos = game.preg[3]
													smallestDist = dist
												end
											end
											
											local curTime = os.time()
											if game.player_slot_eq(curPlayer, player_slot_duel_interrupt_time, -1) then

												local horse = game.agent_get_horse(1, agent)

												if horse == -1 then
													game.agent_set_position(curAgent, pos)
												else
													game.agent_set_position(horse, pos)
												end

												game.player_set_slot(curPlayer, player_slot_duel_interrupt_time, curTime + 3)
											else
												local targetTime = game.player_get_slot(2, curPlayer, player_slot_duel_interrupt_time)
												
												if curTime > targetTime then
													local horse = game.agent_get_horse(1, agent)
													if horse == -1 then
														game.agent_set_position(curAgent, pos)
													else
														game.agent_set_position(horse, pos)
													end
													game.player_set_slot(curPlayer, player_slot_duel_interrupt_time, curTime + 3)
												else
													local notpEntry = math.random(33, 40)
													game.entry_point_get_position( 4, notpEntry)

													local horse = game.agent_get_horse(1, agent)
													if horse == -1 then
														game.agent_set_position(curAgent, game.preg[4])
													else
														game.agent_set_position(horse, game.preg[4])
													end
													
												end
											end
										end
									end
								end
							end
						end
					end
				end
			end
		end
	end
end