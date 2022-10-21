## Technical test for a single page application build with Laravel and Vue

### Description
The assignment is to create a simple To-Do list that creates, edits and deletes daily tasks.

---

### Set up
First clone this repository, build the docker images and start the containers.
```
git clone git@github.com:geobas/laravel-vue-assignment.git laravel_vue_assignment
```
```
docker-compose up -d && docker exec -it laravel-vue-assignment bash
```
Install laravel dependencies.
```
composer install \
   && composer run-script post-root-package-install \
   && composer run-script post-create-project-cmd
```
Create the necessary database.
```
./artisan db
create database laravel_vue_assignment
```
Modify the generated .env accordingly and run the initial migrations and seeders.
```
./artisan migrate:fresh --seed
```
Install vue dependencies and then compile the assets.
```
npm ci && npm run dev
```
Go to http://localhost

### Execute tests
```
composer test
```
```
npm test
```
