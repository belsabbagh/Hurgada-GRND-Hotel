# Hurgada-GRND-Hotel #

A website project for a hotel management system.

## Overview ##

Hurgada GRND Hotel is one of the biggest Hotels in Hurgada. It has been operating in
Hurgada since 1910. At this time, the guests were few and can be served while enjoying their
stay in the Hotel. Now, the number of guests has increased and the types of the guests have
become different. For example, now some guests are staying in the Hotel and others ask for
only day use. The Hotel needs to make a website to automate the work. The website has to
facilitate the workflow for both the employees and the guests. The target is to let the guests
have a better guest experience and make it easy for the guests to check in and ask for different
services. On the other hand, the employees have to make fewer steps to complete the check-in
process so that they can serve more guests in less time. Quality is also a main objective.

## High Level specifications ##

1. Make a virtual check-in for self services: guests can enter the Hotel and make the check-in via self services screens using their accounts.
2. Easy receptionist: This view has to let the receptionists finish the check-in in an easy way.
3. Quality Control: This view has to let the quality control personnel to view the comments shared by the guests, the time taken to complete each stay, etc.

## Specifications ##

### 1. Guests self-service view ###

- In this view the guests can make the check-in and check-out by themselves.

### 2. Receptionist view ###

1. Login using his/her username and password.
2. Search for any client using their name and/or the room.
3. Check in and check out any clients.
4. Book reservations.
5. Delete/cancel a reservation before completing it.
6. The receptionist cannot delete/cancel a reservation after completing it unless the manager PIN is supplied
7. Before submitting the order, a warning has to appear to the receptionist to remind them to review the order with the guests before submitting.

### 3. Quality control view ###

1. View the comments of the guests.
2. Generate reports related to the ratings.
   a. Aggregation by rating (how many guests gave a specific room 5 stars, 4 stars, etc.)
   b. Aggregation by room (how many rooms got 5 stars by how many guests).
   c. How many guests canceled their reservations.
   d. How many guests edited their reservations.
   e. What is the most ordered room.
3. Assign the role of quality control managers to receptionists (promotion).
4. Create a new user for new receptionists, and disable/enable the receptionist accounts.
a. When disabling/enabling a receptionist account a comment has to be entered by the quality control manager.
b. If the receptionist account is disabled then the receptionist cannot use it till it is enabled again.

## Milestones ##

### 1. Registration ###

- The guests can register to this self-service website by entering his/her data and upload his national ID and picture. If there are other guests (family members/dependants) with him/her, then the guest has to upload their National IDs and/or birth certificates.
- A request is sent to the Quality Control to approve/reject the request.
- During the registration, the guest can provide their password, and it has to be validated by entering the password
  twice.

### 2. Login ###

- The guest can log in by providing his/her email address and the password.
- The website has to check the role of the user and directs him/her to the landing page according to his/her role (e.g.
  guests, quality, receptionist, etc.).

### 3. Booking and Reservations ###

- When the guest logs in to the website and starts booking, he has the options to select
    - Regular stay
    - Family vacation
    - Honeymoon
    - BnB
    - All inclusive
    - I have a different plan
- When the guest selects any of the options (except the different plan), the respective rooms are shown so that he/she
  can add whatever he/she wants.
- The guest can return to the main menu to select different rooms from different categories.
- If the guest wants to make different plans (e.g. first 3 days in a special type of room then another 3 days in another
  room , etc.) they will be redirected to contact the receptionist directly.
- The guests can view the reservation and edit its details.
- After viewing the reservation, the guests can continue editing the reservation or go to the checkout page for payment.
- After submitting the order, the guests can edit it within 5 minutes only.
- The guests can go to the comments area and rate specific rooms and/or the entire stay (Rating from 1 to 5). They can
  write comments on the reservation.
- After submitting the comment, the guests can edit it within 5 minutes only.

## General Requirements ##

1. All the actions done by any type of the users has to be logged in a logging table storing
    - (date, owner, type of action, description, etc.).
