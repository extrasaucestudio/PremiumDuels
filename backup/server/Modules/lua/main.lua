---
--- Copyright (c) 2019 Skrypt - All Rights Reserved.
---

math.randomseed(os.time())

-- Import all modules
-- NOTE: The order of import is very important as many modules depend on each other!

unwieldAgents = {}
require("ids.items")
require("config")
require("constants")
require("strings")
require("utils")
require("messaging")

require("duel.core")

game.addTrigger("mst_multiplayer_duel", game.const.ti_server_player_joined, 0, 0, onPlayerJoin)
game.addTrigger("mst_multiplayer_duel", game.const.ti_on_player_exit, 0, 0, onPlayerQuit)
game.addTrigger("mst_multiplayer_duel", game.const.ti_on_item_unwielded, 0, 0, onAgentUnwieldedItem)
game.addTrigger("mst_multiplayer_duel", game.const.ti_on_agent_spawn, 0, 0, onAgentSpawn)
game.addTrigger("mst_multiplayer_duel", 1, 0, 0, loop1s)