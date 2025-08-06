# IMS Project 

Day_4 IMS: Customer Import

php artisan make:model CustomerImport -m
php artisan migrate

php artisan make:controller CustomerImportController

php artisan make:job ImportCustomersJob

composer require league/csv
php artisan queue:work --queue=customer-import
