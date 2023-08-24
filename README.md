# BLOG API Task For Momentum Solutions www.msol.dev

This Laravel project implements a Blog API for Share Posts. 

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)

## Introduction

This Blog API is designed to help users share posts.

## Features

- Shows Posts For Blog
- Add Post
- Edit Post
- Delete Post

## Requirements

- PHP >= 8.1
- Composer >= 2.5.5
- Laravel >= 9.0
- Apache >= 2.0
- MySQL or other compatible database

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Mahmoud72E/task_blog_msol.git
   ```

2. Navigate to the project directory:

   ```bash
   cd task_blog_msol
   ```

3. Install the dependencies:

   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env` and configure your database settings.

5. Generate a new application key:

   ```bash
   php artisan key:generate
   ```

6. Run the database migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```

7. Start the development server:

   ```bash
   php artisan serve
   ```

## Usage

- Access url in your browser To show all docs `http://localhost/request-docs/`.
- Register by `http://127.0.0.1/:8000/api/register`
- Login by `http://127.0.0.1/:8000/api/login`
- logout by `http://127.0.0.1/:8000/api/logout`
- and use `/posts` with Methods [Post : to create a new post, Get : to show all posts]
- and use `/posts/{id}` with Methods [Put : To Update Post, Get : to show one post, Delete : to delete one post]

## Contributing

Contributions are welcome! If you encounter any issues or have suggestions for improvements, please [open an issue](https://github.com/Mahmoud72E/task_blog_msol/issues) or submit a pull request.
