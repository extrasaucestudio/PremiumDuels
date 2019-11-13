---
--- Copyright (c) 2019 Skrypt - All Rights Reserved.
---
--- Constants from all modules and sub-modules are stored here.
---

-----------------------------------------------
--- CHANGE THIS TO YOUR API URL WHEN NEEDED ---
-----------------------------------------------
api_url = "217.61.3.83/api/"
-----------------------------------------------
--- CHANGE THIS TO YOUR API URL WHEN NEEDED ---
-----------------------------------------------
--- NOTE: always end the api_url with a trailing slash ('/') at the end

-- Import sub-module constants
require("duel.ft7.constants")

-- Duel Modes
duel_mode_normal    = 0
duel_mode_ft7       = 1

-- Account States
account_state_inactive  = 0
account_state_active    = 1

-- Item Slot Types
item_slot_1 = 0
item_slot_2 = 1
item_slot_3 = 2
item_slot_4 = 3
item_head   = 4
item_body   = 5
item_foot   = 6
item_hand   = 7
item_horse  = 8
item_food   = 9

-- Player Ranks
player_rank_invalid = itm_no_item               -- ELO: None
player_rank_red     = itm_arena_tunic_red       -- ELO:    0 - 1499
player_rank_green   = itm_arena_tunic_green     -- ELO: 1500 - 1999
player_rank_yellow  = itm_arena_tunic_yellow    -- ELO: 2000 - 2499
player_rank_blue    = itm_arena_tunic_blue      -- ELO: 2500 - 2999
player_rank_white   = itm_arena_tunic_white     -- ELO: 3000 +
		
		-- Player Slots
player_slot_duel_mode               = 70
player_slot_account_state           = 71
player_slot_rank                    = 72
player_slot_custom_equipment_head   = 73
player_slot_custom_equipment_body   = 74
player_slot_custom_equipment_hand   = 75
player_slot_custom_equipment_foot   = 76
player_slot_custom_equipment_weapon = 77
player_slot_duel_interrupt_time     = 78
player_slot_respawn_pos_x           = 79
player_slot_respawn_pos_y           = 80
player_slot_respawn_pos_z           = 81


-- Native Agent Slots
slot_agent_in_duel_with                 = 21

-- Native Events
multiplayer_event_cancel_duel                                 = 110