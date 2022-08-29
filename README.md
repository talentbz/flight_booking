## Admin profile change
	change password
## User management
	- user list
	- user add, delete, status (active, inactive)
## Seat management
	- seat type (CRUD)
	- increase price(%, fixed, time, seat count, status)
## Booking Transaction
	- list according to every user
	- add agent  


The following were agreed: 

1. A backend system for travel agents to sell tickets 
2. Within the shortest possible time, a front-end system for passengers to purchase tickets directly. 
3. Seats will be sold in tiers, with the system automated to increase prices as available seat numbers reduce and as the departure date draws near. 
4. The system will allow for a manual override of the automation mentioned in point 3. 
5. Paystack and Skrill will be integrated as payment gateways 


## requirement
We require a white labeled flight CRS - multi-tier pricing for tickets, the ability for customers to self-manage flight bookings, seat maps for seat selection, baggage essentials all linked to a payment gateway. After development, the system will be hosted on our server with the developer required to provide training for our staff and sales agents as well as servicing and maintenance.
https://www.seatguru.com/airlines/Delta_Airlines/Delta_Airlines_Airbus_A330_200_new.php

For business class - first 10 seat sell at price X, next 10 seats increase in cost to 15% above x and the final 30 seats sell at 25% above x

There are 190 seats in economy class

First 40 seats in economy sell at x, next fifty sell at 10% above x, next fifty after this sell at 15% above x and final 50 sell at 25% above x

Up to two weeks before the flight, tickets sell at price y

10 days before flight it should increase to 5% above %

9 days to flight - 7% above y

8 days to flight 9% above y

7 days to flight 10% above y

6 days before flight 12% above y

5 days before flight 14% above y

4 days before flight 16% above y

1-3 days before flight 25% above y

## page layout
	-seat type
	-price management
		by seat count
		by date
	-schedule management
		schedule list
