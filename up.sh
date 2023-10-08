#!/bin/bash

pushd "$1" || exit
echo "Remove old Vendor packages"
rm -rf ./vendor
echo "Installing Vendor Packages from lock"
php composer.phar install

echo "Performing Cleanup"
php artisan cache:clear;php artisan config:clear;php artisan route:clear;php artisan view:clear;

echo "Bringing Site back online"
php artisan up

popd || exit
