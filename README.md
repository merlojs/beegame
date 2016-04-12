
Author : Juan Merlo Romero 

Source : [Thomas Bondois](http://thomas.bondois.info/)
         [Original Repo](https://github.com/tbondois/bee-massacre)

Note:  A fork was intended for this small project but would have required a pull request, 
only providing minor changes to the original application. For that reason original idea is cited as source. 
No license info is specified in original repository.

A game about shooting bees in a swarm.

#The Bee Game

##Objective:

The objective of this exercise is to create a PHP application that performs the following tasks:
• A web page must be produced as the interface to play the game. Styling is not
expected nor necessary.
• A button must be present to kick off the process of hitting a random bee.
• All code must be submitted to work in a local environment. Hosted solutions will be
rejected. The game must adhere to the following rules and constraints.

##Specification:

###Bees:

There are three types of bees in this game:

Queen Bee

* The Queen Bee has a lifespan of 100 Hit Points.
* When the Queen Bee is hit, 8 Hit Points are deducted from her lifespan.
* If/When the Queen Bee has run out of Hit Points, All remaining alive Bees
automatically run out of hit points.
* There is only 1 Queen Bee.
Worker Bee
* Worker Bees have a lifespan of 75 Hit Points.
* When a Worker Bee is hit, 10 Hit Points are deducted from his lifespan.
* There are 5 Worker Bees.
Drone Bee
* Drone Bees have a lifespan of 50 Hit Points.
* When a Drone Bee is hit, 12 Hit Points are deducted from his lifespan.
* There are 8 Drone Bees.

###Gameplay:
To play, there must be a button that enables a user to “hit” a random bee. The selection of a
bee must be random. When the bees are all dead, the game must be able to reset itself with
full life bees for another round.

###Constraints:
* The application must run through a browser
* Your source code must be on github
* You must use php5
* You must use composer to set-up your project
* You have 24 hours to do this test maximum
