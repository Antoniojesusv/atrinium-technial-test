# Symfony Project

Atrinium Technical Test Project

### Start the project

In order to initialize the project for the first time, the init script must be executed.

```
./docker/scripts/init.sh
```

### Build the data

Builds the data once it has been initially installed

```
./docker/scripts/up.sh
```

### Deploy

When we lift the project we are going to have a series of lifted containers:

- php - PHP-FPM container
- mysql - Database manager container
- adminer - Client for the connection to the database container
- nginx - Web server container

### Database manager

Adminer is a thin client for database management systems, if for any reason
you wish to access the database, you can access it through this client.

- http://localhost:8085
- user: root
- password: symf0ny
- db: symfony_projects

## Run the application

- http://localhost

## Author

- Antonio Jesús Vázquez Muñoz
