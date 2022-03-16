# Hurgada-GRND-Hotel
A website project for a hotel management system.

## Overview
Hurghada GRND Hotel is one of the biggest Hotels in Hurghada. It has been operating in
Hurghada since 1910. At this time, the guests were few and can be served while enjoying their
stay in the Hotel. Now, the number of guests has increased and the types of the guests have
become different. For example, now some guests are staying in the Hotel and others ask for
only day use. The Hotel needs to make a website to automate the work. The web site has to
facilitate the workflow for both the employees and the guests. The target is to let the guests
have a better guest experience and make it easy for the guests to check in and ask for different
services. On the other hand, the employees have to make fewer steps to complete the check-in
process so that they can serve more guests in less time. Quality is also a main objective.

## High Level specifications
1. Make a virtual check-in for self services: guests can enter the Hotel and make the
check-in via self services screens using their accounts.
2. Easy receptionist: This view has to let the receptionists finish the check-in in an easy
way.
3. Quality Control: This view has to let the quality control personnel to view the comments
shared by the guests, the time taken to complete each stay, etc.

## Specifications
1. guests self services view:
    -  In this view the guests can make the check-in and check-out by himself/herself.
2. receptionist view:
    1. The receptionist can login using his/her username and password
    2. The receptionist can search for any item using its name and/or the room
    3. The receptionist can add/edit/delete items in the card by clicking its name/picture
    4. The receptionist can delete/cancel an order before completing it.
    5. The receptionist cannot delete/cancel an order after completing it unless the manager
    PIN is supplied
    6. Before submitting the order, a warning has to appear to the receptionist to remind
    him/her to review the order with the guests before submitting.

3) Quality control view:
    1. The quality control manager can view the comments of the guests
    2. The quality control manager can generate reports related to the ratings
        a. Aggregation by rating (how many guests gave a specific product 5 starts, 4
        starts, etc.)
        b. Aggregation by room (how many products got 5 stars by how many guests)
        c. How many guests canceled their reservations
        d. How many guests edited their reservations
        e. What is the most ordered room
        
3. The quality control manager can assign the role of quality control managers to
receptionists (promotion)
4. The quality control manager can create a new user for new receptionists, and
disable/enable the receptionist accounts.
a. When disabling/enabling a receptionist account a comment has to be entered by
the quality control manager
b. If the receptionist account is disabled then the receptionist cannot use it till it is
enabled again.

## Milestones
1. Registration:
    - The guests can register to this selfservices website by entering his/her data and
    upload his national ID and picture. If there are other guests (family members)
    with him/her, then the guest has to upload their National IDs and/or birth
    certificates.
    - A request is sent to the Quality Control to approve/reject the request
    - During the registration, the guests can provide his password and to be validated
    by entering the password twice

2. Login:
    - The guest can login by providing his/her email address and the password
    - The website has to check the role of the user and directs him/her to the landing
    page according to his/her role (e.g. guests, quality, receptionist, etc.)

3. Making orders
    - When the guests login to the website, he has the options to select
      - Day use
      - 1 to 7 nights
      - Long stay (more than 7 nights)
      - Vacation (more than a month)
      - I have different plan
    - When the guests selects any of the options (except the last option), the
    respective rooms are shown so that he/she can add whatever he/she wants.
    - The guests can return back to the main menu to select different rooms from
    different categories.
    - If the guest selects the last option so he can make different plans (e.g. first 3
    days in a special type of room then another 3 days in another room , etc.) he/she
    can add to the cart.
    - The guests can view the cart and remove or change the quantity of any of the
    rooms.
    - After viewing the cart, the guests can continue adding rooms or go to the
    checkout page for payment.
    - After submitting the order, the guests can edit it within 5 minutes only.
    - The guests can go to the comments area and rate specific rooms and/or the
    entire stay (Rating from 1 to 5). He/She can write comments on the reservation.
    - After submitting the comment, the guests can edit it within 5 minutes only
  
## General Requirements:
1. All the actions done by any type of the users has to be logged in a logging table storing
(date, owner, type of action, description, etc.).
