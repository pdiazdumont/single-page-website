# Single page website

## Introduction
This project is a simple backend implementation for single page websites that use the history API to navigate through the different sections. The main problem with this kind of sites is that they require to be implemented in a particular way that allows both the end user and the crawling bots to access the same content.

## Tools used
- Slim
- Slim Twig view

## Requirements
- PHP 5.4+
- Composer
- Bower

## Installation
1. Clone the repository into a folder that your server (Apache, Nginx, etc) can access.
2. Run the following commands in the root folder: `composer install` and `bower install`.
3. Edit the `.htaccess` file inside the `public` folder, changing the *RewriteBase* value according to your setup.
4. The project will be available in the following URL: `<server-path>/single-page-website/public/`.

## Notes
- This project is focused on the backend, so the code used in the frontend is simple and unoptimized.
- Bower isn't really required, it was included only to manage the dependencies that made the front end easier to code.

## To do
- More friendly front end.