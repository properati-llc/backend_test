# Casafy - Backend Test

This repository contains Casafy's backend test, which will check candidate's skills regarding backend development.

## Tecnologies to be used

- PHP as programming language (preferably using Laravel as framework)
- PHPUnit as testing tool

## What needs to be done

Considering the following object data structure:

```
{
    "id": 1,
    "address": "Rua Vergueiro, 126",
    "bedrooms": 3,
    "bathrooms": 2,
    "total_area": 125,
    "purchased": false,
    "value": 125000.00,
    "discount": 10
    "owner_id": 1,
    "expired": false,
    "created_at": "2021-02-23 16:02:16",
    "updated_at": "2021-02-23 16:02:16"
}
```

And a simple user data structure:
```
{
    "id": 1,
    "name": "John",
    "email": "john@test.com"
    "created_at": "2021-02-23 15:02:16",
    "updated_at": "2021-02-23 15:02:16"
}
```

You'll have to create the following endpoints:

- Resource endpoints to Create, Read, Update and Delete users;
- Resource endpoints to Create, Read, Update and Delete properties;
- An endpoint to get all the properties associated with an user;
- An endpoint to change the object purchased property;

## Requisites

Some requisites must be followed:

- Every property must be associated with an user;
- An user cannot have more than 3 properties with purchased = false;
- If created_at exceeds 3 months, expired property should be changed to true while getting the object;
- The value property to be shown in the object get request reponse must always consider the discount (e.g. 112500.00, taking into account the 10% discount shown in the example);

## What we like

- Clean code;
- Good practices (SOLID, DRY, etc);
- Unit tests;
- Type check;

## Bonus

It will be a bonus requisite if you use Docker containers to setup the application.