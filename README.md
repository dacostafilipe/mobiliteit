mobiliteit
==========

Gathering bus information from a specific station in Luxembourg is hard
This tool helps you to just get back the json that mobiliteit.lu should give you back

##API
- **[<code>GET</code> STATIONID/:amount](https://mobiliteit.herokuapp.com/200405036/5)**
- **[<code>GET</code> clean/STATIONID/:amount](https://mobiliteit.herokuapp.com/clean/200405036/5)**

##Usage

- Using **[<code>GET</code> clean/STATIONID/:amount](https://mobiliteit.herokuapp.com/clean/200405036/5)** is exporting the JSON retrieved from mobiliteit.lu in a formatted way.
- stationName is returning the name of the station you requested information for
- journeys is going to return the next busses to depart at this station

every journey is going to include the following information:
- <code>timestamp</code> the unix timestamp of the departure
- <code>line</code> the line number of the bus
- <code>destination</code> the destination of the bus
- <code>delay</code> the delay that this departure has according to the schedule

## Example

    https://mobiliteit.herokuapp.com/200405036
    https://mobiliteit.herokuapp.com/200405036/5
    https://mobiliteit.herokuapp.com/clean/200405036
    https://mobiliteit.herokuapp.com/clean/200405036/5

##Installation on your own heroku instance

1. Clone this repository using `git clone git@github.com:Kaweechelchen/mobiliteit.git`
* Get an [Heroku account](https://id.heroku.com/signup)
* install the [heroku toolbelt](https://toolbelt.heroku.com/)
* create a new heoku app using `heroku create`
* push the code `git push heroku master`

## Nginx

If (like me) you don't like Apache, just edit your nginx config to something like this:

<code>
location /api/ {
    try_files $uri /var/www/web/index.php$is_args$args;
}
</code>

This would be for testing and you still need to setup the "server" part.


## License
Copyright (c) 2014 [Thierry Degeling](https://github.com/Kaweechelchen)
Licensed under the MIT license.
