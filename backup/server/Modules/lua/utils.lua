function getTriggerParam(index)
	return game.store_trigger_param(0, index)
end


function split(pString, pPattern)
	local Table = {}
	local fpat = "(.-)" .. pPattern
	local last_end = 1
	local s, e, cap = pString:find(fpat, 1)
	while s do
		if s ~= 1 or cap ~= "" then
			table.insert(Table,cap)
		end
		last_end = e+1
		s, e, cap = pString:find(fpat, last_end)
	end
	if last_end <= #pString then
		cap = pString:sub(last_end)
		table.insert(Table, cap)
	end
	return Table
end

function sendGetRequest(useragent, endpoint, params)
	local successScriptNo = game.getScriptNo("pd_receive_url_response")
	local failScriptNo = game.getScriptNo("pd_receive_url_response_failure")
	if params == nil then
		game.send_message_to_url_advanced(api_url, useragent, successScriptNo, failScriptNo, 1)
	else
		local paramString = "?"
		for k,v in pairs(params) do
			paramString = paramString .. (k .. "=" .. v .. "&")
		end
		paramString = string.sub(paramString, 1, string.len(paramString) - 1)
		game.send_message_to_url_advanced(api_url .. endpoint .. "/" .. paramString, useragent, successScriptNo, failScriptNo, 1)
	end
end