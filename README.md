# Motustore

A sample admin panel for managing customers, orders and products information.

## Running the App

Ensure you have docker & docker-compose installed and running and then follow the steps below:

```
git clone https://github.com/cornzie/motustore.git


# your project folder
cd motustore 

# create a .env file
cp .env.example .env

# ensure to fill the DB_* values in the .env file
# If skipped, would use the defaults in .env.example

docker-compose up
```
Visit the website at http://localhost:8000/

The seeder ran while building the app would create two accounts with roles `manager` and `loggedUser`
- Manager account credentials: manager@example.com, password
- Logged User account credentials: user@example.com, password
