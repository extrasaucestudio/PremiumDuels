Endpoints

## domain.com/api/check

Checks for user existence, account activation, returns data about user.

Required params:

uid (unique id)
username (username)

Error codes;

`-2` : Wrong Querry

If user doesn't exist in Database, user is registered (with unactivated account, he needs later login on website)

In this case response looks like this:

`1|333|dssdasad`  
`status|unique id|password`

If user is already registered but unactivated, response looks like this:

`2|333|dssdasad`  
`status|unique id|password`

If user is already registered anf activated, response looks like this:
`3|333|dssdasad|1500`  
`status|unique id|password|elo`

## domain.com/api/ft7

Required parameters.

`winner_uid`  
`loser_uid`  
`winner_score` (how many times he killed enemy)  
`loser_score`(how many times he killed enemy)

Error codes;

`-3` One of participants doesnt have account  
`-4` Winner of duel have inactive account  
`-6` Loser of duel have inactive account

Correct Response looks like

`5|5552|1221|23|12`  
`status|winner_uid|loser_uid|winner elo plus | loser elo minus`
