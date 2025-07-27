## Create Laravel Project

- composer create-project --prefer-dist laravel/laravel [app_name]
- composer create-project laravel/laravel:^11.0 my-app (if switch to version)
- config/app.php -> 'timezone'=> 'Asia/Manila',
- config/database.php -> 'charset'=> 'utf8', 'collation'=> 'utf8_general_ci',
- Modify .env -> DB_DATABASE=[db_name]
- Make model and migration -> php artisan make:model [Model_name]-m
- Config model -> 
- public $timestamps = true; 
- protected $table = 'products';
- protected $fillable = [
    'attribute'
 ];
- Config migration (database/tables)
- Migrate->php artisan migrate
- Make resource-> php artisan make:resource [Resource_name]
- Config resources
- Make request-> php artisan make:request [Request_name]
- Config request
- Make controller-> php artisan make:controller [Controller_name] --resource
- Install api->php artisan install:api
- Configure api.php
- Show route lists(optional)->php artisan route:list

## Install Vue.js

- npm i vue@latest vue-loader@latest
- npm i --save-dev @vitejs/plugin-vue
- npm i @vitejs/plugin-vue
- npm i vue-router@4
- npm install vue vue-router vue-axios --save
- @vite('resources/css/app.css')
- @vite('resources/js/app.js')

## vite.config.js
- import { defineConfig } from 'vite';
- Add on welcome.blade.php
- import vue from "@vitejs/plugin-vue"; 
- import laravel from 'laravel-vite-plugin';

- export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});

## Vue.js Setup
- same process but start with this
- npm create vue@latest
- cd [your-project-name]
- npm install
- npm run dev
- npm i vue-router@4 vue-axios --save-dev
