# Motustore

A sample admin panel for managing customer, orders and products information.

## Running the App

Ensure you have docker & docker-compose installed and running and then follow the steps below:

```
git clone https://github.com/cornzie/motustore.git
cd motustore # your project folder
docker-compose up

# once the containers are started
docker ps
# copy the CONTAINER ID for motustore_motustore image from the result of running the above command

docker exec -it <CONTAINER ID> /bin/sh

php artisan db:migrate --seed
```
Visit the website at http://localhost:8000/

The seeder would create two accounts with roles `manager` and `loggedUser`
- Manager account credentials: manager@example.com, password
- Logged User account credentials: user@example.com, password