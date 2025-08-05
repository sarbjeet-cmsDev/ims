


# IMS Laravel Project

A Laravel-based Inventory Management System (IMS) with Tailwind CSS, reusable components, and customer management features.

```bash

DAY 2

Integrate in your project for Frontend validation

Create Customer, CustomerAddress Entities and Controllers & ROUTES WITH RESOURCES

php artisan make:controller CustomerController --resource
php artisan make:controller CustomerAddressesController --resource

apply frontend and backend valiadtion.

backed valiadtion apllying using request.
frontend valiadtion applying using js.

DAY 3 

php artisan make:job ExportCustomersJob

composer require league/csv
mkdir -p storage/app/exports
 touch storage/app/exports/test.csv
ls -l storage/app/exports/

php artisan make:model CustomerExport -m
php artisan make:controller CustomerExportController

php artisan queue:work --queue=customer-export

