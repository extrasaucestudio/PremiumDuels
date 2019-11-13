---
--- Copyright (c) 2019 Skrypt - All Rights Reserved.
---
--- Core file of the first to 7 module.
---
-- Import all sub-modules
require("duel.ft7.events")

function getRankByELO(elo)
	local rank = player_rank_red
	if elo >= rank_4_upgrade then
		rank = player_rank_white
	elseif elo >= rank_3_upgrade then
		rank = player_rank_blue
	elseif elo >= rank_2_upgrade then
		rank = player_rank_yellow
	elseif elo >= rank_1_upgrade then
		rank = player_rank_green
	end
	
	return rank
end